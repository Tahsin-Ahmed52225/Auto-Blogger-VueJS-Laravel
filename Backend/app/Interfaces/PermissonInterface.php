<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PermisssonInterface
{
    public function getAllPermissons(): object;
    public function getPermisson(Request $request): object;
    public function savePermisson(Request $request): object;
    public function updatePermisson(Request $request, int $permissonID): object;
    public function deletePermisson(Request $request): object;
}
