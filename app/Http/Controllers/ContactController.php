<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // PLUS TARD :
        // - enregistrer en DB
        // - envoyer email
        // - notifier admin

        return back()->with('success', 'Votre message a bien été envoyé.');
    }
}
