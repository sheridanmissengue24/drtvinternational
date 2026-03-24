<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DRTV Radio')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e50077',
                        secondary: '#ff38c0',
                        soft: '#ffebf7',
                        dark: '#0f0f0f',
                    }
                }
            }
        }
    </script>

    <style>
        /* Wave animation */
        .wave {
            display: flex;
            gap: 4px;
            height: 40px;
            align-items: center;
            justify-content: center;
        }

        .wave span {
            width: 4px;
            height: 10px;
            background: #ff38c0;
            border-radius: 10px;
            animation: wave 1s infinite ease-in-out;
        }

        .wave span:nth-child(2) { animation-delay: 0.1s; }
        .wave span:nth-child(3) { animation-delay: 0.2s; }
        .wave span:nth-child(4) { animation-delay: 0.3s; }
        .wave span:nth-child(5) { animation-delay: 0.4s; }
        .wave span:nth-child(6) { animation-delay: 0.5s; }
        .wave span:nth-child(7) { animation-delay: 0.6s; }

        @keyframes wave {
            0%, 100% { height: 10px; }
            50% { height: 35px; }
        }
    </style>
</head>

<body class="bg-dark text-white min-h-screen flex flex-col">

<header class="flex items-center justify-between px-6 py-4 border-b border-white/10">
    <a href="/" class="font-bold text-lg">DRTV RADIO</a>

    <div class="flex gap-6 text-sm">
        <a href="{{ route('live.tv') }}" class="hover:text-primary">Live TV</a>
        <a href="{{ route('vod.index') }}" class="hover:text-primary">VOD</a>
        <a href="{{ route('contact.index') }}" class="hover:text-primary">Contact</a>
    </div>
</header>

<main class="flex-1">
    @yield('content')
</main>

<footer class="text-center text-gray-400 text-sm py-6 border-t border-white/10">
    © {{ date('Y') }} DRTV INTERNATIONAL HD
</footer>

@stack('scripts')

</body>
</html>