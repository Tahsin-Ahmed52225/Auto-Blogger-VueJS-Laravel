<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{LoginRequest,UserRequest};
use App\Interfaces\{AuthInterface,UserInterface};

class AuthController extends Controller
{

    protected AuthInterface $authInterface;
    protected UserInterface $userInterface;

    /**
     * __construct
     */
    public function __construct(AuthInterface $authiInterface , UserInterface $userInterface)
    {
        $this->authInterface = $authiInterface;
        $this->userInterface = $userInterface;
    }
    /**
     * User registration
     */
    public function register(UserRequest $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->saveUser($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * User login
     */
    public function login(LoginRequest $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->authInterface->login($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    // public function logout(Request $request)
    // {
    //     $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
    //     $response = $this->authInterface->logout($request);
    //     $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

    //     return response()->json($response, $response->status_code);
    // }
}
