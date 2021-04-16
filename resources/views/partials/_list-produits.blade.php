<table class="table">
           <thead>
               <tr>
                   <th>Designation</th>
                   <th>Categorie</th>
                   <th>Prix</th>
                   <th>Description</th>
                    {{-- <th>Actions</th> --}}
               </tr>
           </thead>
           <tbody>

           @foreach ($produits as $produit)
               <tr>
                   <td>{{ $produit->designation}}</td>
                   <td>{{ $produit->category ? $produit->category->libelle:'Non catégorisé'}}</td>
                   <td>{{ formatPrixBf($produit->prix)}}</td>
                   <td>{{ $produit->description}}</td>
                   {{-- <td>
                   <a href="{{ route('produits.edit', $produit->id) }}" class='btn btn-primary btn-sm mr-2'><i class="fas fa-edit"></i></a>
                   <a href="{{ route('produits.destroy', $produit->id) }}" class='btn btn-danger btn-sm mr' onClick="event.preventDefault(); if(confirm('Etes-vous sur de vouloir supprimer ce produit?'))
                    document.getElementById({{ $produit->id }}).submit()"><i class="fas fa-trash  "></i></a>
                   <form id='{{ $produit->id }}' method="post" action="{{ route('produits.destroy', $produit->id) }}">
                        @csrf
                        @method('delete')
                   </form>
                   </td> --}}
               </tr>
           @endforeach
               
           </tbody>
       </table>