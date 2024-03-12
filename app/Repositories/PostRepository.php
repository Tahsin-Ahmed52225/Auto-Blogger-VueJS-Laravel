<?php

namespace App\Repositories;

use App\Exceptions\PostException;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;
use App\Models\{Post, PostCategories};
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PostRepository  implements PostInterface
{
    /**
     * Get all posts
     */
    public function getAllPosts(): object
    {
        try {
            $data = Post::all();

            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            throw new PostException($e);
        }
    }
    /**
     * Get post by post ID
     */
    public function getPost(Request $request): object
    {
        try {
            $data = Post::find($request->id);
            if ($data) {
                return returnResponse('Success', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new PostException($e);
        }
    }
    /**
     * Create new post
     */
    public function savePost(PostRequest $request): object
    {
        try {
            dd($request->file('cover_image'));
            // storing image file
            $file = $request->file('cover_image');
            $path = '/post/cover_image/';
            $fileName = str_replace(' ', '_', $request->title) . '.' . $file->getClientOriginalExtension();
            $imageURL = $path . $fileName;
            Storage::disk('public')->put($fileName, $file);
            $data = Post::create([
                'title' => $request->title,
                'cover_image' => $imageURL,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'status' => $request->status
            ]);
            if (isset($request->categories)) {
                $this->assignPostCategories($data, $request->categories);
            }

            return returnResponse('Success', $data, Response::HTTP_CREATED);
        } catch (Throwable $e) {
            throw new PostException($e);
        }
    }
    /**
     * Assign post into categories
     */
    private function assignPostCategories(object $data, array $categoryIDs): void
    {
        try {
            foreach ($categoryIDs as $categoryID) {
                PostCategories::create([
                    'categories_id' => $categoryID,
                    'posts_id' => $data->id
                ]);
            }
        } catch (Throwable $e) {
            throw new PostException($e);
        }
    }
    /**
     * Update post by ID
     */
    public function updatePost(PostRequest $request, int $userID): object
    {
        try {
            $data = Post::find($userID);
            if ($data) {
                $data->update($request->all());

                return returnResponse('Success', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new PostException($e);
        }
    }
    /**
     * Delete post data
     */
    public function deletePost(Request $request): object
    {
        try {
            $data = Post::find($request->id);
            if ($data) {
                $data->delete();
                return returnResponse('Success', $data, Response::HTTP_OK);
            } else {
                return returnResponse('', [], Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable $e) {
            throw new PostException($e);
        }
    }
}
