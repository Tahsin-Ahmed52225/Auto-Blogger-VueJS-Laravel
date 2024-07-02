<?php

if (! function_exists('returnExceptionResponse')) {
    function returnExceptionResponse(string $message, array $data, int $statusCode)
    {
        return [
            "message" => $message ,
            "data" => $data ,
            "status_code" => $statusCode
        ];
    }
}
if (! function_exists('returnResponse')) {
    function returnResponse(string $message, array $data, int $statusCode)
    {
        return [
            "message" => $message ,
            "data" => $data ,
            "status_code" => $statusCode
        ];
    }
}

