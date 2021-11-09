<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // https://stackoverflow.com/a/48154076/9259701
use Illuminate\Support\Facades\File;


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
    return view('welcome');
});

Auth::routes(); // ??
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/{path?}/dashboard', 'testapp');

Route::post('/uploads', [App\Http\Controllers\UploadsController::class, 'uploadImage']);