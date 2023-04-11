<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;

interface UserInterfaces
{
    public function getAllusers();

    public function getUserByID($userID);

    public function requestUser(UserRequest $request , $userID = null);
    
    public function deleteUserByID($userID);
}
