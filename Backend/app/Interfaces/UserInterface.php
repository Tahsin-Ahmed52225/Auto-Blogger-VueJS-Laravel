<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserInterface
{
    public function index(): object;
    public function show(Request $request): object;
    public function create(UserRequest $request);
    public function edit(UserRequest $request): object;
    public function delete(Request $request): object;
}
