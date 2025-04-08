<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use App\Http\Requests\PostRequest;
use App\Http\Traits\ApiResponse;
class PostController extends Controller
{
    use ApiResponse;
    private PostService $postService;
    public function __construct(PostService $postService){
        $this->postService = $postService;
    }

    public function index(PostService $request){
        $posts = $this->postService->index();

        if(count($posts) > 0){
            return $this->apiResponse($posts,200,"Posts Reads Successfully");
        }else{
            return $this->apiResponse([],200,"No Data Found");
        }
    }

    public function store(PostRequest $request){
        $post = $this->postService->store($request);
        if($post)
            return $this->apiResponse($post,200,"Post Created Successfully");
        else
            return $this->apiResponseError("Failed To Create Post",500);
    }

    public function update(PostRequest $request,$id){
        $post = $this->postService->update($request,$id);
        if($post)
            return $this->apiResponse($post,200,"Post Updated Successfully");
        else
            return $this->apiResponseError("Failed To Update Post",500);
    }

    public function delete($id){
        $post = $this->postService->delete($id);
        if($post)
            return $this->apiResponse($post,200,"Post Deleted Successfully");
        else
            return $this->apiResponseError("Failed To Delete Post",500);
    }

    public function show($id){
        $post = $this->postService->show($id);
        if($post)
            return $this->apiResponse($post,200,"Post Read Successfully");
        else
            return $this->apiResponseError("No Data Found",500);
    }
}
