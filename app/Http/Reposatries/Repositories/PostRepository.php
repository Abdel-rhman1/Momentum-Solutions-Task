<?php
namespace App\Http\Reposatries\Repositories;
use App\Http\Reposatries\Repositories\BaseRepository;
use App\Models\Post;
class PostRepository extends BaseRepository {

    public function __construct(Post $post){
        parent::__construct($post);
    }
}
