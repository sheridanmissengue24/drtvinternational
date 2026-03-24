<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        abort_unless($user, 403, 'Non authentifié.');

        // Autorise uniquement role=admin
        abort_unless(($user->role ?? null) === 'admin', 403, 'Accès réservé à l’administration.');

        return $next($request);
    }
}