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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/news');
});

Route::resource('/news','NewsController');
Route::get('news/{news}/comments','NewsCommentController@index')->name('comments.index');
Route::get('/mostpopular','NewsController@mostpopular')->name('news.mostpopular');

Route::patch('news/upvote/{news}', 'NewsController@upvote')->name('news.upvote');
Route::patch('news/downvote/{news}', 'NewsController@downvote')->name('news.downvote');
Route::get('news/{news}/comments/create','NewsCommentController@create')->name('comments.create');
Route::post('news/{news}/comments','NewsCommentController@store')->name('comments.store');
Route::get('news/{news}/comments/{comment}/edit','NewsCommentController@edit')->name('comments.edit');
Route::patch('news/{news}/comments/{comment}','NewsCommentController@update')->name('comments.update');
Route::delete('news/{news}/comments/{comment}','NewsCommentController@destroy')->name('comments.destroy');
