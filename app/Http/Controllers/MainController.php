<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProduitsExport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{

   public function accueil()
   { 
      $produits = Produit::orderByDesc('id')->take(9)->get();
      return view('welcome', [
         'produits' => $produits
      ]);
   }


    public function ajouterProduit(){
       $Produit = Produit::create([
           "designation" => "Cahier",
           "description" => "Ladescription du Cahier",
           "prix" => 500
       ]);
      // dd($Produit);
    }

    public function updateProduit(Produit $produit){
       // $produit = Produit::findOrFail($id);
       // dump($produit);
        $produit->designation = "Chemise";
        $produit->description = "La description de la Chemise";
        $produit->prix = 6000;
        $produit->save();
        dd($produit);
      
     }
     
     public function updateProduit2($id){
        //$produit = Produit::findOrFail(2);
        //dd($produit);
        $produit = Produit::where("id", 2)->update([
            'designation' => 'Tricot',
            'description' => 'La description de Tricot',
            'prix' => 3500
        ]);
        dd($produit);
     }

     public function supprimerProduit(int $id){
         $produit = Produit::destroy($id);
         //Produit::destroy(collect());
        dd($produit);
     }

     public function createCategory()
     {
        $category=Category::create([
        "libelle" => "Vetements",
       ]);

       $Produit = Produit::create([
        "category_id" => $category->id,
        "designation" => "Pantalon1",
        "description" => "La description du Pantalon",
        "prix" => 6000
    ]);
   // dd($Produit);
     }

     public function getProduit(Produit $produit)
     {
        //dd($produit);
        $category = Category::first();
        dd($category, $category->produits);
       // dd($produit->category);
     }

     public function commande()
     {
       // $user = User::create([
      //      "name" => 'Issa Dicko',
      //      "email" => "iSSa@gmail.com",
      //      "password" => Hash::make('admin'),
       // ]);
        $user = User::first();
        $produit1 = Produit::first();
        $produit2 = Produit::findOrFail(2);
        
        //$user->produits()->attach($produit1);
        $user->produits()->attach($produit2);
       // $user->produits()->sync($produit1); // verifier si le produit existe d'abord,si oui vide et (re) ou cree
        dd($user->produits);
     }

     public function collection()
     {
        $collection1 = collect([
           [ 
              'title' => 'Mon Super Livre 1',
              'price' => 15000,
              'description' => 'description de Mon Super Livre 1'
           ],

           [
            'title' => 'Mon Super Livre 2',
            'price' => 10000,
            'description' => 'description de Mon Super Livre 2'
           ],

           [
            'title' => 'Mon Super Livre 2',
            'price' => 5000,
            'description' => 'description de Mon Super Livre 3'
           ]
        ]);

        $collection1->push([
         'title' => 'Mon Super Livre 4',
         'price' => 20000,
         'description' => 'description de Mon Super Livre 4'
        ]);

        

        $nouvelleCollection = $collection1->filter(function($livre, $key)
        {
          return $livre['price'] >=10000;
        });

        dd($nouvelleCollection);
     }

     public function exportProduits()
     {
      return Excel::download(new ProduitsExport, 'produits.xlsx');
     }
}
