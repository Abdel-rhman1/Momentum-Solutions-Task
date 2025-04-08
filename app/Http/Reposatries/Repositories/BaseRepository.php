<?php

namespace App\Http\Reposatries\Repositories;
use App\Http\Reposatries\Interfaces\GenericRepositoryInterface;
class BaseRepository implements GenericRepositoryInterface {
    private $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function get(){
        return $this->model->all();
    }
    public function create(array $data){
        return $this->model->create($data);
    }

    public function update($id,array $data){
        $post = $this->model->find($id);
        if($post){
            $post->update($data);
            return $this->find($id);
        }
        return false;


    }

    public function delete($id){
        $post = $this->model->find($id);
        if($post){
            return $post->delete();
        }
        return false;
    }

    public function find($id){
        return $this->model->find($id);
    }
}
