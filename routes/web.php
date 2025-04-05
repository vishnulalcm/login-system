<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserControllerLevelTwo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group([
    'prefix' => 'admin',
], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('users-index', [UserController::class, 'index'])->name('users-index');

    Route::get('/data', [UserController::class, 'getData'])->name('users.data');

    // Soft delete routes (custom logic handled in controller)
    Route::patch('/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');
    Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');

    // Exclude index because it has custom route 'users-index'
    Route::resource('users', UserController::class)->except(['index']);

    Route::post('/users/check-username', [UserController::class, 'checkUsername'])->name('users.check-username');
    Route::post('/users/check-email', [UserController::class, 'checkEmail'])->name('users.check-email');

    Route::get('/data', [UserControllerLevelTwo::class, 'data'])->name('users-level-two.data');
    Route::get('users-level-one-index', [UserControllerLevelTwo::class, 'index'])->name('users-level-one-index');
    Route::resource('users-level-two', UserControllerLevelTwo::class)->except(['index']);

    Route::patch('/{user}/users-level-two-restore', [UserControllerLevelTwo::class, 'restore'])->name('users-level-two.restore');
    Route::delete('/{user}/users-level-two-force-delete', [UserControllerLevelTwo::class, 'forceDelete'])->name('users-level-two.force-delete');







});
