<?php

namespace App\Traits;

use App\Constants\AC;

trait ProcessResponse
{
    public function processResponse($data_key, $data, $message = null, $status = AC::_SUCCESS, $code = 200)
    {
        return response()->json([
            $data_key => $data,
            'status' => $status,
            'message' => $message,
        ], $code);
    }
}
