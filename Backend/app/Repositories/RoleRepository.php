<?php

namespace App\Repositories;

use Throwable;
use App\Models\User;
use App\Exceptions\RoleException;
use App\Interfaces\RoleInterface;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\{Request, Response};

class RoleRepository implements RoleInterface
{
    /**
     * Get all the Roles
     */
    public function index(): object
    {
        try {
            $data = Role::all();

            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            throw new RoleException($e);
        }
    }
    /**
     * Get a particular user
     */
    public function show(Request $request): object
    {
        try {
            $data = Role::find($request->id) ?? [];

            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            throw new RoleException($e);
        }
    }
    /**
     * Create a new user
     */
    public function create(RoleRequest $request): object
    {
        DB::beginTransaction();
        try {
            $data = Role::create($request->all());
            DB::commit();
            return returnResponse('Success', $data, Response::HTTP_CREATED);
        } catch (Throwable $e) {
            DB::rollBack();
            throw new RoleException($e);
        }
    }
    /**
     * Update user data
     */
    public function edit(RoleRequest $request): object
    {
        DB::beginTransaction();
        try {
            $data = Role::findOrFail($request->id);
            $data->update($request->all());
            DB::commit();
            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            DB::rollBack();
            throw new RoleException($e);
        }
    }
    /**
     * Delete user data
     */
    public function delete(Request $request): object
    {
        DB::beginTransaction();
        try {
            $data = Role::findOrFail($request->id);
            $user = User::find($request->id);
            $user->assignRole($data);
           // $data->delete();
            DB::commit();
            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            DB::rollBack();
            throw new RoleException($e);
        }
    }
}
