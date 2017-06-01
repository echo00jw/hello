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
/*----测试json---*/
Route::get('/json_index','JsonController@load');//成功就跳转到首页
Route::post('/json_page','JsonController@search');
/*------ajax板块-----*/
Route::post('/functions','AjaxController@change');//ajax
/*-------登陆板块-------*/
Route::get('/login', function () {
    return view('login');
});
Route::post('/indexs','LoginController@Login');//登陆后跳转到首页

/*------首页板块--------*/
Route::post('/search','IndexController@search');
Route::get('/index','IndexController@load');//其他页面跳转到首页


/*------page模块-------*/
Route::get('/page-{articleId}.html','PageController@edit');






Route::post('/upload/insert','uploadController@insert')->name('upload.insert');
