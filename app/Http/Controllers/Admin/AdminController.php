<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\RepoService\FileService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct(
     protected UserService $userService
    )
    {}
    public function index() {
        $data = [
            'users' =>  User::all()
        ];
        return view('pages.admin.dashboard.index', $data);
    }
}
