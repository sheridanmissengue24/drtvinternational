{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/pages/live/radio.blade.php --}}
@extends('layouts.app')

@section('content')
<section class="hero-bleed relative overflow-hidden bg-dark text-white">
  {{-- Background accents --}}
  <div class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full blur-3xl opacity-30"
         style="background: radial-gradient(circle, var(--accent), transparent 60%);"></div>
    <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full blur-3xl opacity-25"
         style="background: radial-gradient(circle, var(--accent-2), transparent 60%);"></div>
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px), linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 32px 32px;"></div>
  </div>

  <div class="relative mx-auto max-w-6xl px-6 py-14 md:py-20">
    {{-- Header --}}
    <div class="mx-auto max-w-3xl text-center">
      <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm">
        <span class="inline-flex h-2 w-2 rounded-full"
              style="background: var(--accent); box-shadow: 0 0 18px var(--accent);"></span>
        <span class="font-medium tracking-wide">LIVE</span>
        <span class="text-white/60">• Radio en direct</span>
      </div>

      <h1 class="mt-5 text-3xl font-extrabold tracking-tight md:text-5xl">
        Live Radio
      </h1>
      <p class="mt-3 text-base text-white/70 md:text-lg">
        {{-- Un lecteur fluide, pro et élégant — optimisé pour votre charte graphique. --}}
      </p>
    </div>

    {{-- Player Card --}}
    <div class="mx-auto mt-10 max-w-4xl">
      <div class="rounded-2xl border border-white/10 bg-white/5 p-5 shadow-2xl backdrop-blur-md md:p-7">
        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
          <div class="min-w-0">
            <div class="flex items-center gap-3">
              <div class="grid h-11 w-11 place-items-center rounded-xl"
                   style="background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 3a1 1 0 0 1 1 1v16a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1Zm6 3a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1ZM6 7a1 1 0 0 1 1 1v8a1 1 0 1 1-2 0V8a1 1 0 0 1 1-1Z"/>
                </svg>
              </div>

              <div class="min-w-0">
                <div class="truncate text-lg font-semibold">DRN1 • Live Radio</div>
                <div id="statusText" class="text-sm text-white/60">Prêt</div>
              </div>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <button id="playPauseBtn"
              class="inline-flex items-center gap-2 rounded-full px-5 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
              style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
              <span id="playPauseIcon" class="text-base leading-none">▶</span>
              <span id="playPauseLabel">Écouter</span>
            </button>

            <div class="hidden items-center gap-3 rounded-full border border-white/10 bg-black/20 px-4 py-3 md:flex">
              <span class="text-xs text-white/60">Volume</span>
              <input id="volume" type="range" min="0" max="1" step="0.01" value="0.8"
                     class="h-1.5 w-28 cursor-pointer accent-pink-500">
            </div>
          </div>
        </div>

        {{-- Waveform --}}
        <div class="mt-6 rounded-xl border border-white/10 bg-black/20 p-4">
          <div class="flex items-center justify-between gap-4">
            <div class="text-xs text-white/60">Live signal</div>
            <div class="flex items-center gap-2 text-xs text-white/60">
              <span id="currentTime">—:—</span>
              <span class="opacity-50">/</span>
              <span id="duration">LIVE</span>
            </div>
          </div>

          <div id="waveform" class="mt-3">
            {{-- Canvas injecté en JS --}}
          </div>

          <div class="mt-3 text-xs text-white/50">
            {{-- Si le flux ne démarre pas: vérifiez HTTPS vs HTTP (mixed content) ou CORS côté serveur du stream. --}}
          </div>
        </div>

        {{-- CTA --}}
        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
          <div class="text-sm text-white/60">
            Astuce : sur un flux live, la durée reste généralement inconnue.
          </div>
          <div class="flex gap-3">
            <a href="{{ route('apk') }}"
               class="rounded-full px-5 py-3 text-sm font-semibold text-white transition"
               style="background: linear-gradient(90deg, var(--accent-dark), var(--accent-2));">
              Télécharger l'app
            </a>
            <a href="{{ route('contact.index') }}"
               class="rounded-full border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10 transition">
              Publicité radio
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
<style>
  #waveform { height: 92px; }
  #waveCanvas {
    width: 100%;
    height: 92px;
    display: block;
    border-radius: 10px;
  }
</style>
@endpush

