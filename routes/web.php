<?php

use Livewire\Volt\Volt;
use App\Livewire\AddRole;
use App\Livewire\CastVote;
use App\Livewire\Dashboard;
use App\Livewire\AddPosition;
use App\Livewire\AddCandidate;
use App\Livewire\VoteCountdown;
use App\Livewire\AddPermission;
use App\Livewire\UserPermission;
use App\Livewire\PostFormLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');



    //guest

    Route::middleware(['guest'])->group(function () {
        // Route::redirect('settings', 'settings/profile');
    

        // Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
        // Volt::route('settings/password', 'settings.password')->name('settings.password');
        // Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    });



    // AUTH
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    Route::get('/post-form', PostFormLivewire::class)->name('post-form');
    Route::get('/add-candidate', AddCandidate::class)->name('add-candidate');
    Route::get('/add-position', AddPosition::class)->name('add-position');
    Route::get('/add-role', AddRole::class)->name('add-role');
    Route::get('/add-permission', AddPermission::class)->name('add-permission');
    Route::get('/user-permission', UserPermission::class)->name('user-permission');
    Route::get('/cast-vote', CastVote::class)->name('cast-vote');
    Route::get('/vote-countdown', VoteCountdown::class)->name('vote-countdown');
    
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


// Route::middleware(['auth:admin'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Route::get('/admin/post-form', PostFormLivewire::class)->name('post-form');
//     Route::get('/admin/add-candidate', AddCandidate::class)->name('add-candidate');
//     Route::get('/admin/add-position', AddPosition::class)->name('add-position');
    
//     Volt::route('/admin/settings/profile', 'settings.profile')->name('settings.profile');
//     Volt::route('/admin/settings/password', 'settings.password')->name('settings.password');
//     Volt::route('/admin/settings/appearance', 'settings.appearance')->name('settings.appearance');
// });


require __DIR__.'/auth.php';
