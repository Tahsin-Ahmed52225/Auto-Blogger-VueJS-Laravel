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
    public function index(): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->index();
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
     /**
     * Get user
     */
    public function show(Request $request): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->show($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Save user
     */
    public function create(UserRequest $request): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->create($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Edit User data
     */
    public function edit(UserRequest $request, int $userID): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->edit($request, $userID);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);

    }
    public function delete(Request $request): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->delete($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
}
