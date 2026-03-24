<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/app/Http/Controllers/Admin/ActualiteController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Category;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ActualiteController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $actualites = Actualite::query()
            ->with(['categories'])
            ->when($q !== '', function ($qb) use ($q) {
                $qb->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('chapo', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%")
                        ->orWhere('slug', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.actualites.index', compact('actualites', 'q'));
    }

    public function create(Request $request)
    {
        $categories = $this->loadCategories();
        $authors = $this->loadAuthors();
        $mediaItems = $this->loadMediaItems();

        return view('admin.actualites.create', compact('categories', 'authors', 'mediaItems'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePayload($request);

        $data['slug'] = $this->uniqueSlug(
            (($data['slug'] ?? '') !== '' ? (string) $data['slug'] : (string) $data['title']),
            null
        );

        // normalize tags (string "a, b" => array)
        $data['tags'] = $this->normalizeTags($data['tags'] ?? null);

        // featured image upload (local public disk)
        if ($request->hasFile('featured_image')) {
            $data['featured_image_path'] = $request->file('featured_image')->store('actualites/featured', 'public');
        }

        // published_at normalize (datetime-local or null)
        if (!empty($data['published_at'])) {
            $data['published_at'] = \Carbon\Carbon::parse($data['published_at']);
        } else {
            $data['published_at'] = null;
        }

        $categoryIds = $data['category_ids'] ?? [];
        unset($data['category_ids']);

        $actualite = Actualite::create($data);

        // categories required => enforce link
        $actualite->categories()->sync($categoryIds);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité créée.');
    }

    public function edit(Actualite $actualite)
    {
        $actualite->loadMissing(['categories']);

        $categories = $this->loadCategories();
        $authors = $this->loadAuthors();
        $mediaItems = $this->loadMediaItems();

        return view('admin.actualites.edit', compact('actualite', 'categories', 'authors', 'mediaItems'));
    }

    public function update(Request $request, Actualite $actualite)
    {
        $data = $this->validatePayload($request, $actualite->id);

        $data['slug'] = $this->uniqueSlug(
            (($data['slug'] ?? '') !== '' ? (string) $data['slug'] : (string) $data['title']),
            $actualite->id
        );

        $data['tags'] = $this->normalizeTags($data['tags'] ?? null);

        // remove featured image checkbox
        if (($data['remove_featured_image'] ?? null) === '1') {
            if (!empty($actualite->featured_image_path)) {
                Storage::disk('public')->delete($actualite->featured_image_path);
            }
            $data['featured_image_path'] = null;
        }
        unset($data['remove_featured_image']);

        // replace featured image
        if ($request->hasFile('featured_image')) {
            if (!empty($actualite->featured_image_path)) {
                Storage::disk('public')->delete($actualite->featured_image_path);
            }
            $data['featured_image_path'] = $request->file('featured_image')->store('actualites/featured', 'public');
        }

        if (!empty($data['published_at'])) {
            $data['published_at'] = \Carbon\Carbon::parse($data['published_at']);
        } else {
            $data['published_at'] = null;
        }

        $categoryIds = $data['category_ids'] ?? [];
        unset($data['category_ids']);

        $actualite->update($data);
        $actualite->categories()->sync($categoryIds);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité mise à jour.');
    }

    public function destroy(Actualite $actualite)
    {
        if (!empty($actualite->featured_image_path)) {
            Storage::disk('public')->delete($actualite->featured_image_path);
        }

        $actualite->delete();

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité supprimée.');
    }

    private function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        // categories required (each info must be linked to a category)
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('actualites', 'slug')->ignore($ignoreId)],
            'chapo' => ['nullable', 'string'],
            'content' => ['required', 'string'],

            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],

            'author_id' => ['nullable', 'integer'], // adapt if you have users table constraint
            'tags' => ['nullable', 'string'],

            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:1000'],

            'featured_image' => ['nullable', 'file', 'image', 'max:5120'],
            'remove_featured_image' => ['nullable', Rule::in(['0', '1'])],

            'media_type' => ['nullable', Rule::in(['image', 'video'])],
            'featured_media_id' => ['nullable', 'integer'],

            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
        ]);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value);
        $base = $base !== '' ? $base : Str::random(8);

        $slug = $base;
        $i = 1;

        while (
            Actualite::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function normalizeTags(?string $raw): array
    {
        if ($raw === null) {
            return [];
        }

        $raw = trim($raw);
        if ($raw === '') {
            return [];
        }

        $parts = preg_split('/\s*,\s*/', $raw) ?: [];
        $parts = array_values(array_filter(array_map('trim', $parts), fn ($v) => $v !== ''));
        $parts = array_values(array_unique($parts));

        return $parts;
    }

    private function loadCategories()
    {
        if (!(Schema::hasTable('categories') && class_exists(Category::class))) {
            return collect();
        }

        try {
            return Category::query()->orderBy('name')->get();
        } catch (\Throwable $e) {
            return collect();
        }
    }

    private function loadAuthors()
    {
        // If you have a User model, swap in App\Models\User and load it.
        // Keeping a best-effort approach to avoid breaking if authors source differs.
        if (!class_exists(\App\Models\User::class)) {
            return collect();
        }

        try {
            return \App\Models\User::query()->orderBy('name')->get();
        } catch (\Throwable $e) {
            return collect();
        }
    }

    private function loadMediaItems()
    {
        if (!(Schema::hasTable('media_items') && class_exists(MediaItem::class))) {
            return collect();
        }

        try {
            return MediaItem::query()->orderByDesc('created_at')->take(200)->get();
        } catch (\Throwable $e) {
            return collect();
        }
    }
}