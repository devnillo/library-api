<?php

namespace App\Http\Responses;

class JsonResponse
{
    public static function success(?array $data, string $message, ?int $status): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => false,
            'message' => $message,
            'data' => $data
        ],$status);
    }


    public static function error(?array $data, string $message, int $status): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'data' => $data
        ],$status);
    }
}
