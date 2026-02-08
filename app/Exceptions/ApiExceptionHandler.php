<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiExceptionHandler
{
    /**
     * Render the exception into an HTTP response.
     */
    public static function handle(Throwable $e, Request $request)
    {
        // 1. If it's not an API request, let Laravel handle it normally (HTML)
        if (! $request->is('api/*') && ! $request->wantsJson()) {
            return null; // returning null tells Laravel to use default handling
        }

        // 2. Handle specific exceptions
        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => 'Error has occurred.',
                'message' => 'Resource not found.',
                'data' => null,
            ], 404);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'status' => 'Error has occurred.',
                'message' => 'Unauthenticated.',
                'data' => null,
            ], 401);
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                'status' => 'Error has occurred.',
                'message' => 'Validation failed.',
                'data' => $e->errors(),
            ], 422);
        }

        // 3. Handle defaults (500 Internal Server Error)
        // Be careful exposing real error messages in production!
        $message = app()->isLocal() ? $e->getMessage() : 'Server error.';
        
        return response()->json([
            'status' => 'Error has occurred.',
            'message' => $message,
            'data' => null,
        ], 500);
    }
}