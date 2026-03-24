<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Category;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    public function index(Request $request)
{
    $q = trim((string) $request->query('q', ''));
    $categoryId = $request->query('category');

    $categories = \App\Models\Category::query()->orderBy('name')->get();

    $actualites = \App\Models\Actualite::query()
        ->with(['categories', 'featuredMedia'])
        ->when($q !== '', function ($qb) use ($q) {
            $qb->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('chapo', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        })
        ->when($categoryId, function ($qb) use ($categoryId) {
            $qb->whereHas('categories', fn ($q2) => $q2->where('categories.id', $categoryId));
        })
        ->orderByDesc('published_at')
        ->orderByDesc('created_at')
        ->paginate(12)
        ->withQueryString();

    return view('pages.actualites.index', compact('actualites', 'categories'));
}

    public function show($slug)
    {
        $actualite = Actualite::with(['featuredMedia', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // incrément des vues
        $actualite->increment('views_count');

        $related = Actualite::where('id', '!=', $actualite->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('pages.actualites.show', compact('actualite', 'related'));
    }
}
