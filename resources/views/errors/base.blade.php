{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/errors/layout.blade.php --}}
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />

  @php
    $appName = config('app.name', env('APP_NAME', 'DRTV'));
    $title = trim($__env->yieldContent('title', 'Erreur'));
    $description = trim($__env->yieldContent('description', 'Une erreur est survenue.'));
    $canonical = url()->current();
  @endphp

  <title>{{ $title }} | {{ $appName }}</title>
  <meta name="description" content="{{ $description }}">
  <meta name="robots" content="noindex,nofollow">
  <link rel="canonical" href="{{ $canonical }}">
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --accent: #e50077;
      --accent-2: #F40DAB;
      --accent-dark: #A10A66;
      --bg: #070306;
    }
    html, body { height: 100%; }
    body { font-family: Inter, ui-sans-serif, system-ui; background: var(--bg); }
    .drtv-grad { background: linear-gradient(90deg, var(--accent), var(--accent-2)); }
    .drtv-ring { box-shadow: 0 0 0 1px rgba(255,255,255,0.10) inset; }
  </style>
</head>
<body class="text-white">
  <div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 34px 34px;"></div>
    <div class="absolute -top-24 -left-24 h-[420px] w-[420px] rounded-full blur-3xl opacity-30"
         style="background: radial-gradient(circle, rgba(229,0,119,0.55), transparent 62%);"></div>
    <div class="absolute -bottom-28 -right-28 h-[520px] w-[520px] rounded-full blur-3xl opacity-20"
         style="background: radial-gradient(circle, rgba(0,206,255,0.35), transparent 62%);"></div>
    <div class="absolute inset-0"
         style="background: radial-gradient(900px 340px at 80% 0%, rgba(244,13,171,0.14), transparent 62%);"></div>
  </div>

  <main class="min-h-screen px-4 sm:px-6 flex items-center justify-center py-10">
    <div class="w-full max-w-2xl">
      <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="{{ $appName }}" class="h-14 sm:h-16 w-auto object-contain">
      </div>

      <section class="relative overflow-hidden rounded-3xl ring-1 ring-white/10 bg-white/6 backdrop-blur drtv-ring shadow-[0_30px_90px_-50px_rgba(0,0,0,0.9)]">
        <div class="pointer-events-none absolute inset-0 opacity-70"
             style="background: radial-gradient(800px 240px at 12% 0%, rgba(229,0,119,0.18), transparent 60%),
                            radial-gradient(800px 240px at 92% 0%, rgba(244,13,171,0.14), transparent 62%);"></div>

        <div class="relative p-6 sm:p-8">
          @yield('content')

          <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
            <div class="flex gap-2">
              <a href="{{ url('/') }}"
                 class="rounded-2xl px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
                 style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
                Accueil
              </a>
              <a href="{{ url()->previous() }}"
                 class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/85 hover:bg-white/12 transition">
                Retour
              </a>
            </div>

            @guest
              {{-- @if(\Illuminate\Support\Facades\Route::has('login'))
                <a href="{{ route('login') }}"
                   class="text-sm font-semibold text-white/80 hover:text-white transition underline underline-offset-4">
                  Se connecter
                </a>
              @endif --}}
            @endguest
          </div>
        </div>
      </section>

      <div class="mt-6 text-center text-xs text-white/45">
        © {{ date('Y') }} {{ $appName }}.
      </div>
    </div>
  </main>
</body>
</html>