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

Route::get('/', 'HomeController@index')->name('home');
Route::get('admin', function(){
		return view('admin.layouts.index');
});
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'class'],function(){
		Route::get('/','ClassController@getList');

		Route::get('edit/{id}','ClassController@getEdit');
		Route::post('edit/{id}','ClassController@postEdit');

		Route::get('add','ClassController@getAdd');
		Route::post('add','ClassController@postAdd');

		Route::get('delete/{id}','ClassController@getDelete');

	});
	Route::group(['prefix'=>'question'],function(){
		Route::get('/','QuestionController@getList');

		Route::get('edit/{id}','QuestionController@getEdit');
		Route::post('edit/{id}','QuestionController@postEdit');

		Route::get('add','QuestionController@getAdd');
		Route::post('add','QuestionController@postAdd');

		Route::get('delete/{id}','QuestionController@getDelete');

	});
    Route::group(['prefix'=>'question'],function(){
        Route::get('/','QuestionController@getList');

        Route::get('edit/{id}','QuestionController@getEdit');
        Route::post('edit/{id}','QuestionController@postEdit');

        Route::get('add','QuestionController@getAdd');
        Route::post('add','QuestionController@postAdd');

        Route::get('delete/{id}','QuestionController@getDelete');

    });
});