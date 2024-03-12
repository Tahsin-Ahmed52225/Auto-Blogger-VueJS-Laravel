<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserInterface
{
    public function getAllUsers(): object;
    public function getUser(Request $request): object;
    public function saveUser(UserRequest $request): object;
    public function updateUser(UserRequest $request, int $userID): object;
    public function deleteUser(Request $request): object;
}
