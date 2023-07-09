<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\User\ComplaintController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'user.landing_page')->name('user.landing_page');

Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('login', 'create')->name('login');
    Route::post('login', 'authenticate')->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'signOut'])->name('logout');

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile/{user}/edit', 'edit')->name('profile.edit');
        Route::patch('profile/{user}', 'update')->name('profile.update');
    });
    // user access
    // complaints page
    Route::controller(ComplaintController::class)->group(function () {
        Route::get('user/complaints', 'index')->name('user.complaints');
        Route::get('user/complaint/create', 'create')->name('user.complaint.create');
        Route::post('user/complaint/store', 'store')->name('user.complaint.store');
        Route::get('user/complaint/{complaint}/edit', 'edit')->name('user.complaint.edit');
        Route::patch('user/complaint/{complaint}', 'update')->name('user.complaint.update');
        Route::delete('user/complaint/{complaint}', 'destroy')->name('user.complaint.destroy');
    });

    // admin access
    // users page
    Route::controller(UserController::class)->group(function () {
        Route::get('admin/users', 'index')->name('admin.users');
        Route::get('admin/user/create', 'create')->name('admin.user.create');
        Route::post('admin/user/store', 'store')->name('admin.user.store');
        Route::get('admin/user/{user}/edit', 'edit')->name('admin.user.edit');
        Route::patch('admin/user/{user}', 'update')->name('admin.user.update');
        Route::delete('admin/user/{user}', 'destroy')->name('admin.user.destroy');
    });

    // rooms page
    Route::controller(RoomController::class)->group(function () {
        Route::get('admin/rooms', 'index')->name('admin.rooms');
        Route::get('admin/room/create', 'create')->name('admin.room.create');
        Route::post('admin/room/store', 'store')->name('admin.room.store');
        Route::get('admin/room/{room}/edit', 'edit')->name('admin.room.edit');
        Route::patch('admin/room/{room}', 'update')->name('admin.room.update');
        Route::delete('admin/room/{room}', 'destroy')->name('admin.room.destroy');
        Route::patch('admin/room/clear/{room}', 'clear_the_room')->name('admin.room.clear');
    });

    // complaints page
    Route::controller(AdminComplaintController::class)->group(function () {
        Route::get('admin/complaints', 'index')->name('admin.complaints');
        Route::patch('admin/complaint/{complaint}/process', 'process')->name('admin.complaint.process');
        Route::patch('admin/complaint/{complaint}/finished', 'finished')->name('admin.complaint.finished');
    });
});
