<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
       // dd(get_class($e));
        switch (true) {
                // Handling custom exceptions
            case $e instanceof UserException:
            case $e instanceof PostException:
            case $e instanceof CategoryException:
            case $e instanceof AuthException:
                returnExceptionResponse(get_class($e), [$e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
                break;
                // Handling connection exceptions
            case $e instanceof ConnectException:
            case $e instanceof HttpException:
                returnExceptionResponse(get_class($e), [$e->getMessage()], Response::HTTP_SERVICE_UNAVAILABLE);
                break;
                // Handling validation exceptions
            case $e instanceof ValidationException:
                $errorList = $e->validator->errors()->messages();
                $errorList = array_map(function ($k, $v) {
                    return sprintf('%s: %s', $k, implode(',', $v));
                }, array_keys($errorList), $errorList);
                $message = implode(' / ', $errorList);

                returnExceptionResponse(get_class($e), [$message], Response::HTTP_BAD_REQUEST);
                break;
            default:
                //returnExceptionResponse(get_class($e), [$e->getMessage()], Response::HTTP_BAD_REQUEST);
                return parent::render($request, $e);
        }
    }


    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'message' => 'Error',
                'data' => [
                'error' => 'Unauthorized route'
                ],
                'status_code' => 401,

            ], 401);
        });
    }
}
