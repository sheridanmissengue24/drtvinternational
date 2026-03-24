<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title','DRTV INTERNATIONAL HD') | {{ env('APP_NAME') }}</title>
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">

  <style>
    :root{
      --accent: #e50077;
      --accent-2: #F40DAB;
      --accent-dark: #A10A66;
      --neutral-bg: #F7F7F8;
      --text-dark: #0B0B0B;
      --white: #FFFFFF;
    }
    .btn-primary{ background: linear-gradient(90deg,var(--accent),var(--accent-2)); color:#fff; }
    .btn-primary:hover{ background: linear-gradient(90deg,var(--accent-dark),var(--accent-2)); }
    .hero-bleed { margin-left: calc((100% - 100vw)/2); margin-right: calc((100% - 100vw)/2); }
  </style>

<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#e50077',
          secondary: '#ff38c0',
          soft: '#ffebf7',
          dark: '#070306',
        }
      }
    }
  }
  </script>

  @stack('head')
</head>
<body class="antialiased font-inter text-gray-900 bg-neutral-100">

  @include('components.header')

  <main>
    @yield('content')
  </main>

    {{-- Banner publicitaire (avant téléchargement app) --}}
  <div class="max-w-7xl mx-auto px-6 mt-10">
    @include('components.ad-component', [
      'tag' => 'SPONSORISÉ',
      'title' => 'Annoncez sur DRTV International',
      'subtitle' => 'Touchez une audience engagée avec des formats premium (TV, Radio, Web).',
      'primaryText' => 'Demander un devis',
      'primaryHref' => route('contact.index'),
      'secondaryText' => 'Télécharger le dossier',
      // 'secondaryHref' => route('apk'),
      // 'imageUrl' => 'https://.../votre-banniere.jpg',
    ])
  </div>

  @include('components.footer')

  <script>
    document.getElementById('menu-toggle')?.addEventListener('click', function(){
      document.getElementById('mobile-nav')?.classList.toggle('hidden');
    });
    document.getElementById('mobile-search-toggle')?.addEventListener('click', function(){
      document.getElementById('mobile-search')?.classList.toggle('hidden');
    });
  </script>

  @include('partials._hls')

  @stack('scripts')
</body>
</html>
