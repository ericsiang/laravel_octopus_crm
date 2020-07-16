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
        Route::get('/create','Admin\AdminController@show')->name('show');
        Route::post('/','Admin\AdminController@store')->name('store');
        Route::get('/{account}/edit','Admin\AdminController@edit')->name('edit');
        Route::put('/{account}','Admin\AdminController@update')->name('update');
        Route::post('/display/{account}','Admin\AdminController@changeStatus')->name('display');
        Route::delete('/{account}','Admin\AdminController@destory')->name('delete');
        Route::resource('member', 'Admin\Member\MemberController');
        Route::post('/member/display/{member}','Admin\Member\MemberController@changeStatus')->name('member.display');
    });

    

});

