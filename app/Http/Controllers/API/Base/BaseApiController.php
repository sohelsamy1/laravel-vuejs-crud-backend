<?php

namespace App\Http\Controllers\API\Base;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class BaseApiController extends BaseController
{
    use AuthorizesRequests;

    protected function success($data = null, $message = 'success', $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'  => $data,
        ], $code);
    }

    protected function error(string $message = 'Something went wrong', int $code = 400, ?\Throwable $e = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        // in development
        if (app()->environment('local') && $e) {
            $response['error'] = $e->getMessage();
        }

        return response()->json($response, $code);
    }
}
