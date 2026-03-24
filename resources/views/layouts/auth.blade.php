{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/layouts/auth.blade.php --}}
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'Connexion') | {{ env('APP_NAME') }}</title>
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

  {{-- Tailwind CDN (comme le reste de ton projet) --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --accent: #e50077;
      --accent-2: #F40DAB;
      --accent-dark: #A10A66;
      --white: #FFFFFF;
      --bg: #070306;
    }

    html, body { height: 100%; }
    body { font-family: Inter, ui-sans-serif, system-ui; background: var(--bg); }

    /* Brand helpers */
    .drtv-grad { background: linear-gradient(90deg, var(--accent), var(--accent-2)); }
    .drtv-ring { box-shadow: 0 0 0 1px rgba(255,255,255,0.10) inset; }

    /* Subtle float animation */
    @keyframes floaty {
      0%,100% { transform: translateY(0px); }
      50% { transform: translateY(-6px); }
    }
    .anim-floaty { animation: floaty 7s ease-in-out infinite; }

    /* Soft shine sweep on hover */
    @keyframes sweep {
      0% { transform: translateX(-120%) skewX(-18deg); opacity: 0; }
      20% { opacity: .55; }
      60% { opacity: .25; }
      100% { transform: translateX(120%) skewX(-18deg); opacity: 0; }
    }
    .btn-sweep { position: relative; overflow: hidden; }
    .btn-sweep::after{
      content: "";
      position:absolute; inset:-20% auto -20% -40%;
      width: 55%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
      filter: blur(0.2px);
      transform: translateX(-120%) skewX(-18deg);
      opacity: 0;
    }
    .btn-sweep:hover::after{ animation: sweep 900ms ease-out; }

    /* Respect reduced motion */
    @media (prefers-reduced-motion: reduce) {
      .anim-floaty, .btn-sweep:hover::after { animation: none !important; }
    }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { dark: '#070306' },
          fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] }
        }
      }
    }
  </script>

  @stack('head')
</head>

<body class="text-white">
  {{-- Background --}}
  <div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.07]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 34px 34px;"></div>

    <div class="absolute -top-24 -left-24 h-[420px] w-[420px] rounded-full blur-3xl opacity-35 anim-floaty"
         style="background: radial-gradient(circle, rgba(229,0,119,0.55), transparent 62%);"></div>

    <div class="absolute -bottom-28 -right-28 h-[520px] w-[520px] rounded-full blur-3xl opacity-25 anim-floaty"
         style="animation-delay: -2s; background: radial-gradient(circle, rgba(0,206,255,0.35), transparent 62%);"></div>

    <div class="absolute inset-0"
         style="background: radial-gradient(900px 340px at 80% 0%, rgba(244,13,171,0.14), transparent 62%);"></div>
  </div>

  <main class="min-h-screen px-4 sm:px-6 flex items-center justify-center py-10">
    <div class="w-full max-w-md">
      @yield('content')

      <div class="mt-6 text-center text-xs text-white/45">
        © {{ date('Y') }} {{ env('APP_NAME') }}. Tous droits réservés.
      </div>
    </div>
  </main>

  @stack('scripts')
</body>
</html>