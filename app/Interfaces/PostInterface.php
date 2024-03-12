<?php

namespace App\Interfaces;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

interface PostInterface
{
    public function getAllPosts(): object;
    public function getPost(Request $request): object;
    public function savePost(PostRequest $request): object;
    public function updatePost(PostRequest $request, int $postID): object;
    public function deletePost(Request $request): object;
}
