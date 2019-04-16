<?php

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
//微信
Route::get('weixin/vaild1','Weixin\WeixinController@valid');
//Route::psot('weixin/vaild1','Weixin\WeixinController@valid');
//素材
Route::any('weixin/vaild1','Weixin\WeixinController@wxEvent');

//token
Route::any('weixin/token','Weixin\WeixinController@getAccessToken');
Route::any('weixin/test','Weixin\WeixinController@test');
Route::any('weixin/info','Weixin\WeixinController@getUserInfo');
//微信菜单
Route::any('weixin/card','Weixin\WeixinController@card');
//群发
Route::get('weixin/allsend','Weixin\WeixinController@allsend');
//群发文本消息
Route::get('weixin/send','Weixin\WeixinController@send');