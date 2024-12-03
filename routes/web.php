<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\TestController;
use App\Models\User;
    

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/auth-login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.tasks.index');
    })->name('home');

  
    

    Route::prefix('/admin')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.index');
    });

    Route::prefix('/admin/users')->controller(UserController::class)->name('admin.users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::post('/update/{user}', 'update')->name('update');
        Route::get('/delete/{user}', 'delete')->name('delete');
    });

    Route::prefix('/admin/tasks')->controller(TaskController::class)->name('admin.tasks.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{task}', 'edit')->name('edit');
        Route::post('/update/{task}', 'update')->name('update');
        Route::get('/delete/{task}', 'delete')->name('delete');
    });

    Route::get('create_user', function () {
        $roles = User::all();
        return view('pages.admin.dashboard.users.create', ['roles' => $roles]);
    })->name('test.create');

    Route::post('store_user', [TestController::class, 'store'])->name('test.store');
});

Route::get('/home', [App\Http\Controllers\UserController::class, 'users'])->name('home');
