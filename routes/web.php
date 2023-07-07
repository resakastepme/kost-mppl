<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'user.landing_page')->name('user.landing_page');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'signOut'])->name('logout');

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // admin access
    Route::get('admin/user', [UserController::class, 'index'])->name('admin.users');
    Route::get('admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('admin/user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::patch('admin/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});
