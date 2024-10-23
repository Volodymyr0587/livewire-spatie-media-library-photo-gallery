<?php

use App\Livewire\Dashboard;
use App\Livewire\PhotoShow;
use App\Livewire\PhotoUpload;
use App\Livewire\PhotoGallery;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Photos
    Route::prefix('photos')->group(function () {
        Route::get('/', PhotoGallery::class)->name('photos.index');
        Route::get('/upload', PhotoUpload::class)->name('photos.upload');
        Route::get('/{photoId}', PhotoShow::class)->name('photos.show');
    });
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
