<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HlsProxyController extends Controller
{
    public function handle(Request $request)
    {
        $url = (string) $request->query('url', '');

        if ($url === '' || !preg_match('#^https?://#i', $url)) {
            abort(400, 'Invalid url');
        }

        // (Optionnel) whitelist simple pour éviter un proxy ouvert
        $host = (string) (parse_url($url, PHP_URL_HOST) ?? '');
        if ($host !== 'stream.dmtechcongo.com') {
            abort(403, 'Host not allowed');
        }

        $resp = Http::withHeaders([
                'User-Agent' => $request->userAgent() ?? 'Laravel',
                'Accept' => '*/*',
            ])
            ->timeout(20)
            ->get($url);

        $contentType = (string) ($resp->header('Content-Type') ?? 'application/octet-stream');
        $body = $resp->body();

        if ($this->isHlsManifest($url, $contentType)) {
            $body = $this->rewriteManifestToProxy($body, $url);
            $contentType = 'application/vnd.apple.mpegurl';
        }

        return response($body, $resp->status())
            ->header('Content-Type', $contentType)
            ->header('Cache-Control', 'no-store')
            ->header('Access-Control-Allow-Origin', '*');
    }

    private function isHlsManifest(string $url, string $contentType): bool
    {
        $ct = strtolower($contentType);
        if (str_contains($ct, 'application/vnd.apple.mpegurl')) return true;
        if (str_contains($ct, 'application/x-mpegurl')) return true;

        $path = strtolower((string) (parse_url($url, PHP_URL_PATH) ?? ''));
        return str_ends_with($path, '.m3u8');
    }

    private function rewriteManifestToProxy(string $manifest, string $manifestUrl): string
    {
        $base = $this->baseUrl($manifestUrl);
        $lines = preg_split("/(\r\n|\n|\r)/", $manifest) ?: [];

        $out = [];
        foreach ($lines as $line) {
            $trim = trim($line);

            // EXT-X-KEY with URI="..."
            if (str_starts_with($trim, '#EXT-X-KEY:') && preg_match('/URI="([^"]+)"/', $trim, $m)) {
                $keyUriAbs = $this->absolutize($m[1], $base);
                $proxied = url('/hls-proxy') . '?url=' . rawurlencode($keyUriAbs);
                $out[] = preg_replace('/URI="([^"]+)"/', 'URI="' . $proxied . '"', $line);
                continue;
            }

            // Other tags/comments
            if ($trim === '' || str_starts_with($trim, '#')) {
                $out[] = $line;
                continue;
            }

            // URL line: segment or nested playlist
            $abs = $this->absolutize($trim, $base);
            $out[] = url('/hls-proxy') . '?url=' . rawurlencode($abs);
        }

        return implode("\n", $out);
    }

    private function baseUrl(string $url): string
    {
        $parts = parse_url($url) ?: [];
        $scheme = $parts['scheme'] ?? 'https';
        $host = $parts['host'] ?? '';
        $port = isset($parts['port']) ? ':' . $parts['port'] : '';
        $path = $parts['path'] ?? '/';

        $dirPos = strrpos($path, '/');
        $dir = $dirPos !== false ? substr($path, 0, $dirPos + 1) : '/';

        return $scheme . '://' . $host . $port . $dir;
    }

    private function absolutize(string $maybeRelative, string $base): string
    {
        if (preg_match('#^https?://#i', $maybeRelative)) return $maybeRelative;
        if (str_starts_with($maybeRelative, '//')) return 'https:' . $maybeRelative;

        if (str_starts_with($maybeRelative, '/')) {
            $parts = parse_url($base) ?: [];
            $scheme = $parts['scheme'] ?? 'https';
            $host = $parts['host'] ?? '';
            $port = isset($parts['port']) ? ':' . $parts['port'] : '';
            return $scheme . '://' . $host . $port . $maybeRelative;
        }

        return $base . ltrim($maybeRelative, '/');
    }
}