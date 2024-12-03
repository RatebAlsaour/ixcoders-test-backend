<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group([
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
});



Route::group([
    'middleware'=>'auth:sanctum',
    'prefix' => 'task'
], function ($router) {
    Route::post('index', [\App\Http\Controllers\TaskController::class, 'index']);
    Route::post('store', [\App\Http\Controllers\TaskController::class, 'store']);
    Route::get('show/{task}', [\App\Http\Controllers\TaskController::class, 'show']);
    Route::post('update/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->middleware(\App\Http\Middleware\CheckPermissionMiddleware::class);
    Route::delete('destroy/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->middleware(\App\Http\Middleware\CheckPermissionMiddleware::class);

});
