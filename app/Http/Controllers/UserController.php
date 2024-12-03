<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {}
    public function index() {
        return view('pages.admin.dashboard.index');
    }

    public function users() {
        $users = $this->userService->index();
        // return $users;
        return view('pages.admin.dashboard.users', ['users' => $users]);
    }

    public function create() {
        $users = $this->userService->index();
        // return $users;
        return view('pages.admin.dashboard.users', ['users' => $users]);
    }
}