@push('scripts')
<script>
  (() => {
    const btn = document.getElementById('playPauseBtn');
    const icon = document.getElementById('playPauseIcon');
    const label = document.getElementById('playPauseLabel');
    const statusText = document.getElementById('statusText');
    const currentTimeEl = document.getElementById('currentTime');
    const durationEl = document.getElementById('duration');
    const volumeEl = document.getElementById('volume');
    const waveformEl = document.getElementById('waveform');

    // Remplacez par votre flux live final (idéalement HTTPS).
    const STREAM_URL = 'https://streaming.nrjaudio.fm/oumvmk8fnozc?origine=fluxradios';

    // Audio HTML5 (flux live)
    const audio = new Audio();
    audio.preload = 'none';
    audio.crossOrigin = 'anonymous';
    audio.src = STREAM_URL;
    audio.volume = parseFloat(volumeEl?.value ?? '0.8');

    // Live: durée inconnue
    durationEl.textContent = 'LIVE';
    currentTimeEl.textContent = '—:—';

    const setUI = (state) => {
      if (state === 'playing') {
        icon.textContent = '⏸';
        label.textContent = 'Pause';
        statusText.textContent = 'En direct • Lecture';
      } else if (state === 'loading') {
        icon.textContent = '⏳';
        label.textContent = 'Connexion…';
        statusText.textContent = 'Connexion au flux…';
      } else {
        icon.textContent = '▶';
        label.textContent = 'Écouter';
        statusText.textContent = 'Prêt';
      }
    };

    // Waveform canvas animé (design pro, sans décoder le flux)
    const canvas = document.createElement('canvas');
    canvas.id = 'waveCanvas';
    waveformEl.innerHTML = '';
    waveformEl.appendChild(canvas);

    const ctx = canvas.getContext('2d');

    const resize = () => {
      const dpr = Math.max(1, window.devicePixelRatio || 1);
      const w = canvas.clientWidth || waveformEl.clientWidth || 600;
      const h = 92;

      canvas.width = Math.floor(w * dpr);
      canvas.height = Math.floor(h * dpr);
      canvas.style.height = h + 'px';
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    };

    window.addEventListener('resize', resize);
    requestAnimationFrame(resize);

    let raf = 0;
    const bars = 64;

    function roundRect(ctx, x, y, w, h, r) {
      const rr = Math.min(r, w/2, h/2);
      ctx.beginPath();
      ctx.moveTo(x + rr, y);
      ctx.arcTo(x + w, y, x + w, y + h, rr);
      ctx.arcTo(x + w, y + h, x, y + h, rr);
      ctx.arcTo(x, y + h, x, y, rr);
      ctx.arcTo(x, y, x + w, y, rr);
      ctx.closePath();
    }

    const drawIdle = () => {
      const w = canvas.clientWidth, h = 92;
      ctx.clearRect(0, 0, w, h);

      // subtle midline
      ctx.fillStyle = 'rgba(255,255,255,0.06)';
      ctx.fillRect(0, h/2, w, 1);

      const gap = 3;
      const bw = Math.max(2, Math.floor((w - (bars - 1) * gap) / bars));
      const baseY = h / 2;

      for (let i = 0; i < bars; i++) {
        const x = i * (bw + gap);
        const amp = 6 + (i % 8) * 1.2;
        const y = baseY - amp / 2;

        const grad = ctx.createLinearGradient(0, y, 0, y + amp);
        grad.addColorStop(0, 'rgba(255,56,192,0.20)');
        grad.addColorStop(1, 'rgba(229,0,119,0.45)');
        ctx.fillStyle = grad;

        roundRect(ctx, x, y, bw, amp, 3);
        ctx.fill();
      }
    };

    const drawPlaying = (t) => {
      const w = canvas.clientWidth, h = 92;
      ctx.clearRect(0, 0, w, h);

      const gap = 3;
      const bw = Math.max(2, Math.floor((w - (bars - 1) * gap) / bars));
      const baseY = h / 2;

      for (let i = 0; i < bars; i++) {
        const x = i * (bw + gap);
        const phase = (t / 260) + (i / 10);
        const amp = 10 + (Math.sin(phase) * 0.5 + 0.5) * 46;

        const y = baseY - amp / 2;
        const grad = ctx.createLinearGradient(0, y, 0, y + amp);
        grad.addColorStop(0, 'rgba(255,56,192,0.35)');
        grad.addColorStop(1, 'rgba(229,0,119,0.95)');
        ctx.fillStyle = grad;

        roundRect(ctx, x, y, bw, amp, 4);
        ctx.fill();
      }

      raf = requestAnimationFrame(drawPlaying);
    };

    const stopAnim = () => {
      if (raf) cancelAnimationFrame(raf);
      raf = 0;
      drawIdle();
    };

    // Initial render
    stopAnim();

    // Controls
    btn.addEventListener('click', async () => {
      if (!audio.paused) {
        audio.pause();
        setUI('idle');
        stopAnim();
        return;
      }

      setUI('loading');
      try {
        // Force reconnect on each play (useful after errors)
        audio.src = STREAM_URL;
        await audio.play();
        setUI('playing');
        if (!raf) raf = requestAnimationFrame(drawPlaying);
      } catch (e) {
        setUI('idle');
        stopAnim();
        statusText.textContent = "Impossible de lire le flux (mixed content / CORS / format).";
        console.error('Audio play error:', e);
      }
    });

    audio.addEventListener('waiting', () => setUI('loading'));
    audio.addEventListener('playing', () => {
      setUI('playing');
      if (!raf) raf = requestAnimationFrame(drawPlaying);
    });
    audio.addEventListener('pause', () => {
      setUI('idle');
      stopAnim();
    });
    audio.addEventListener('error', () => {
      setUI('idle');
      stopAnim();
      statusText.textContent = "Erreur de lecture du flux.";
    });

    if (volumeEl) {
      volumeEl.addEventListener('input', (e) => {
        audio.volume = parseFloat(e.target.value);
      });
    }
  })();
</script>
@endpush