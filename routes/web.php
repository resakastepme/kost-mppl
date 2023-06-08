<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.dashboard');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});
