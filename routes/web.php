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
Route::get('/', 'MapController@index');
Route::post('save-edit-marker', 'MapController@saveEditMarker');
Route::post('get-marker-by-id', 'MapController@getMarkerByIDJSON');
Route::post('save-category-schedule', 'MapController@saveCategorySchedule');
Route::post('get-maintenance-markers', 'MapController@GetAllTasksInDateRangeJSON');
Route::post('get-points-of-interest-markers', 'MapController@GetAllPointsOfInterestJSON');
Route::post('get-categories-and-id-by-type', 'MapController@getCategoriesByTypesJSON');
Route::post('get-schedule-by-category-id', 'MapController@getScheduleByCategoryIDJSON');
Route::post('get-category-by-category-id', 'MapController@getCategoryByCategoryIDJSON');
Route::post('save-category', 'MapController@saveCategory');
Route::post('execute-validate-pictures', 'MapController@executeVerifyPictures');
Route::post('execute-validate-tasks', 'MapController@executeVerifyTasks');
Route::post('execute-mark-task-complete', 'MapController@executeMarkTaskComplete');
Route::post('execute-mark-maintenance-complete', 'MapController@executeMarkMaintenanceComplete');


Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
