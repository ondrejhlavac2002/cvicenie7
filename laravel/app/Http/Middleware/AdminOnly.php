<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AdminOnly
{
    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            return response()->json([
                'message' => 'Prístup je povolený len administrátorovi.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
