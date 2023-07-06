<?php

namespace App\Helpers;

class ApiResponse
{
    public static function sendResponse($code = 201, $msg = null, $data = [])
    {
        $response = [
            'status' => $code,
            'message' => $msg,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }
}

