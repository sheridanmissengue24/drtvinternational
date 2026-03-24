<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use App\Models\Actualite;
use App\Models\Category;
use App\Models\MediaItem;
use App\Models\UrgentInfo;
use App\Models\LiveStream;
use App\Models\Programme;

class HomeController extends Controller
{
    /**
     * Page d'accueil.
     */
    public function index(Request $request)
    {
        $enableCache = filter_var(env('DRTV_ENABLE_CACHE', true), FILTER_VALIDATE_BOOLEAN);

        $cacheKey = $this->buildCacheKey($request->query());

        $data = $enableCache
            ? Cache::remember($cacheKey, 60, fn () => $this->gatherData($request))
            : $this->gatherData($request);

        return view('index', $data);
    }

    /**
     * Rassemble les données nécessaires pour la home.
     */
    protected function gatherData(Request $request): array
    {
        $categorySlug = $request->query('category');
        $q = trim($request->query('q', ''));

        // Base query for latest news.
        $newsQuery = Actualite::query()
            ->where('status', 'published')
            // NULL published_at last, then desc.
            ->orderByRaw('CASE WHEN published_at IS NULL THEN 1 ELSE 0 END')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');

        // Safe eager loads (only if relations exist on the model)
        if (method_exists(Actualite::class, 'featuredMedia')) {
            $newsQuery->with('featuredMedia');
        }
        if (method_exists(Actualite::class, 'categories')) {
            $newsQuery->with('categories');
        }
        if (method_exists(Actualite::class, 'author')) {
            $newsQuery->with('author');
        }

        // Filters
        if (!empty($categorySlug) && Schema::hasTable('categories') && method_exists(Actualite::class, 'categories')) {
            $newsQuery->whereHas('categories', function ($builder) use ($categorySlug) {
                $builder->where('slug', $categorySlug);
            });
        }

        if ($q !== '') {
            $newsQuery->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('chapo', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        // For the "Dernières actus" section (cards with images handled in Blade component)
        $latestNews = (clone $newsQuery)->take(6)->get();

        // Categories (for filters/UI)
        $categories = collect();
        if (Schema::hasTable('categories') && class_exists(Category::class)) {
            try {
                $categories = Category::query()->orderBy('name')->get();
            } catch (\Throwable $e) {
                $categories = collect();
            }
        }

        // Featured live stream (existing behavior, best-effort)
        $featuredLive = null;
        if (Schema::hasTable('live_streams') && class_exists(LiveStream::class)) {
            try {
                $featuredLive = LiveStream::query()
                    ->where('is_featured', true)
                    ->orderByDesc('starts_at')
                    ->first();

                if (!$featuredLive) {
                    $featuredLive = LiveStream::query()
                        ->orderByDesc('starts_at')
                        ->first();
                }
            } catch (\Throwable $e) {
                $featuredLive = null;
            }
        }

        // Urgent info (existing behavior)
        $urgent = null;
        if (Schema::hasTable('urgent_infos') && class_exists(UrgentInfo::class)) {
            try {
                // If scope exists, use it; otherwise fallback to a simple query
                if (method_exists(UrgentInfo::class, 'scopeCurrentlyActive')) {
                    $urgent = UrgentInfo::currentlyActive()
                        ->orderByDesc('starts_at')
                        ->first();
                } else {
                    $urgent = UrgentInfo::query()
                        ->orderByDesc('starts_at')
                        ->first();
                }
            } catch (\Throwable $e) {
                $urgent = null;
            }
        }

        // Media highlights (optional; keep as empty if not needed)
        $mediaHighlights = collect();
        if (Schema::hasTable('media_items') && class_exists(MediaItem::class)) {
            try {
                $mediaHighlights = MediaItem::query()
                    ->orderByDesc('created_at')
                    ->take(8)
                    ->get();
            } catch (\Throwable $e) {
                $mediaHighlights = collect();
            }
        }

        // APK info (existing behavior)
        $apkUrl = $apkVersion = $apkNotes = null;
        if (Schema::hasTable('settings')) {
            try {
                $apkUrl = optional(DB::table('settings')->where('key', 'apk_url')->first())->value ?? null;
                $apkVersion = optional(DB::table('settings')->where('key', 'apk_version')->first())->value ?? null;
                $apkNotes = optional(DB::table('settings')->where('key', 'apk_notes')->first())->value ?? null;
            } catch (\Throwable $e) {
                $apkUrl = $apkVersion = $apkNotes = null;
            }
        }

        // Programmes (best-effort)
        $programmes = collect();
        if (Schema::hasTable('programmes') && class_exists(Programme::class)) {
            try {
                $programmes = Programme::query()
                    ->orderByDesc('created_at')
                    ->take(6)
                    ->get();
            } catch (\Throwable $e) {
                $programmes = collect();
            }
        }

        return compact(
            'latestNews',
            'categories',
            'featuredLive',
            'urgent',
            'mediaHighlights',
            'apkUrl',
            'apkVersion',
            'apkNotes',
            'programmes'
        );
    }

    /**
     * Construit une clé cache basée sur query params pertinents.
     */
    protected function buildCacheKey(array $queryParams = []): string
    {
        $relevant = [
            'category' => $queryParams['category'] ?? '',
            'q' => $queryParams['q'] ?? '',
        ];

        return 'home:' . md5(serialize($relevant));
    }

    public function apk(){
        return view('pages.apk');
    }
}
