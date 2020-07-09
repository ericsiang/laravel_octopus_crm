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

//Route::get('/singin', '');

Route::get('/admin', function () {
    return view('admin.signin');
});

Route::get('/admin/signin', function () {
    return view('admin.signin');
})->name('admin.login');


Route::post('/admin/signin','Admin\LoginController@login');