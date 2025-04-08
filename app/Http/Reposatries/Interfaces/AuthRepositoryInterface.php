<?php

namespace App\Http\Reposatries\Interfaces;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

interface AuthRepositoryInterface{
    public function login($username, $password);
    public function logout($request);

    public function register(AuthRequest $request);
}
