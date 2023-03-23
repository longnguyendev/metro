<?php

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

Route::get('/', function () {
    return view('index');
});
Route::get('/ticket/register', function () {
    return view('register');
});
Route::get('/ticket/info', function () {
    return view('ticket');
});
// Route::get('/ticket/datve', function () {
//     return view('datve');
// });
