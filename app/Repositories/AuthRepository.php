<?php

namespace App\Repositories;

class AuthRepository implements AuthInterfaces
{
    public function login(LoginRequest $request)
    {
        if (! $token = auth()->attempt($validator->validated()))
        {

        }
    }
    public function register(Request $request)
    {

    }
    public function logout()
    {

    }
    public function refresh()
    {

    }
    public function userProfile()
    {

    }
    public function createNewToken($token)
    {

    }
}
