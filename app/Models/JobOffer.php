<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOffer extends Model
{
    use HasFactory; 
    protected $guarded =['id']; 
    public function applications() {
         return $this->hasMany(Application::class); 
        }
}
