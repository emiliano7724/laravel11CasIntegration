<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\CasController::class, 'casLogin'])->name('login');

Route::get('/validate/cas/user', [\App\Http\Controllers\CasController::class, 'validateUserCas'])->name('validateUserCas');

Route::get('/logout/cas', [\App\Http\Controllers\CasController::class, 'casLogout'])->name('casLogout');


Route::middleware(['web', 'auth'])->group(function () {

    Route::get('home', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');

});