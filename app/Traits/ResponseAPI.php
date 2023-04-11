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
    public function success($msg, $data , $statusCode = 200)
    {
        return $this->coreResponse($msg, $statusCode, $data, true);
    }
    public function error($msg , $statusCode = 500)
    {
        return $this->coreResponse($msg, $statusCode, null, false);
    }
}
