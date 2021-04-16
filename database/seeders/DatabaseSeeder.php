<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\ProduitSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([
           // ProduitSeeder::class,
              CategorySeeder::class,
            //liste de tous les autres seedrers et factories
           ]);
       $this->call([
           // ProduitSeeder::class,
           RoleSeeder::class,
            //liste de tous les autres seedrers et factories
           ]);
         //liste de tous les autres factories
         //Produit::factory(50)->create();
        //Category::factory(50)->create();
        // \App\Models\Produit::factory(50)->create();
        // \App\Models\User::factory(10)->create();
    }
}
