<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Interfaces\RoleInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected RoleInterface $roleInterface;

    /**
     * __constructor
     *
     */
    public function __construct(RoleInterface $roleInterface)
    {
        $this->roleInterface = $roleInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->roleInterface->index();
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function create(RoleRequest $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->roleInterface->create($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->roleInterface->show($id);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleRequest $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->roleInterface->edit($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->roleInterface->delete($id);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
}
