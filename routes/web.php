<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['guest'])->group(function () {
    Route::get('login', fn() => view('auth.login'))->name('login');
    Route::get('register', fn() => view('auth.register'))->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.req');
    Route::post('login', [AuthController::class, 'login'])->name('login.req');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::get('/createpost', [PostController::class, 'create'])->name('posts.create');
    Route::post('/storepost', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/show', [PostController::class, 'show'])->name('posts.view');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');


    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.self');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/updatepw', [ProfileController::class, 'updatepw'])->name('profile.updatepw');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('profile/edit/password', [ProfileController::class, 'changepw'])->name('profile.changepw');
    Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.other');


});
