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
//  Modules
Route::group(['prefix' => 'modules','as'=>'modules.'], function () {
    Route::get('/', 'ModulesController@index')->name('index');
    Route::post('create', 'ModulesController@store')->name('create');
    Route::get('{module_id}/chapters','ModulesController@show')->name('show');
    Route::put('update', 'ModulesController@update')->name('update');
});
//  Chapters
Route::group(['prefix' => 'chapters','as'=>'chapters.'], function () {
    Route::get('/', 'ChaptersController@index')->name('index');
    Route::post('create', 'ChaptersController@store')->name('create');
    Route::get('/{chapter_id}/parts','ChaptersController@show')->name('show');
    Route::put('update', 'ChaptersController@update')->name('update');
});
//  Parts
Route::group(['prefix' => 'parts','as'=>'parts.'], function () {
    Route::get('/', 'PartsController@index')->name('index');
    Route::post('create', 'PartsController@store')->name('create');
    Route::get('{part_id}/questions', 'PartsController@show')->name('show');
    Route::put('update', 'PartsController@update')->name('update');
});
//Classes
Route::group(['prefix' => 'classes','as'=>'classes.'], function () {
    Route::get('/', 'ClassesController@index')->name('index');
    Route::post('create', 'ClassesController@store')->name('create');
    Route::get('{class_id}/students', 'ClassesController@students')->name('students');
    Route::get('students/{id}', 'ClassesController@show_exam')->name('show_exam');
});
//Participated
Route::group(['prefix' => 'participated','as'=>'participated.'], function () {
    Route::get('/', 'ParticipatedController@index')->name('index');
    Route::get('{participate_id}/students', 'ParticipatedController@show')->name('show');
    Route::post('join', 'ParticipatedController@joinClass')->name('join');
    Route::get('{class_id}/show','ParticipatedController@show')->name('show');
});
//Questions
Route::group(['prefix' => 'questions','as'=>'questions.'], function () {
    Route::get('/', 'QuestionsController@index')->name('index');
    Route::post('create', 'QuestionsController@store')->name('create');
    Route::post('import','QuestionsController@import')->name('import');
    Route::get('{question_id}/destroy','QuestionsController@destroy')->name('destroy');
    Route::get('download','QuestionsController@download')->name('download');
});
//Exams
Route::group(['prefix' => 'exams','as'=>'exams.'], function () {
    Route::get('/', 'ExamsController@index')->name('index');
    Route::post('create', 'ExamsController@store')->name('create');
    Route::get('{exam_id}/show', 'ExamsController@show')->name('show');
    Route::get('{exam_id}/export', 'ExamsController@export')->name('export');
});
// Config exam
Route::group(['prefix' => 'configs','as'=>'configs.'], function () {
    Route::get('{exam_id}/', 'ConfigsController@index')->name('index');
    Route::post('config','ConfigsController@storeConfig')->name('storeConfig');
});
//Do Exams
Route::group(['prefix' => 'do_exams','as'=>'do_exams.'], function () {
    Route::get('/', 'DoExamsController@index')->name('index');
    Route::get('{exam_id}/perform', 'DoExamsController@perform')->name('perform');
    Route::post('perform', 'DoExamsController@successPerform')->name('successPerform');
    Route::get('{exam_id}/result', 'DoExamsController@result')->name('result');
    Route::get('{exam_id}/show_result', 'DoExamsController@show_result')->name('show_result');
});
// Ajax
Route::group(['prefix'=>'ajax', 'as'=>'ajax.'],function(){
    Route::post('chapters','AjaxController@getChapter');
    Route::post('class','AjaxController@getClass');
    Route::post('parts','AjaxController@getPart');
    Route::post('check_question','AjaxController@check_question');
    Route::post('show_detail','AjaxController@show_detail');
});
//Profile
Route::post('/','UserController@profile')->name('profile');
