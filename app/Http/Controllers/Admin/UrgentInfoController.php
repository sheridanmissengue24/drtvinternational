<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/app/Http/Controllers/Admin/UrgentInfoController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UrgentInfo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UrgentInfoController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $active = $request->query('active', null);
        $level = $request->query('level', null);

        $urgentInfos = UrgentInfo::query()
            ->when($q !== '', function ($qb) use ($q) {
                $qb->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('message', 'like', "%{$q}%");
                });
            })
            ->when($active !== null && $active !== '', function ($qb) use ($active) {
                $qb->where('active', filter_var($active, FILTER_VALIDATE_BOOLEAN));
            })
            ->when($level !== null && $level !== '', function ($qb) use ($level) {
                $qb->where('level', $level);
            })
            ->orderByDesc('active')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $levels = UrgentInfo::LEVELS;

        return view('admin.urgent_infos.index', compact('urgentInfos', 'q', 'active', 'level', 'levels'));
    }

    public function create()
    {
        $levels = UrgentInfo::LEVELS;

        return view('admin.urgent_infos.create', compact('levels'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePayload($request);

        // normalize checkbox
        $data['active'] = (bool) ($data['active'] ?? false);

        UrgentInfo::create($data);

        return redirect()->route('admin.urgent.index')->with('success', 'Urgent info créée.');
    }

    public function edit(UrgentInfo $urgent)
    {
        $levels = UrgentInfo::LEVELS;

        return view('admin.urgent_infos.edit', compact('urgent', 'levels'));
    }

    public function update(Request $request, UrgentInfo $urgent)
    {
        $data = $this->validatePayload($request);

        $data['active'] = (bool) ($data['active'] ?? false);

        $urgent->update($data);

        return redirect()->route('admin.urgent.index')->with('success', 'Urgent info mise à jour.');
    }

    public function destroy(UrgentInfo $urgent)
    {
        $urgent->delete();

        return redirect()->route('admin.urgent.index')->with('success', 'Urgent info supprimée.');
    }

    private function validatePayload(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'level' => ['required', Rule::in(UrgentInfo::LEVELS)],
            'active' => ['nullable', Rule::in(['0', '1'])],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);
    }
}