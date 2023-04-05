<?php

namespace App\Traits;

trait ResponseAPI
{
    public function coreResponse($msg, $statusCode, $data = null, $isSuccess = true)
    {
        if (!$msg) {
            return response()->json(["message" => "Message is required", 500]);
        } else {
            if ($isSuccess) {
                return response()->json([
                    "message" => $msg,
                    "status" => $statusCode,
                    "data" => $data,
                    "success" => $isSuccess
                ]);
            } else {
                return response()->json([
                    "message" => $msg,
                    "status" => $statusCode,
                    "data" => $data,
                    "success" => $isSuccess
                ]);
            }
        }
    }
    public function success()
    {
        return coreResponse($msg, 200, $data, true);
    }
    public function error()
    {
        return coreResponse($msg, 500, null, false);
    }
}
