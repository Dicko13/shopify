<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produit::create([
          "designation" => "Sac a main",
          "description" => "La description du sac a main",
          "prix" => 45000
        ]);

        Produit::create([
            "designation" => "Ordinateur",
            "description" => "La description de l'ordinateur",
            "prix" => 250000
          ]);

          Produit::create([
            "designation" => "Telephone",
            "description" => "La description du telephone",
            "prix" => 100000
          ]);
    }
}
