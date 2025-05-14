<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Authenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/series');
})->middleware(Authenticator::class);

//Route::resource('/series', SeriesController::class)->only('index', 'create', 'store', 'destroy', 'edit');
Route::resource('/series', SeriesController::class)->except(['show'])->middleware(Authenticator::class);

//Route::delete('/series/destroy/{serie}', [SeriesController::class, 'destroy'])->name('series.destroy');

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index')->middleware(Authenticator::class);

Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index')->middleware(Authenticator::class);
Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update')->middleware(Authenticator::class);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('sigin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');


/*
Route::controller(SeriesController::class)->group(function(){
    Route::get('/series',  'index' )->name('series.index');
    Route::get('/series/create', 'create' )->name('series.create');
    Route::post('/series/salvar', 'store' )->name('series.store');
});
*/


