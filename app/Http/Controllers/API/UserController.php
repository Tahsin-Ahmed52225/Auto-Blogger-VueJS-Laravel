<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $UserInterface;

    public function __construct(UserInterface $UserInterface){
        $this->UserInterface = $UserInterface;
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
        return $this->userInterface->deleteUser($id);
    }
}
