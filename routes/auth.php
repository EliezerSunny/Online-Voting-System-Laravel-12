<?php

use Livewire\Volt\Volt;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware('guest')->group(function () {
    // Volt::route('login', 'auth.login')
    //     ->name('login');

        Route::get('/login', Login::class)->name('login');

    

    // Volt::route('forgot-password', 'auth.forgot-password')
    //     ->name('password.request');

    // Volt::route('reset-password/{token}', 'auth.reset-password')
    //     ->name('password.reset');

    Route::get('/register', Register::class)->name('register');

});

Route::middleware('auth')->group(function () {

    // Volt::route('register', 'auth.register')
    //     ->name('register');

    Route::get('/register', Register::class)->name('register');

    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
