<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UserService;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private $view_path = 'pages.admin.dashboard.users.';

    public function __construct(protected UserService $userService)
    {}

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userService->index();
        return view($this->view_path . 'index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view($this->view_path . 'create', compact('roles'));
    }

    /**
     * Store a newly created user in the database.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request);
        return $this->redirectWithMessage('admin.users.index', 'User Created Successfully!', $user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view($this->view_path . 'edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in the database.
     *
     * @param StoreUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $updatedUser = $this->userService->update($request, $user);

        if ($updatedUser) {
            return $this->redirectWithMessage('admin.users.index', 'User Updated Successfully!', $updatedUser);
        }

        return redirect()->back()->with('error', 'An error occurred while updating the user.');
    }

    /**
     * Remove the specified user from the database.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(User $user)
    {
        try {
            $user->delete();
            return $this->redirectWithMessage('admin.users.index', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }

    /**
     * Helper function to handle redirection with success messages.
     *
     * @param string $route
     * @param string $message
     * @param User|null $user
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectWithMessage(string $route, string $message, User $user = null): RedirectResponse
    {
        $response = redirect()->route($route)->with('success', $message);

        if ($user) {
            $response->with('user', $user);
        }

        return $response;
    }
}
