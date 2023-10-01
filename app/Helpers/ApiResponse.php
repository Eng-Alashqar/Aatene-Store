<?php

use Illuminate\Http\JsonResponse;

function sendResponse($status = true, $msg = null, $data = [], $code = 200): JsonResponse
 {
    $response = [
        'status' => $status,
        'message' => $msg,
        'data' => $data,
        'code' => $code,
    ];

    return response()->json($response);
}
