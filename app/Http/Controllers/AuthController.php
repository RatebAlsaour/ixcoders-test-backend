<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepo;
use App\Http\Requests\LoginRequest;
use App\Http\Services\ApiResponseService;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService  $authService

    )
    {}


    /**
     * login.
     *
     * @param  LoginRequest        request
     * @return json
     */
    public function login(LoginRequest $request)
    {
         $token=  $this->authService->login($request);
        return   ApiResponseService::loginResponse($token);
    }

    /**
     * logout.
     *
     * @param  Request        request
     * @return json
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ApiResponseService::successMsgResponse();
    }
}
