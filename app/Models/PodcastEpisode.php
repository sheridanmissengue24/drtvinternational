<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MediaItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PodcastEpisode extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    public function media() { 
        return $this->belongsTo(MediaItem::class); 
    }
}
