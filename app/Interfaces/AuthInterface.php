<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface AuthInterfaces
{
    public function login(LoginRequest $request);

    public function register(Request $request);

    public function logout();

    public function refresh();

    public function userProfile();

    public function createNewToken($token);
}
