<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestHomeController::class, 'index']);

Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function (){
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');

    /* #CRUD for 'Project' -----------------------------------------------------
    Route::get('/Projects', [ProjectController::class, 'index'])->('projects.index');
    Route::get('/Projects/{project}', [ProjectController::class, 'show'])->('projects.show');
    Route::get('/Projects/create', [ProjectController::class, 'create'])->('projects.create');
    Route::post('/Projects', [ProjectController::class, 'store'])->('projects.store');
    Route::get('/Projects/{project}/edit', [ProjectController::class, 'edit'])->('projects.edit');
    Route::put('/Projects/{project}', [ProjectController::class, 'update'])->('projects.update');
    Route::delete('/Projects/{project}', [ProjectController::class, 'destroy'])->('projects.destroy'); */

    // Code below groups all the CRUD's routes
    Route::resource('projects', ProjectController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
