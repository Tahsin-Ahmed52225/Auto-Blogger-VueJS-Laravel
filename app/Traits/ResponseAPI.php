<?php

namespace App\Traits;

trait ResponseAPI
{
    /**
     * coreResponse
     *
     * @param  string $msg
     * @param  int $statusCode
     * @param  array $data
     * @param  bool $isSuccess
     * @return json response
     */
    public function coreResponse(string $msg, int $statusCode, array $data = null, bool $isSuccess = true)
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
    /**
     * success
     *
     * @param  mixed $msg
     * @param  mixed $data
     * @param  mixed $statusCode
     * @return void
     */
    public function success($msg, $data, $statusCode = 200)
    {
        return $this->coreResponse($msg, $statusCode, $data, true);
    }
    public function error($msg, $statusCode = 500)
    {
        return $this->coreResponse($msg, $statusCode, null, false);
    }
}
