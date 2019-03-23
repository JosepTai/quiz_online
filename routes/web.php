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
//Admin
Route::group(['prefix'=>'admin'],function(){
//    Class
	Route::group(['prefix'=>'classes'],function(){
		Route::get('/','ClassesController@getList');

		Route::get('edit/{id}','ClassesController@getEdit');
		Route::post('edit/{id}','ClassesController@postEdit');

		Route::get('add','ClassesController@getAdd');
		Route::post('add','ClassesController@postAdd');

		Route::get('delete/{id}','ClassesController@getDelete');

	});
//	Question
	Route::group(['prefix'=>'questions'],function(){
		Route::get('/','QuestionsController@getList');

		Route::get('edit/{id}','QuestionsController@getEdit');
		Route::post('edit/{id}','QuestionsController@postEdit');

		Route::get('add','QuestionsController@getAdd');
		Route::post('add','QuestionsController@postAdd');

		Route::get('delete/{id}','QuestionsController@getDelete');

	});
//	Modules
    Route::group(['prefix'=>'modules'],function(){
        Route::get('/','ModulesController@getList');

        Route::get('edit/{id}','ModulesController@getEdit');
        Route::post('edit/{id}','ModulesController@postEdit');

        Route::get('add','ModulesController@getAdd');
        Route::post('add','ModulesController@postAdd');

        Route::get('delete/{id}','ModulesController@getDelete');
//Chapters
        Route::group(['prefix'=>'chapters'],function() {
            Route::get('/{id}','ChaptersController@getList');

            Route::get('edit/{id}','ChaptersController@getEdit');
            Route::post('edit/{id}','ChaptersController@postEdit');

            Route::get('add','ChaptersController@getAdd');
            Route::post('add','ChaptersController@postAdd');

            Route::get('delete/{id}','ChaptersController@getDelete');
//Parts
            Route::group(['prefix'=>'parts'],function() {
                Route::get('/','PartsController@getList');

                Route::get('edit/{id}','PartsController@getEdit');
                Route::post('edit/{id}','PartsController@postEdit');

                Route::get('add','PartsController@getAdd');
                Route::post('add','PartsController@postAdd');

                Route::get('delete/{id}','PartsController@getDelete');
             });
        });

    });
});