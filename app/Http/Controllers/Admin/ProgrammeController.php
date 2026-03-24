<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/app/Http/Controllers/Admin/ProgrammeController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProgrammeController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $programmes = Programme::query()
            ->when($q !== '', function ($qb) use ($q) {
                $qb->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('slug', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.programmes.index', compact('programmes', 'q'));
    }

    public function create()
    {
        return view('admin.programmes.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatePayload($request);

        $data['slug'] = $this->uniqueSlug(
            (($data['slug'] ?? '') !== '' ? (string) $data['slug'] : (string) $data['title']),
            null
        );

        // Store cover locally (public disk => storage/app/public)
        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->store('programmes/covers', 'public');
        }

        Programme::create($data);

        return redirect()->route('admin.programmes.index')->with('success', 'Programme créé.');
    }

    public function edit(Programme $programme)
    {
        return view('admin.programmes.edit', compact('programme'));
    }

    public function update(Request $request, Programme $programme)
    {
        $data = $this->validatePayload($request, $programme->id);

        $data['slug'] = $this->uniqueSlug(
            (($data['slug'] ?? '') !== '' ? (string) $data['slug'] : (string) $data['title']),
            $programme->id
        );

        // Remove cover checkbox
        if (($data['remove_cover_image'] ?? null) === '1') {
            if (!empty($programme->cover_image_path)) {
                Storage::disk('public')->delete($programme->cover_image_path);
            }
            $data['cover_image_path'] = null;
        }
        unset($data['remove_cover_image']);

        // Replace cover
        if ($request->hasFile('cover_image')) {
            if (!empty($programme->cover_image_path)) {
                Storage::disk('public')->delete($programme->cover_image_path);
            }
            $data['cover_image_path'] = $request->file('cover_image')->store('programmes/covers', 'public');
        }

        $programme->update($data);

        return redirect()->route('admin.programmes.index')->with('success', 'Programme mis à jour.');
    }

    public function destroy(Programme $programme)
    {
        if (!empty($programme->cover_image_path)) {
            Storage::disk('public')->delete($programme->cover_image_path);
        }

        $programme->delete();

        return redirect()->route('admin.programmes.index')->with('success', 'Programme supprimé.');
    }

    private function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('programmes', 'slug')->ignore($ignoreId)],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in(['draft', 'published'])],

            'cover_image' => ['nullable', 'file', 'image', 'max:5120'], // 5MB
            'remove_cover_image' => ['nullable', Rule::in(['0', '1'])],
        ]);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value);
        $base = $base !== '' ? $base : Str::random(8);

        $slug = $base;
        $i = 1;

        while (
            Programme::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}