<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaItem;

class VodVideoController extends Controller
{
    public function index()
    {
        $videos = MediaItem::where('type', 'video')
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        return view('pages.vod.index', compact('videos'));
    }

    public function show($id)
    {
        $video = MediaItem::where('type', 'video')
            ->where('status', 'published')
            ->whereId($id)->first();

        return view('pages.vod.show', compact('video'));
    }
}

