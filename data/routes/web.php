<?php

use Illuminate\Support\Facades\Route;

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

#redirect to form controller
Route::redirect('/', '/forms', 301);

#routes forms
Route::resource('forms', 'FormsController');

#routes forms fields

Route::get('forms/{form}/show-fields', 'FieldsController@index')->name('show_fields');

Route::get('forms/{form}/show-result', 'FieldsController@show')->name('show_result');

Route::get('forms/{form}/create-field', 'FieldsController@create')->name('create_field');

Route::get('forms/{form}/edit-field/{field}', 'FieldsController@edit')->name('edit_field');

Route::post('forms/{form}/store-field','FieldsController@store')->name('store_field');

Route::post('forms/{form}/update-field/{field}','FieldsController@update')->name('update_field');

Route::post('forms/{form}/delete-field/{field}', 'FieldsController@destroy')->name('destroy_field');
