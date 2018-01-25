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

Route::get('/', 'PageController@index');
Route::get('/blog/{blog_post}', 'PageController@singleBlog');
Route::get('/blog-category/{blog_category}', 'PageController@blogCategory');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/categories', 'CategoryController');
Route::get('/categories/change-status/{category}', 'CategoryController@changeStatus');
Route::get('/category/list', 'CategoryController@getCategories')->name('category/list');
Route::resource('/posts', 'PostController');
Route::get('/posts/change-status/{post}', 'PostController@changeStatus');
Route::get('/post/list', 'PostController@getPosts')->name('post/list');