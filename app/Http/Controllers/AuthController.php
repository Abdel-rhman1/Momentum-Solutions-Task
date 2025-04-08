<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Interfaces\AuthInterface;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    use ApiResponse;
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login(LoginRequest $request)
    {

        if ($user = $this->authService->login($request['email'], $request['password'])) {
            $user->tokens->each->delete();
            $user->refresh();
            $token = $user->createToken('user-token')->plainTextToken;
            $user->token = $token;
            // $user->save();
            return $this->apiResponse($user, 200, 'Login Successfully', [], $token);
        } else {
            return $this->apiResponseError('Username Or Password Incorrect', 500);
        }
    }

    public function register(AuthRequest $request)
    {
        if ($user = $this->authService->register($request)) {
            return $this->apiResponse($user, 200, "User Created Successfully", []);
        } else {
            // return $this->authService->register($request);
            return $this->apiResponseError("Error In Something", 500);
        }
    }

    public function logout(Request $request)
    {
        if ($this->authService->logout($request)) {
            return $this->apiResponse("Logout Successfully", 200);
        } else {
            return $this->apiResponseError("Logout Error", 500);
        }
    }


    public function getProfile(){
        $profile = $this->authService->getProfile();
        return $this->apiResponse($profile,200,"Profile Retrieved Successfully");
    }
}
