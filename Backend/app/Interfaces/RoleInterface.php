<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;

interface RoleInterface
{
    public function index(): object;
    public function show(Request $request): object;
    public function create(RoleRequest $request);
    public function edit(RoleRequest $request): object;
    public function delete(Request $request): object;
}
