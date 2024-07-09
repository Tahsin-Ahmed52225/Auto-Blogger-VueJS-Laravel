<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @var PostInterface
     */
    protected PostInterface $postInterface;
    /**
     * Constructor
     */
    public function __construct(PostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }
    /**
     * Getting all the post data
     */
    public function index()
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->postInterface->getAllPosts();
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Getting post by post ID
     */
    public function show(Request $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->postInterface->getPost($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Creating new post
     */
    public function store(PostRequest $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->postInterface->savePost($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * Updating post data
     */
    public function update(PostRequest $request, int $postID)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->postInterface->updatePost($request, $postID);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
    /**
     * deleting post data
     */
    public function delete(Request $request)
    {
        $this->httpRequestLog(__FILE__, __LINE__, __FUNCTION__);
        $response = $this->postInterface->deletePost($request);
        $this->httpResponseLog($response, __FILE__, __LINE__, __FUNCTION__);

        return response()->json($response, $response->status_code);
    }
}
