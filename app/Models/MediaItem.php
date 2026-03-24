<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaItem extends Model
{
    use HasFactory; 
    protected $guarded=['id']; 
    public function creator() {
         return $this->belongsTo(User::class, 'created_by'); 
        }
}
