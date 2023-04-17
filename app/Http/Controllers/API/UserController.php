<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterfaces;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterfaces $UserInterface)
    {
        $this->userInterface = $UserInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userInterface->getAllUsers();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->userInterface->requestUser($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->userInterface->getUserById($id);
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return $this->userInterface->requestUser($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(UserRequest $request, $id)
    {
        return $this->userInterface->requestUser($request, $id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userInterface->deleteUserByID($id);
    }
}
