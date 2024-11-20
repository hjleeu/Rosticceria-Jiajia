<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;

Route::view('/', 'welcome');
Route::get('/Book',[DefaultController::class, 'ShowProducts']);
Route::get('/Dashboard', [DefaultController::class, 'ShowAll']);
Route::post('/SendBooking', [DefaultController::class, 'ConfirmBooking']);