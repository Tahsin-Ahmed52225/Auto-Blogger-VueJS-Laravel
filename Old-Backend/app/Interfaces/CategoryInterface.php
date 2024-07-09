<?php

namespace App\Interfaces;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

interface CategoryInterface
{
    public function getAllCategories(): object;
    public function getCategory(Request $request): object;
    public function saveCategory(CategoryRequest $request): object;
    public function updateCategory(CategoryRequest $request, int $categoryID): object;
    public function deleteCategory(Request $request): object;
}
