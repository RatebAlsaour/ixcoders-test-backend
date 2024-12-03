<?php

namespace App\Http\Services;

use App\Enum\FetchDataFunctionsEnum;
use App\Http\DTOs\UserData;
use App\Http\Repositories\UserRepo;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserService
{
    public function __construct(protected UserRepo $userRepo) {}

    /**
     * Fetch a list of users.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->userRepo->fetch(FetchDataFunctionsEnum::GET);
    }

    /**
     * Store a new user in the database.
     *
     * @param FormRequest $request
     * @return mixed
     */
    public function store(FormRequest $request)
    {
        $userData = UserData::fromObject($request)->all();
        return $this->userRepo->create($userData);
    }

    /**
     * Update an existing user in the database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return User
     */
    public function update(FormRequest $request, User $user): User
    {
        $userData = UserData::fromObject($request)->all();
        $user->update($userData);
        return $user;
    }
}
