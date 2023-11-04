<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PostController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/map', 'map')->name('map');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::post('/cat', 'cat')->name('cat');
    
});

Route::get('/chat', [ChatController::class, 'chat']);
Route::post('/chat', [ChatController::class, 'sendMessage']);
Route::get('/chat/{user}', [ChatController::class, 'openChat']);

// Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth");
Route::get('/categories/{category}', [CategoryController::class,'show'])->middleware("auth"); //試し
Route::get('/categories/{category}/{style}', [CategoryController::class,'style'])->middleware("auth");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';