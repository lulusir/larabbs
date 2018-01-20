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

// name 可以为路由指定名称，命名路由可以方便地为指定路由生成 URL 或者重定向
Route::get('/', 'PagesController@root')->name('root');
