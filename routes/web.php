<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/register', [UserController::class, 'createRegister']);
Route::post('/register', [UserController::class, 'storeRegister']);

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'prosesLogin']);

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'checkRole:admin']);
Route::get('/hero', [HeroController::class, 'index'])->middleware(['auth', 'checkRole:admin']);
Route::get('/order', [OrderController::class, 'index'])->middleware(['auth', 'checkRole:admin']);
Route::get('/hero/create', [HeroController::class, 'create'])->middleware(['auth', 'checkRole:admin']);
Route::post('/hero', [HeroController::class, 'store'])->middleware(['auth', 'checkRole:admin']);
Route::get('/hero/{hero}/edit', [HeroController::class, 'edit'])->middleware(['auth', 'checkRole:admin']);
Route::put('/hero/{hero}', [HeroController::class, 'update'])->middleware(['auth', 'checkRole:admin']);
Route::delete('/hero/{hero}', [HeroController::class, 'destroy'])->middleware(['auth', 'checkRole:admin']);

Route::resource('/promotion', PromotionController::class)->middleware(['auth', 'checkRole:admin']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware(['auth', 'checkRole:admin']);
