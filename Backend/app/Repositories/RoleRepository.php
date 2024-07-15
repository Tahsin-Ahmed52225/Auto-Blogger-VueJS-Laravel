<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RoleInterface
{
    public function getAllRoles(): object;
    public function getRole(Request $request): object;
    public function saveRole(Request $request);
    public function updateRole(Request $request, int $roleID): object;
    public function deleteRole(Request $request): object;
}
