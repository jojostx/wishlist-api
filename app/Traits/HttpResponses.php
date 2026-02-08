<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    /**
     * Build a standardized successful JSON response.
     */
    protected function success(mixed $data, ?string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Request was successful.',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Build a standardized error JSON response.
     */
    protected function error(mixed $data, ?string $message = null, int $code = 500): JsonResponse
    {
        return response()->json([
            'status' => 'Error has occurred.',
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
