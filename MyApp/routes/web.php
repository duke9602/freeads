<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

//public routes
Route::get('/', [AnnonceController::class,'index'])->name('home');

Route::get('/annonces', [AnnonceController::class,'index'])->name('annonces.index');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//private routes annonces

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/annonces/create', [AnnonceController::class,'create'])->name('annonces.create');
    Route::post('/annonces', [AnnonceController::class,'store'])->name('annonces.store');
    Route::get('/annonces/{id}/edit', [AnnonceController::class,'edit'])->name('annonces.edit');
    Route::put('/annonces/{id}', [AnnonceController::class,'update'])->name('annonces.update');
    Route::delete('/annonces/{id}', [AnnonceController::class,'destroy'])->name('annonces.destroy');


    Route::resource('categories', CategoryController::class);
});

//annonces show public
Route::get('/annonces/{id}', [AnnonceController::class,'show'])->name('annonces.show');

//la route pour l'admin dashboard
Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/annonces', [AdminController::class,'annonces'])->name('admin.annonces');
    Route::get('/admin/users', [AdminController::class,'users'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminController::class,'destroy'])->name('admin.destroyUser');
    Route::delete('/admin/annonces/{id}', [AdminController::class,'destroyAnnonce'])->name('admin.destroyAnnonce');
    Route::put('/admin/users/{id}/make-admin', [AdminController::class,'isAdmin'])->name('admin.makeAdmin');
    Route::put('/admin/users/{id}/remove-admin', [AdminController::class,'removeAdmin'])->name('admin.removeAdmin');
});

//la route pour le user
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/user/dashboard', [UserController::class,'dashboard'])->name('user.dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
