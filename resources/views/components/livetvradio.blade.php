<section id="live" class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-10">
  
      <div>
        <h2 class="text-3xl font-extrabold mb-4">
          DRTV en Ligne
        </h2>
        <p class="text-gray-300 mb-6">
          Suivez nos programmes en direct, partout dans le monde.
        </p>
        {{-- <a href="{{ route('live.tv') }}" class="btn-primary px-6 py-3 rounded-full">
          Regarder la TV en direct
        </a> --}}
      </div>
  
      {{-- relative aspect-video rounded-xl overflow-hidden shadow-2xl --}}
      <div class="w-full h-auto object-cover relative rounded-xl overflow-hidden">
        <iframe src="https://player.castr.com/live_fa91d680268a11f19fb5ef0a56d9304b" width="100%" style="aspect-ratio: 16/9; min-height: 340px;" frameborder="0" scrolling="no" allow="autoplay" allowfullscreen  webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
        {{-- <video
            id="live-tv-player"
            controls
            autoplay
            playsinline
            class="w-full h-full bg-black"
            ></video> --}}
        {{-- <iframe width="600" height="320" src="https://stream-akamai.castr.com/5b9352dbda7b8c769937e459/live_2361c920455111ea85db6911fe397b9e/index.fmp4.m3u8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
    </div>
  
    </div>
  </section>
  