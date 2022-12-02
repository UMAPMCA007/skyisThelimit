<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/form1',[App\Http\Controllers\LogicController::class, 'form1'])->name('form1');
Route::post('/form2',[App\Http\Controllers\LogicController::class, 'form2'])->name('form2');
Route::post('/form3',[App\Http\Controllers\LogicController::class, 'form3'])->name('form3');
