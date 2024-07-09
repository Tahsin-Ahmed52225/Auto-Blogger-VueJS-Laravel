<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    /**
     * Format the response
     */
    public function httpResponseLog(object $response, string $file, int $line, string $funtionName): void
    {
        if (!property_exists($response, 'status_code')) {
            $response->status_code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response->err_msg = 'status code undefined';
            Log::error($file . '#' . $line . '::' . $funtionName . '::no status code defined');
        }

        Log::info($file . '#' . $line . '::' . $funtionName . '::API END: status_code = ' . $response->status_code . ' Data:' . json_encode($response));
    }
    /**
     * Write http request parameters
     */
    public function httpRequestLog(string $file, int $line, string $funtionName): void
    {
        Log::info($file . '#' . $line . '::' . $funtionName . ':API START:input_param:', request()->all());
    }
}
