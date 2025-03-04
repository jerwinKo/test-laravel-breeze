<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $data = array(
        "lists" => User::orderBy('id','desc')->paginate(10)
    );
    return view('dashboard',$data);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    Route::prefix('userprofile')->group(function () {
        Route::get('/{userinfo?}', [UserController::class, 'edituser'])->name('user.edit');
        Route::patch('/{userinfo?}', [UserController::class, 'updateuser'])->name('user.update');
        Route::delete('/{userinfo?}', [UserController::class, 'destroyuser'])->name('user.destroy');
    });
    Route::get('/users', [DashController::class, 'index'])->name('users.search');
});

require __DIR__.'/auth.php';
