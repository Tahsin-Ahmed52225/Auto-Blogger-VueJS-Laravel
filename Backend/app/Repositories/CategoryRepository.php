<?php

namespace App\Repositories;

use App\Exceptions\CategoryException;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CategoryRepository  implements CategoryInterface
{
    /**
     * Get all categories
     */
    public function getAllCategories(): object
    {
        try {
            $data = Category::orderBy("created_at", "DESC")->get();

            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            throw new CategoryException($e);
        }
    }
    /**
     * Get category by ID
     */
    public function getCategory(Request $request): object
    {
        try {
            $data = Category::find($request->id);
            if ($data) {
                return returnResponse('Success', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new CategoryException($e);
        }
    }
    /**
     * Create category
     */
    public function saveCategory(CategoryRequest $request): object
    {
        try {
            $data = Category::create([
                'category_name' => $request->category_name,
                // spaces are not allowed in slug so replaceing them with underscores
                'category_slug' => str_replace(' ', '_', $request->category_slug),
            ]);

            return returnResponse('Category saved successfully', $data, Response::HTTP_CREATED);
        } catch (Throwable $e) {
            throw new CategoryException($e);
        }
    }
    /**
     * Update category data
     */
    public function updateCategory(CategoryRequest $request, int $categoryID): object
    {
        try {
            $data = Category::find($categoryID);
            if ($data) {
                $data->update($request->all());

                return returnResponse('Category updated successfully', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new CategoryException($e);
        }
    }
    /**
     * Delete category data
     */
    public function deleteCategory(Request $request): object
    {
        try {
            $data = Category::find($request->id);
            if ($data) {
                $data->delete();
                return returnResponse('Category deleted successfully', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new CategoryException($e);
        }
    }
}
