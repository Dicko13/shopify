<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use App\Mail\ProduitAjoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProduitFormRequest;
use App\Notifications\ModificationProduit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $produits = Produit::all();
          $produits = Produit::orderByDesc('id')->paginate(15);
         // $produits = Produit::paginate(15); //afficher 15 produit et mettre suivant / precedent
        
       // $produits500 = Produit::where("prix",">", 500)->where("designation","Cahier")->get();
        //$produit = Produit::findOrFail(2);
       // $produit = Produit::first();
        //dump($produits);
        //dd($produit);
        //dd($produits);
        //dd($produits500);
        //$produit = new Produit;
       
        //$produit->designation = "Livre";
        //$produit->description = "La description du Livre";
        //$produit->prix = 1000;
        //$produit->save();
        //dd($produit);

        return view("front-office.produits.index", ['produits' =>$produits]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $produit = new Produit;
        return view("front-office.produits.create", [
             'categories' =>  $categories,
             'produit' => $produit
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProduitFormRequest $request)
    {
        //dd(time());
        //dd($request->file('image'));
        $imageName = 'produit.png';
        if($request->file('image')){
            $imageName = time().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/uploads/produits', $imageName);
        }

        $request->session()->put('imageName', $imageName);
        // session([
        //     'imageName' => ''
        // ]);

        $produit = Produit::create([
            'designation' => $request->designation,
            'prix' => $request->prix,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $imageName
        ]);
        //dd($produit);
        $user = User::first();
        if($user)
        Mail::to($user)->send(new ProduitAjoute);
        
        return Redirect()->route('produits.index')->with('statut', 'le produit a bien été ajouté');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
       // dd($id);
       $categories = Category::all();
        return view("front-office.produits.edit", [
            'produit' =>  $produit,
            'categories' =>  $categories
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProduitFormRequest $request, $id)
    {
        //
        // $request->validate([
        //     'designation' => 'required|min:3|max:50|unique:produits,designation,'.$id,
        //     'prix' => 'required|numeric|between:500,1000000',
        //     'description' => 'required|max:200',
        //     'category_id' => 'required|numeric'

        // ]);

        Produit::where('id', $id)->update([
            'designation' => $request->designation,
            'prix' => $request->prix,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        $user = User::first();
        if($user)
        $user->notify(new ModificationProduit);

        return Redirect()->route('produits.index')->with('statut', 'le produit a bien été Modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Produit::destroy($id);
        return Redirect()->route('produits.index')->with('statut', 'le produit a été bien supprimé');
    }
}
