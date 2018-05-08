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

Auth::routes();

Route::get('/', 'PostController@getBlogPosts')->name('blog');
Route::match(['get', 'post'], '/posts/add', 'PostController@addBlogPost')->middleware('auth')->name('blog.add');
Route::match(['get', 'post'], '/posts/{id}/update', 'PostController@updateBlogPost')->name('blog.update');
Route::get('/posts/{id}', 'PostController@getBlogPost')->name('blog.post');
Route::post('/posts/{id}/delete', 'PostController@deleteBlogPost')->middleware('auth')->name('blog.delete');
