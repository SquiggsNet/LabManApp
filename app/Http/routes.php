<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('auth.login');
});

Route::auth();

Route::get('/reset', 'PasswordController@index');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::resource('appManagement', 'AppManagementController');

Route::resource('users', 'UserController');
Route::resource('privileges', 'PrivilegeController');

Route::resource('bloodPressures', 'BloodPressureController');
Route::resource('cages', 'CageController');
Route::resource('colonies', 'ColonyController');

Route::resource('mice', 'MouseController');
Route::post('mice/groupTagged', 'MouseController@groupTagged');
Route::post('mice/groupUntagged', 'MouseController@groupUntagged');
Route::post('mice/export', 'MouseController@excel');

Route::resource('experiments', 'ExperimentController');
Route::resource('storages', 'StorageController');
Route::post('storages/export', 'StorageController@excel');

Route::get('boxes/{mice}/create/{storage}', 'BoxController@create');
Route::resource('boxes', 'BoxController');
Route::post('boxes/{id}', 'BoxController@showFiltered');

Route::post('surgeries/{surgery}/remove', 'SurgeryController@remove');
Route::get('surgeries/{mice}/create', 'SurgeryController@create');
Route::resource('surgeries', 'SurgeryController');
Route::resource('tags', 'TagController');
Route::resource('tissues', 'TissueController');
Route::resource('treatments', 'TreatmentController');
Route::resource('weights', 'WeightController');
Route::resource('password', 'PasswordController');



