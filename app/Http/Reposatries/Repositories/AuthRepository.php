<?php

namespace App\Http\Reposatries\Repositories;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Reposatries\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class AuthRepository implements AuthRepositoryInterface
{
    private $model;
    public function __construct(User $model){
        $this->model = $model;
    }
    public function login($email, $password){
        if (Auth()->attempt(['email'=> $email,'password'=> $password])) {
            return Auth::guard()->user();
        }
        return null;
    }

  public function register($request)
  {
    return $this->model->create($request->all());
  }

    public function logout($request): bool{
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return true;
    }

    public function find($id){
        return $this->model->find($id);
    }

}
