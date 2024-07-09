<?php

namespace App\Repositories;

use App\Exceptions\UserException;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Services\CommonService;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRepository implements UserInterface
{
    /**
     * Get all the users
     */
    public function getAllUsers(): object
    {
        try {
            $data = User::all();

            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            throw new UserException($e);
        }
    }
    /**
     * Get a particular user
     */
    public function getUser(Request $request): object
    {
        try {
            $data = User::find($request->id);
            if ($data) {
                return returnResponse('Success', $data, Response::HTTP_OK);
            } else {

                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new UserException($e);
        }
    }
    /**
     * Create a new user
     */
    public function saveUser(UserRequest $request)
    {
        $data = User::create($request->all());
        return returnResponse('Success', $data, Response::HTTP_CREATED);
    }
    /**
     * Update user data
     */
    public function updateUser(UserRequest $request, int $userID): object
    {

        try {
            $data = User::find($userID);
            if ($data) {
                $data->update($request->all());

                return returnResponse('Success', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new UserException($e);
        }
    }
    /**
     * Delete user data
     */
    public function deleteUser(Request $request): object
    {
        try {
            $data = User::find($request->id);
            if ($data) {
                $data->delete();
                return returnResponse('Success', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new UserException($e);
        }
    }
}
