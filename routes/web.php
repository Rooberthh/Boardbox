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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/projects/create', 'ProjectsController@create')->name('projects.create');
Route::get('/projects', 'ProjectsController@index')->name('projects.index');
Route::post('/projects', 'ProjectsController@store')->name('projects.store');
Route::delete('/projects/{category}/{project}', 'ProjectsController@destroy')->name('projects.destroy');
Route::patch('/projects/{category}/{project}', 'ProjectsController@update')->name('projects.update');

Route::get('/projects/{category}', 'ProjectsController@index');

Route::get('/me', 'ProfilesController@show')->name('profile.show');
