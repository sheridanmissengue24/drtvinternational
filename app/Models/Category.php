<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Actualite;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded=['id']; 
    public function actualites() { 
        return $this->belongsToMany(Actualite::class, 'actualite_category'); 
    }
}
