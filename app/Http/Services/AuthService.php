<?php

namespace App\Http\Services;

use App\Enum\FetchDataFunctionsEnum;
use App\Exceptions\FileStorageException;
use App\Http\Classes\File;
use App\Http\Repositories\UserRepo;
use App\Http\Requests\LoginRequest;
use App\Http\Services\RepoService\FileService;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(
        protected UserRepo $userRepo

    )
    {}

    /**
     * login.
     *
     * @param  LoginRequest request
     * @return $token
     */
    public  function login(FormRequest $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return   $token;
    }

}
