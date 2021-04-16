<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create([
            "profil" => "user",
            
          ]);

        $role2 = Role::create([
            "profil" => "admin",
            
            ]);

        $role3 = Role::create([
            "profil" => "root",
                
            ]);
        
        $user1 = User::create([
            "role_id" => $role1->id,
            "name" => "User User",
            "email" => "user@shopify.com",
            "password" => Hash::make("admin"),
                    
             ]);
        
         $user2 = User::create([
           "role_id" => $role2->id,
           "name" => "Admin",
           "email" => "admin@shopify.com",
           "password" => Hash::make("admin"),
                                
              ]);

         $user3 = User::create([
           "role_id" => $role3->id,
           "name" => "Root",
           "email" => "root@shopify.com",
           "password" => Hash::make("admin"),
                                     
             ]);
    }
}
