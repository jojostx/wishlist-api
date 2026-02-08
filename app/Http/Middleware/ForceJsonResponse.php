<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    /**
     * Force JSON responses for API requests by setting the Accept header.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Force the request to act as if the client asked for JSON
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
