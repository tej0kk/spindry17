<?php

use App\Http\Controllers\HeroController;
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

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});
Route::get('/profile', function () {
    return view('pages.profile');
});

Route::get('/hero', [HeroController::class, 'index']);
Route::get('/hero/create', [HeroController::class, 'create']);
Route::post('/hero', [HeroController::class, 'store']);
Route::get('/hero/{hero}/edit', [HeroController::class, 'edit']);
Route::put('/hero/{hero}', [HeroController::class, 'update']);
Route::delete('/hero/{hero}', [HeroController::class, 'destroy']);
