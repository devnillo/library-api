<?php

namespace App\Http\Responses;

class JsonApiResponse
{
    public static function success(string $data, string $message, ?int $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => false,
            'message' => $message,
            'data' => $data
        ],$status);
    }


    public static function error( string $message, int $status): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $message,
        ],$status);
    }
}
