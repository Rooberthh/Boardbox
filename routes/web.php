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

Route::get('api/projects/{category}/{project}/tasks', 'Api\ProjectTasksController@index');

Route::get('/', 'ProjectsController@index');
Route::get('/home', 'ProjectsController@index')->name('home');

Auth::routes();

Route::get('/projects/create', 'ProjectsController@create')->name('projects.create');
Route::get('/projects', 'ProjectsController@index')->name('projects.index');
Route::post('/projects', 'ProjectsController@store')->name('projects.store');
Route::get('/projects/{category}/{project}', 'ProjectsController@show')->name('projects.show');
Route::delete('/projects/{category}/{project}', 'ProjectsController@destroy')->name('projects.destroy');
Route::patch('/projects/{category}/{project}', 'ProjectsController@update')->name('projects.update');

Route::post('/projects/{category}/{project}/tasks', 'ProjectTasksController@store')->name('projectTask.store');
Route::patch('/projects/{category}/{project}/tasks/{task}', 'ProjectTasksController@update')->name('projectTask.update');
Route::delete('/projects/{category}/{project}/tasks/{task}', 'ProjectTasksController@destroy')->name('projectTask.destroy');


Route::get('/projects/{category}', 'ProjectsController@index')->name('category.index');

Route::get('/me', 'ProfilesController@show')->middleware('auth')->name('profile.show');
