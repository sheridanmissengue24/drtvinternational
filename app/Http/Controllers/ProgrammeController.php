<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/app/Http/Controllers/ProgrammeController.php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));

        $query = Programme::query()->where('is_active', true);

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($category !== '') {
            $query->where('category', $category);
        }

        $programmes = $query
            ->orderByDesc('is_featured')
            ->orderByRaw('starts_at is null') // ceux avec horaire d'abord
            ->orderBy('starts_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $categories = Programme::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('pages.programmes.index', compact('programmes', 'categories', 'q', 'category'));
    }

    public function show(Programme $programme)
    {
        abort_unless((bool) $programme->is_active, 404);

        return view('pages.programmes.show', compact('programme'));
    }
}