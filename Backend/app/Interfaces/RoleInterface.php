<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RoleInterface
{
    public function index(): object;
    public function show(Request $request): object;
    public function create(Request $request);
    public function edit(Request $request): object;
    public function delete(Request $request): object;
}
