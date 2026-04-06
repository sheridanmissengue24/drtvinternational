{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/components/hero.blade.php --}}
@props([
  'featuredLive' => null,
  'title' => "Tout le monde en parle!",
  'subtitle' => "Information • Éducation • Divertissement • Live, en replay et en mobilité",
  'ctaPrimaryText' => 'Regarder le Live',
  'ctaSecondaryText' => 'Nous contacter',
  'ctaSecText' => 'Ecouter la DRN1',
  // Optionnel: passer un flux radio depuis la page
  'radioStreamUrl' => 'https://stream.dmtechcongo.com/live/radio.m3u8',
])

<section class="hero-bleed relative w-full overflow-hidden bg-dark text-white">
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
      </div>

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
    const root = document.currentScript?.closest('section') || document;
    const btn = root.querySelector('#heroRadioBtn');
    const icon = root.querySelector('#heroRadioIcon');
    const label = root.querySelector('#heroRadioLabel');
    const status = root.querySelector('#heroRadioStatus');
    const vol = root.querySelector('#heroRadioVol');

    if (!btn) return;

    const STREAM_URL = @json($radioStreamUrl);
    const isHls = typeof STREAM_URL === 'string' && STREAM_URL.toLowerCase().includes('.m3u8');

    const USE_PROXY = true;
    const EFFECTIVE_URL = (USE_PROXY && isHls)
      ? @json(url('/hls-proxy')) + '?url=' + encodeURIComponent(STREAM_URL)
      : STREAM_URL;

    const audio = new Audio();
    audio.preload = 'none';
    audio.volume = parseFloat(vol?.value ?? '0.8');

    let hls = null;
    let starting = false;

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

    async function sleep(ms) {
      return new Promise((r) => setTimeout(r, ms));
    }

    function resetAudio() {
      try { audio.pause(); } catch (e) {}
      audio.removeAttribute('src');
      try { audio.load(); } catch (e) {}
    }

    function destroyHls() {
      if (hls) {
        try { hls.destroy(); } catch (e) {}
        hls = null;
      }
    }

    function loadHlsJs() {
      if (window.Hls) return Promise.resolve();

      return new Promise((resolve, reject) => {
        const s = document.createElement('script');
        s.src = 'https://cdn.jsdelivr.net/npm/hls.js@1.5.18/dist/hls.min.js';
        s.onload = resolve;
        s.onerror = reject;
        document.head.appendChild(s);
      });
    }

    async function playWhenReady(timeoutMs = 15000) {
      const start = Date.now();
      try { await audio.play(); } catch (e) {}

      while (Date.now() - start < timeoutMs) {
        if (!audio.paused && !audio.ended) return;

        if (audio.readyState >= 3) {
          try { await audio.play(); } catch (e) {}
        }

        await sleep(200);
      }

      throw new Error('PLAY_TIMEOUT');
    }

    async function attachAndPlay() {
      destroyHls();
      resetAudio();

      if (isHls && audio.canPlayType('application/vnd.apple.mpegurl')) {
        audio.src = EFFECTIVE_URL;
        audio.load();
        await playWhenReady(15000);
        return;
      }

      if (isHls) {
        await loadHlsJs();
        if (!window.Hls || !window.Hls.isSupported()) throw new Error('HLS_NOT_SUPPORTED');

        hls = new window.Hls({
          enableWorker: true,
          lowLatencyMode: true,

          manifestLoadingMaxRetry: 4,
          manifestLoadingRetryDelay: 500,
          manifestLoadingMaxRetryTimeout: 8000,

          levelLoadingMaxRetry: 4,
          levelLoadingRetryDelay: 500,
          levelLoadingMaxRetryTimeout: 8000,

          fragLoadingMaxRetry: 6,
          fragLoadingRetryDelay: 500,
          fragLoadingMaxRetryTimeout: 15000,
        });

        hls.on(window.Hls.Events.ERROR, (_, data) => {
          console.error('HLS error', data);
          if (data?.fatal) {
            setUI('idle');
            status.textContent = `HLS fatal: ${data.type}${data.details ? ' / ' + data.details : ''}`;
          }
        });

        await new Promise((resolve) => {
          hls.once(window.Hls.Events.MEDIA_ATTACHED, resolve);
          hls.attachMedia(audio);
        });

        hls.loadSource(EFFECTIVE_URL);

        await new Promise((resolve, reject) => {
          const t = setTimeout(() => reject(new Error('MANIFEST_TIMEOUT')), 12000);
          hls.once(window.Hls.Events.MANIFEST_PARSED, () => { clearTimeout(t); resolve(); });
          hls.once(window.Hls.Events.ERROR, (_, data) => {
            if (data?.fatal) { clearTimeout(t); reject(data); }
          });
        });

        await playWhenReady(15000);
        return;
      }

      audio.src = EFFECTIVE_URL;
      audio.load();
      await playWhenReady(12000);
    }

    btn.addEventListener('click', async () => {
      if (starting) return;

      if (!audio.paused) {
        audio.pause();
        destroyHls();
        setUI('idle');
        return;
      }

      starting = true;
      setUI('loading');

      try {
        await attachAndPlay();
        setUI('playing');
      } catch (e) {
        destroyHls();
        setUI('idle');

        status.textContent =
          (e && e.name === 'NotAllowedError') ? "Clique encore sur Écouter (autoplay bloqué)." :
          (e && e.message === 'HLS_NOT_SUPPORTED') ? "HLS non supporté." :
          (e && e.message === 'MANIFEST_TIMEOUT') ? "Flux lent (manifest timeout)." :
          (e && e.message === 'PLAY_TIMEOUT') ? "Flux lent (play timeout)." :
          "Lecture impossible.";

        console.error('Start error:', e);
      } finally {
        starting = false;
      }
    });

    audio.addEventListener('waiting', () => setUI('loading'));
    audio.addEventListener('playing', () => setUI('playing'));
    audio.addEventListener('pause', () => setUI('idle'));
    audio.addEventListener('error', () => {
      destroyHls();
      setUI('idle');
      status.textContent = 'Erreur de lecture.';
    });

    if (vol) vol.addEventListener('input', (e) => audio.volume = parseFloat(e.target.value));
    window.addEventListener('beforeunload', destroyHls);
  })();
</script>
@endpush
