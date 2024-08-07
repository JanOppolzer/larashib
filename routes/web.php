<?php

use App\Http\Controllers\FakeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ShibbolethController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::view('up', 'health-up');
Route::view('/', 'welcome')->middleware('guest');

Route::get('language/{language}', LanguageController::class);

Route::middleware('auth')->group(function () {
    Route::view('home', 'home')->name('home');

    Route::resource('users', UserController::class)->only('index', 'show');
    Route::patch('users/{user}/status', [UserStatusController::class, 'update'])->name('users.status');
    Route::patch('users/{user}/role', [UserRoleController::class, 'update'])->name('users.role');
});

Route::get('login', [ShibbolethController::class, 'create'])->name('login')->middleware('guest');
Route::get('auth', [ShibbolethController::class, 'store'])->middleware('guest');
Route::get('logout', [ShibbolethController::class, 'destroy'])->name('logout')->middleware('auth');

if (App::environment(['local', 'testing'])) {
    Route::post('fakelogin', [FakeController::class, 'store'])->name('fakelogin');
    Route::get('fakelogout', [FakeController::class, 'destroy'])->name('fakelogout');
}
