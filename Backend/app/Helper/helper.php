<?php

use Illuminate\Http\JsonResponse;

if (! function_exists('returnExceptionResponse')) {
    function returnExceptionResponse(string $message, array $data, int $statusCode)
    {
        $data =  [
            "message" => $message ,
            "data" => $data ,
            "status_code" => $statusCode
        ];

        return new JsonResponse($data, $data["status_code"]);
    }
}
if (! function_exists('returnResponse')) {
    function returnResponse(string $message, array|object $data, int $statusCode)
    {
        return (object) [
            "message" => $message ,
            "data" => $data ,
            "status_code" => $statusCode
        ];
    }
}

