<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/app/Models/Actualite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $table = 'actualites';

    protected $fillable = [
        'title',
        'slug',
        'chapo',
        'content',
        'featured_media_id',
        'featured_image_path',
        'media_type',
        'status',
        'author_id',
        'tags',
        'seo_title',
        'seo_description',
        'views_count',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function featuredMedia()
    {
        return $this->belongsTo(MediaItem::class, 'featured_media_id');
    }

    public function categories() { 
        return $this->belongsToMany(Category::class, 'actualite_category'); 
    }

}