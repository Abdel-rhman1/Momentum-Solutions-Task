<?php

namespace App\Http\Services;

use App\Http\Reposatries\Repositories\PostRepository;
class PostService{

    private $postRepository;
    public function __construct(PostRepository $postRepository){
        $this->postRepository = $postRepository;
    }

    public function index(){
        $posts = $this->postRepository->get();
        return $posts;
    }

    public function store($request){
        $post = $this->postRepository->create($request->all());
        return $post;
    }

    public function show($id){
        $post = $this->postRepository->find($id);
        return $post;
    }

    public function update($request, $id){
        $post =$this->postRepository->update( $id,$request->all());
        return $post;
    }

    public function delete($id){
        $post = $this->postRepository->delete($id) ;
        return $post;
    }
}
