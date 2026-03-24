<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveStream; 

class LiveStreamController extends Controller
{
    public function tv(){ 
        $livetv=LiveStream::where('type','tv')
        ->where('status', 'active')
        ->first();

        return view('pages.live.index',compact('livetv'));
    }

    public function radio(){ 
        $liveradio=LiveStream::where('type','radio')
        ->where('status', 'active')
        ->first();

        return view('pages.live.radio',compact('liveradio'));
     }
}
