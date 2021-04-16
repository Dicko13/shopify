<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    public $fillable = ["designation", "description","prix","category_id","image"];

    public function category()
    {
      return $this->belongsTo(Category::class); //relation produit appartient à une catégorie
    }

    public function users()
    {
       return $this->belongsToMany(User::class);
    }
}

