<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $data = array(
        "lists" => User::get()
    );
    return view('dashboard',$data);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userprofile/{userinfo?}', [UserController::class, 'edituser'])->name('user.edit');
    Route::patch('/userprofile/{userinfo?}', [UserController::class, 'updateuser'])->name('user.update');
});

require __DIR__.'/auth.php';
