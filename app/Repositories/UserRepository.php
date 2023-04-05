<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use DB;

class UserRepository implements UserInterface {

    use ResponseAPI;

    public function getAllusers()
    {
        try {
            $users = User::all();
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    public function getUsersById($userID)
    {
        try {

        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        };
    }
    public function requestUser(UserRequest $request , $userID = null)
    {
        try {

        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        };
    }
    public function deleteUserByID($userID)
    {
        try {

        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    };
}
