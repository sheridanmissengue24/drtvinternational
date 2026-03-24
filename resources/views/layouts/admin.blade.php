{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/layouts/admin.blade.php --}}
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title','Administration') | {{ env('APP_NAME') }}</title>
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

  {{-- Tailwind CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --accent: #e50077;
      --accent-2: #F40DAB;
      --accent-dark: #A10A66;
      --white: #FFFFFF;
    }

    /* Small helpers for brand effects */
    .drtv-grad {
      background: linear-gradient(90deg, var(--accent), var(--accent-2));
    }
    .drtv-glow {
      box-shadow:
        0 0 0 1px rgba(255,255,255,0.06) inset,
        0 30px 90px -50px rgba(0,0,0,0.90),
        0 0 40px rgba(229,0,119,0.10);
    }
    .drtv-ring {
      box-shadow: 0 0 0 1px rgba(255,255,255,0.10) inset;
    }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#e50077',
            secondary: '#F40DAB',
            dark: '#070306',
          },
          fontFamily: {
            sans: ['Inter', 'ui-sans-serif', 'system-ui'],
          },
          boxShadow: {
            soft: '0 30px 90px -40px rgba(0,0,0,0.85)',
          }
        }
      }
    }
  </script>

  @stack('head')
</head>

<body class="bg-dark text-white font-sans">
  <div class="min-h-screen">

    {{-- Mobile topbar (brand) --}}
    <header class="lg:hidden sticky top-0 z-40 bg-dark/80 backdrop-blur ring-1 ring-white/10">
      <div class="relative px-4 py-3">
        <div class="pointer-events-none absolute inset-0 opacity-70"
             style="background: radial-gradient(900px 200px at 15% -10%, rgba(229,0,119,0.18), transparent 60%),
                            radial-gradient(900px 220px at 90% 0%, rgba(244,13,171,0.14), transparent 62%);"></div>

        <div class="relative flex items-center justify-between">
          <button type="button"
                  data-admin-nav-open
                  class="inline-flex items-center justify-center rounded-2xl bg-white/8 ring-1 ring-white/10 px-3 py-2 text-sm font-semibold text-white/90 hover:bg-white/12 transition">
            Menu
          </button>

          <div class="min-w-0 text-sm font-extrabold tracking-tight text-white/95 truncate">
            @yield('header','Administration')
          </div>

          <a href="{{ route('actualites.index') }}"
             class="inline-flex items-center justify-center rounded-2xl bg-white/8 ring-1 ring-white/10 px-3 py-2 text-sm font-semibold text-white/85 hover:bg-white/12 transition">
            Site
          </a>
        </div>
      </div>
    </header>

    {{-- Overlay mobile --}}
    <div data-admin-nav-overlay class="fixed inset-0 z-40 hidden bg-black/70 lg:hidden"></div>

    {{-- Sidebar / Drawer --}}
    <aside data-admin-nav
           class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full lg:translate-x-0 transition-transform duration-200
                  bg-dark/92 backdrop-blur ring-1 ring-white/10">
      <div class="h-full flex flex-col">

        {{-- Drawer header (mobile) --}}
        <div class="lg:hidden flex items-center justify-between px-4 py-3 ring-1 ring-white/10">
          <div class="text-sm font-extrabold text-white/90">Navigation</div>
          <button type="button"
                  data-admin-nav-close
                  class="inline-flex items-center justify-center rounded-2xl bg-white/8 ring-1 ring-white/10 px-3 py-2 text-sm font-semibold text-white/90 hover:bg-white/12 transition">
            Fermer
          </button>
        </div>

        <div class="flex-1 overflow-y-auto px-4 py-4 lg:py-6">
          {{-- Brand card --}}
          <a href="{{ route('admin.dashboard') }}"
             class="relative block overflow-hidden rounded-3xl ring-1 ring-white/10 p-4 drtv-glow">
            <div class="pointer-events-none absolute inset-0 opacity-80"
                 style="background: radial-gradient(700px 220px at 10% 0%, rgba(229,0,119,0.22), transparent 62%),
                                radial-gradient(700px 220px at 95% 0%, rgba(244,13,171,0.18), transparent 62%);"></div>

            <div class="relative">
              <div class="text-xs font-semibold uppercase tracking-wider text-white/60">DRTV</div>
              <div class="mt-1 text-lg font-extrabold text-white/95">Administration</div>
              <div class="mt-1 text-xs text-white/55">Gestion des contenus</div>

              <div class="mt-3 h-1.5 w-20 rounded-full drtv-grad"></div>
            </div>
          </a>

          @php
            $rname = request()->route()?->getName() ?? '';
            $navItem = function (string $startsWith) use ($rname) {
              $active = str_starts_with($rname, $startsWith);
              return $active
                ? 'bg-white/12 ring-white/15'
                : 'bg-white/6 ring-white/10 hover:bg-white/10 hover:ring-white/15';
            };
          @endphp

          {{-- Navigation --}}
          <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}"
               class="mt-2 group flex items-center justify-between rounded-2xl px-4 py-3 ring-1 transition {{ $navItem('admin.dashboard') }}">
              <span class="font-semibold text-white/85 truncate">Dashboard</span>
              <span class="text-white/35 group-hover:text-white/65 transition shrink-0">→</span>
            </a>

            <a href="{{ route('admin.actualites.index') }}"
               class="mt-2 group flex items-center justify-between rounded-2xl px-4 py-3 ring-1 transition {{ $navItem('admin.actualites') }}">
              <span class="font-semibold text-white/85 truncate">Actualités</span>
              <span class="text-white/35 group-hover:text-white/65 transition shrink-0">→</span>
            </a>

            <a href="{{ route('admin.programmes.index') }}"
               class="mt-2 group flex items-center justify-between rounded-2xl px-4 py-3 ring-1 transition {{ $navItem('admin.programmes') }}">
              <span class="font-semibold text-white/85 truncate">Programmes</span>
              <span class="text-white/35 group-hover:text-white/65 transition shrink-0">→</span>
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="mt-2 group flex items-center justify-between rounded-2xl px-4 py-3 ring-1 transition {{ $navItem('admin.categories') }}">
              <span class="font-semibold text-white/85 truncate">Catégories</span>
              <span class="text-white/35 group-hover:text-white/65 transition shrink-0">→</span>
            </a>

            <a href="{{ route('admin.urgent.index') }}"
               class="mt-2 group flex items-center justify-between rounded-2xl px-4 py-3 ring-1 transition {{ $navItem('admin.urgent') }}">
              <span class="font-semibold text-white/85 truncate">Urgent</span>
              <span class="text-white/35 group-hover:text-white/65 transition shrink-0">→</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
              class="mt-2 group flex items-center justify-between rounded-2xl px-4 py-3 ring-1 transition {{ $navItem('admin.users') }}">
              <span class="font-semibold text-white/85 truncate">Utilisateurs</span>
              <span class="text-white/35 group-hover:text-white/65 transition shrink-0">→</span>
            </a>

            <a href="{{ route('actualites.index') }}"
               class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm font-semibold text-white/90 hover:bg-white/10 hover:ring-white/15 transition">
              Retour au site
            </a>
          </nav>
        </div>

        {{-- Sidebar footer --}}
        <div class="px-4 py-4 ring-1 ring-white/10">
          <div class="text-xs text-white/55">
            Connecté :
            <span class="text-white/80 font-semibold">{{ auth()->user()->name ?? 'Admin' }}</span>
          </div>

          @if(\Illuminate\Support\Facades\Route::has('logout'))
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
              @csrf
              <button class="w-full rounded-2xl bg-white/10 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
                Déconnexion
              </button>
            </form>
          @endif
        </div>
      </div>
    </aside>

    {{-- Main --}}
    <div class="lg:pl-72">
      {{-- Desktop header (brand) --}}
      <header class="hidden lg:block sticky top-0 z-30 bg-dark/75 backdrop-blur ring-1 ring-white/10">
        <div class="relative">
          <div class="pointer-events-none absolute inset-0 opacity-75"
               style="background: radial-gradient(1000px 240px at 20% -10%, rgba(229,0,119,0.16), transparent 62%),
                              radial-gradient(900px 240px at 90% 0%, rgba(244,13,171,0.12), transparent 62%);"></div>

          <div class="relative mx-auto w-full max-w-7xl px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between gap-4">
              <div class="min-w-0">
                <div class="text-xl font-extrabold tracking-tight text-white/95 truncate">
                  @yield('header','Administration')
                </div>
                @hasSection('subheader')
                  <div class="mt-1 text-sm text-white/60">@yield('subheader')</div>
                @endif
              </div>

              <div class="flex items-center gap-2">
                @stack('admin_actions')
                <a href="{{ route('actualites.index') }}"
                   class="hidden xl:inline-flex items-center justify-center rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/85 hover:bg-white/12 transition">
                  Site
                </a>
              </div>
            </div>
          </div>
        </div>
      </header>

      <main class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        @if(session('success'))
          <div class="mb-4 rounded-2xl bg-emerald-400/10 ring-1 ring-emerald-400/20 px-4 py-3 text-sm text-emerald-50">
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="mb-4 rounded-2xl bg-red-500/10 ring-1 ring-red-500/20 px-4 py-3 text-sm text-red-50">
            <div class="font-semibold">Erreur(s)</div>
            <ul class="mt-2 list-disc pl-5">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @yield('content')
      </main>
    </div>

  </div>

  <script>
    (function () {
      const nav = document.querySelector('[data-admin-nav]');
      const overlay = document.querySelector('[data-admin-nav-overlay]');
      const openBtn = document.querySelector('[data-admin-nav-open]');
      const closeBtn = document.querySelector('[data-admin-nav-close]');

      if (!nav || !overlay || !openBtn || !closeBtn) return;

      const open = () => {
        nav.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.documentElement.classList.add('overflow-hidden');
      };

      const close = () => {
        nav.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.documentElement.classList.remove('overflow-hidden');
      };

      openBtn.addEventListener('click', open);
      closeBtn.addEventListener('click', close);
      overlay.addEventListener('click', close);

      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close();
      });

      nav.addEventListener('click', (e) => {
        const a = e.target.closest('a');
        if (!a) return;
        if (window.matchMedia('(max-width: 1023px)').matches) close();
      });
    })();
  </script>

  @stack('scripts')
</body>
</html>