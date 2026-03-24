<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const video = document.getElementById('live-tv-player');
  const streamUrl = "{{ $liveTv->hls_url ?? 'https://player.castr.com/live_fa91d680268a11f19fb5ef0a56d9304b' }}";

  if (video && streamUrl) {
    if (Hls.isSupported()) {
      const hls = new Hls();
      hls.loadSource(streamUrl);
      hls.attachMedia(video);
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
      video.src = streamUrl;
    }
  }
});
</script>
