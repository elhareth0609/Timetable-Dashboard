<?php

namespace App\Traits;

trait ApiResponder {
    protected function success($data = null, $message = null, $code = 200) {
        return response()->json([
            'icon' => 'success',
            'state' => __('Success'),
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message, $code = 422) {
        return response()->json([
            'icon' => 'error',
            'state' => __('Error'),
            'message' => $message
        ], $code);
    }
}