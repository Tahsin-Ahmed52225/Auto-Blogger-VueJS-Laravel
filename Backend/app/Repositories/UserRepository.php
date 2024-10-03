<?php

namespace App\Repositories;

use Throwable;
use App\Models\User;
use App\Services\CommonService;
use App\Exceptions\UserException;
use App\Interfaces\UserInterface;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{Request, Response};

class UserRepository implements UserInterface
{
    /**
     * Get all the users
     */
    public function index(): object
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
    public function show(Request $request): object
    {
        try {
            $data = User::find($request->id) ?? [];

            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            throw new UserException($e);
        }
    }
    /**
     * Create a new user
     */
    public function create(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = User::create($request->all());
            DB::commit();
            return returnResponse('Success', $data, Response::HTTP_CREATED);
        } catch (Throwable $e) {
            DB::rollBack();
            throw new UserException($e);
        }
    }
    /**
     * Update user data
     */
    public function edit(UserRequest $request): object
    {
        DB::beginTransaction();
        try {
            $data = User::findOrFail($request->id);
            $data->update($request->all());
            DB::commit();
            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            DB::rollBack();
            throw new UserException($e);
        }
    }
    /**
     * Delete user data
     */
    public function delete(Request $request): object
    {
        DB::beginTransaction();
        try {
            $data = User::findOrFail($request->id);
            $data->delete();
            DB::commit();
            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            DB::rollBack();
            throw new UserException($e);
        }
    }
}
