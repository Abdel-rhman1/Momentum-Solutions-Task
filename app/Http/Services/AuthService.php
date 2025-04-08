<?php
namespace App\Http\Services;
use Illuminate\Support\Facades\Log;
use App\Http\Reposatries\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
class AuthService{
    private $authRepository;
    public function __construct(AuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }
    public function login($email, $password){
        $user = $this->authRepository->login($email,$password);
        return $user;
    }

    public function register($request){
        $admin = $this->authRepository->register($request);
        return $admin;
    }

    public function logout($request){
        $user = $this->authRepository->logout($request);
        return $user;
    }

    public function getProfile(){
        $user_id = Auth::user()->id;
        $user = $this->authRepository->find($user_id);
        return $user;
    }
}
