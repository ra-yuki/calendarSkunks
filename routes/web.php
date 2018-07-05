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

Route::get('/', 'WelcomeController@index')->name('welcome.index');

Route::get('event/create', 'EventsController@create')->name('event.create');
Route::post('event/generate', 'EventsController@generateEvents')->name('event.generate');
Route::post('event/schedule', 'EventsController@scheduleEvents')->name('event.schedule');