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




Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('signin','Admin\LoginController@index')->name('login');
    Route::post('signin','Admin\LoginController@login');
    Route::get('logout','Admin\LoginController@logout')->name('logout');

    Route::middleware(['auth:admin'])->group(function(){
        Route::get('/','Admin\AdminController@index')->name('index');
        Route::post('/display/{account}','Admin\AdminController@changeStatus');
        Route::get('/edit/{account}','Admin\AdminController@edit')->name('edit');
        Route::get('/add','Admin\AdminController@show')->name('show');
        Route::delete('/{account}','Admin\AdminController@destory');
    });



});

