<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserInterface
     */
    protected UserInterface $userInterface;
    /**
     * Constructor
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    /**
     * Getting all the user data
     */
    public function index(): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->getAllUsers();
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Get a particular user data ( By ID )
     */
    public function show(Request $request): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->getUser($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Create a new user data
     */
    public function store(UserRequest $request): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->saveUser($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Update user data
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->updateUser($request, $id);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Delete user data
     */
    public function delete(Request $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->userInterface->deleteUser($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
}
