<?php

namespace App\Traits;

use App\Constants\AC;

trait ProcessResponse
{
    public function processResponse($data_key, $data, $message = null, $status = AC::_SUCCESS, $code = 200)
    {
        if($status === AC::_UNAUTHORIZED) $message = 'You are not authorized for this action!';

        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            $data_key => $data,
        ], $code);
    }
}
