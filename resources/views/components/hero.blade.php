{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/components/hero.blade.php --}}
@props([
  'featuredLive' => null,
  'title' => "Tout le monde en parle!",
  'subtitle' => "Information • Éducation • Divertissement • Live, en replay et en mobilité",
  'ctaPrimaryText' => 'Regarder le Live',
  'ctaSecondaryText' => 'Nous contacter',
  'ctaSecText' => 'Ecouter la DRN1',
  // Optionnel: passer un flux radio depuis la page
  'radioStreamUrl' => 'https://streaming.nrjaudio.fm/oumvmk8fnozc?origine=fluxradios',
])

<section class="hero-bleed relative w-full overflow-hidden bg-dark text-white">
  {{-- Background accents (aligné radio) --}}
  <div class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full blur-3xl opacity-30"
         style="background: radial-gradient(circle, var(--accent), transparent 60%);"></div>
    <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full blur-3xl opacity-25"
         style="background: radial-gradient(circle, var(--accent-2), transparent 60%);"></div>

    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 32px 32px;"></div>

    <div class="absolute inset-0"
         style="background: radial-gradient(800px 320px at 50% 35%, rgba(255,255,255,0.10), transparent 60%);"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-6 py-16 lg:py-24">
    <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:items-center">
      {{-- Texte --}}
      <div class="lg:col-span-7">
        <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm">
          <span class="inline-flex h-2 w-2 rounded-full"
                style="background: var(--accent); box-shadow: 0 0 18px var(--accent);"></span>
          <span class="font-medium tracking-wide">EN DIRECT</span>
          <span class="text-white/60">• DRTV</span>
        </div>

        <h1 class="mt-5 text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
          {{ $title }}
        </h1>

        <p class="mt-4 max-w-2xl text-base text-white/75 sm:text-lg">
          {{ $subtitle }}
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
          <a href="{{ route('live.tv') }}"
             class="inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
             style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
            {{ $ctaPrimaryText }}
          </a>

          <a href="{{ route('contact.index') }}"
             class="inline-flex items-center justify-center rounded-full border border-white/15 bg-white/5 px-6 py-3 text-sm font-semibold text-white hover:bg-white/10 transition">
            {{ $ctaSecondaryText }}
          </a>

          <a href="{{ route('live.radio') }}"
             class="inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
             style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
            {{ $ctaSecText }}
          </a>

        </div>

        {{-- <div class="mt-8 flex flex-wrap gap-3 text-xs text-white/60">
          <span class="rounded-full border border-white/10 bg-black/20 px-3 py-2">Streaming</span>
          <span class="rounded-full border border-white/10 bg-black/20 px-3 py-2">Replays</span>
          <span class="rounded-full border border-white/10 bg-black/20 px-3 py-2">Mobile</span>
        </div> --}}
      </div>

      {{-- Carte visuelle (glass) + lecteur radio --}}
      <div class="lg:col-span-5">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-5 shadow-2xl backdrop-blur-md md:p-6">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="grid h-11 w-11 place-items-center rounded-xl"
                   style="background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 3a1 1 0 0 1 1 1v16a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1Zm6 3a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1ZM6 7a1 1 0 0 1 1 1v8a1 1 0 1 1-2 0V8a1 1 0 0 1 1-1Z"/>
                </svg>
              </div>

              <div class="min-w-0">
                <div class="truncate text-sm font-semibold">Antenne DRTV / DRN1</div>
                <div class="truncate text-xs text-white/60">
                  {{ is_array($featuredLive) ? ($featuredLive['title'] ?? 'Live en cours') : ($featuredLive->title ?? 'Live en cours') }}
                </div>
              </div>
            </div>

            <span class="rounded-full border border-white/10 bg-red-700 px-3 py-1 text-xs text-white/70">
              LIVE
            </span>
          </div>

          {{-- Mini lecteur radio intégré --}}
          <div class="mt-5 rounded-xl border border-white/10 bg-black/20 p-4">
            <div class="flex items-center justify-between gap-4">
              <div class="min-w-0">
                <div class="text-xs text-white/60">Radio</div>
                <div id="heroRadioStatus" class="truncate text-sm font-semibold">Prêt</div>
              </div>

              <div class="flex items-center gap-2">
                <button id="heroRadioBtn"
                        class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold text-white shadow-lg transition active:scale-[0.99]"
                        style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
                  <span id="heroRadioIcon">▶</span>
                  <span id="heroRadioLabel">Écouter</span>
                </button>

                <input id="heroRadioVol" type="range" min="0" max="1" step="0.01" value="0.8"
                       class="h-1.5 w-20 cursor-pointer accent-pink-500">
              </div>
            </div>

            {{-- waveform décorative (simple) --}}
            <div class="mt-4 flex items-end gap-1.5 overflow-hidden" aria-hidden="true">
              @for ($i = 0; $i < 44; $i++)
                <span class="hero-bar inline-block w-1.5 rounded"
                      style="
                        height: {{ 14 + (($i * 11) % 34) }}px;
                        background: linear-gradient(180deg, rgba(255,56,192,0.22), rgba(229,0,119,0.75));
                        opacity: {{ 0.20 + (($i % 7) / 14) }};
                      "></span>
              @endfor
            </div>
          </div>

          <div class="mt-5 flex items-center justify-between gap-3 text-xs text-white/60">
            <span>Qualité optimisée • Latence faible</span>
            <a href="{{ route('live.tv') }}"
               class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-white hover:bg-white/10 transition">
              Ouvrir le direct
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  (() => {
    // Eviter collisions si le composant apparaît plusieurs fois
    const root = document.currentScript?.closest('section') || document;
    const btn = root.querySelector('#heroRadioBtn');
    const icon = root.querySelector('#heroRadioIcon');
    const label = root.querySelector('#heroRadioLabel');
    const status = root.querySelector('#heroRadioStatus');
    const vol = root.querySelector('#heroRadioVol');

    if (!btn) return;

    const STREAM_URL = @json($radioStreamUrl);

    const audio = new Audio();
    audio.preload = 'none';
    audio.crossOrigin = 'anonymous';
    audio.src = STREAM_URL;
    audio.volume = parseFloat(vol?.value ?? '0.8');

    const setUI = (state) => {
      if (state === 'playing') {
        icon.textContent = '⏸';
        label.textContent = 'Pause';
        status.textContent = 'En lecture';
      } else if (state === 'loading') {
        icon.textContent = '⏳';
        label.textContent = 'Connexion…';
        status.textContent = 'Connexion au flux…';
      } else {
        icon.textContent = '▶';
        label.textContent = 'Écouter';
        status.textContent = 'Prêt';
      }
    };

    btn.addEventListener('click', async () => {
      if (!audio.paused) {
        audio.pause();
        setUI('idle');
        return;
      }

      setUI('loading');
      try {
        audio.src = STREAM_URL; // force reconnect
        await audio.play();
        setUI('playing');
      } catch (e) {
        setUI('idle');
        status.textContent = 'Lecture impossible (CORS/HTTPS/format).';
        console.error(e);
      }
    });

    audio.addEventListener('waiting', () => setUI('loading'));
    audio.addEventListener('playing', () => setUI('playing'));
    audio.addEventListener('pause', () => setUI('idle'));
    audio.addEventListener('error', () => {
      setUI('idle');
      status.textContent = 'Erreur de lecture.';
    });

    if (vol) {
      vol.addEventListener('input', (e) => audio.volume = parseFloat(e.target.value));
    }
  })();
</script>
@endpush