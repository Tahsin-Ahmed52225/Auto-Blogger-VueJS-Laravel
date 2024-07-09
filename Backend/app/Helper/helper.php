<?php

if (! function_exists('returnExceptionResponse')) {
    function returnExceptionResponse(string $message, array $data, int $statusCode)
    {
        return (object) [
            "message" => $message ,
            "data" => $data ,
            "status_code" => $statusCode
        ];
    }
}
if (! function_exists('returnResponse')) {
    function returnResponse(string $message, object $data, int $statusCode)
    {
        return (object) [
            "message" => $message ,
            "data" => $data ,
            "status_code" => $statusCode
        ];
    }
}

