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
            return $this->success("All Users", $users);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    public function getUsersById($userID)
    {
        try {
            $user = User::find($userID);
            if($user){
                return $this->success("User data", $user);
            }else{
                return $this->error("User not found", 404);
            }

        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        };
    }
    public function requestUser(UserRequest $request , $userID = null)
    {
        try {
            $user = $id ? User::find($id) : new User();
            if ( $id && !$user) return $this->error("User not found", 404);
            $user->name = $request->name;
            $user->email = preg_replace('/\s+/', '', strtolower($request->email));
            if(!$id) $user->password = \Hash::make($request->password);

            $user->save()

            return $this->success(
                $id ? "User updated"
                    : "User created",
                $user, $id ? 200 : 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        };
    }
    public function deleteUserByID($userID)
    {
        try {
            DB::beginTransaction();
            if(!$user) return $this->error("No user with ID $id", 404);
            $user->delete();
            DB::commit();
            return $this->success("User deleted", $user);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    };
}
