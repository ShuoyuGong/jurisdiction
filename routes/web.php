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
