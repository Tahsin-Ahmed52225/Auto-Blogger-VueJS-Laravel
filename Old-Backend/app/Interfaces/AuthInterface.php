<?php

namespace App\Interfaces;

use App\Http\Requests\{LoginRequest};
use Illuminate\Http\Request;

interface AuthInterface
{
    public function login(LoginRequest $request): object;
    public function logout(Request $request): object;
}
