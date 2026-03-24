<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmissionController extends Controller
{
    public function index(){ 
        return view('pages.emissions.index');
    }
}
