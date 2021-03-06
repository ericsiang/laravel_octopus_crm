<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/admin', function (Request $request) {
    return $request->user();
});
*/

Route::post('login','Api\MemberApiController@login');
Route::post('register','Api\MemberApiController@register');
 //驗證信箱
 Route::get('member/verify_email', 'Api\MemberApiController@verifyEmail');

Route::group(['middleware'=>'auth.jwt'],function(){
    
    Route::group(['middleware'=>'MemberEmailAuth'],function(){
        //新增、編輯會員資料
        Route::put('member/{member}', 'Api\MemberApiController@update');

        Route::get('logout','Api\MemberApiController@logout');
    });

   

    
});

