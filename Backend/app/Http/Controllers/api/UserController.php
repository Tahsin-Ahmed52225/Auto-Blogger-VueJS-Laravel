<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected UserInterface $userInterface;

    /**
     * __constructor
     *
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    /**
     * get all users
     */
    public function getAllUsers(): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->getAllUsers();
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }



}
