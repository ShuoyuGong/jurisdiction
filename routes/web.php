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

// Route::get('/', function () {
//     return view('welcome');
// });

// 创建用户组
Route::get('/create/group_user', 'IndexController@create_group_user');

// 创建权限
Route::get('/create/quanxian', 'IndexController@create_quanxian');

// 给用户添加角色
Route::get('/add/group_user', 'IndexController@add_group_user');


Route::get('/', 'IndexController@index');

Route::get('/check', 'IndexController@check');

Route::get('/html', 'IndexController@html');

// 获取单卡 卡详情
Route::get('/get/card_info', 'IndexController@get_card_info');
// 获取多卡 卡详情
Route::get('/get/cards_info', 'IndexController@get_cards_info');
// 停卡 单卡
Route::get('/stop/card', 'IndexController@stop_card');
// 停卡 多卡
Route::get('/stop/cards', 'IndexController@stop_cards');
// 开卡 单卡
Route::get('/open/card', 'IndexController@open_card');
// 开卡 多卡
Route::get('/open/cards', 'IndexController@open_cards');
