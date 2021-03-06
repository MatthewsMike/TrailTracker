<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'MapController@index');
Route::get('home', 'MapController@index')->name('home');

Route::post('save-edit-marker', 'MapController@saveEditMarker');
Route::post('get-marker-by-id', 'MapController@getMarkerByIDJSON');
Route::post('save-schedule', 'MapController@saveSchedule');
Route::post('get-maintenance-markers', 'MapController@GetAllTasksInDateRangeJSON');
Route::post('get-points-by-type', 'MapController@GetPointsByTypeJSON');
Route::post('get-categories-and-id-by-type', 'MapController@getCategoriesByTypesJSON');
Route::post('get-schedule-by-category-id', 'MapController@getScheduleByCategoryIDJSON');
Route::post('get-schedule-by-point-id', 'MapController@getScheduleByPointIDJSON');
Route::post('get-category-by-category-id', 'MapController@getCategoryByCategoryIDJSON');
Route::post('save-category', 'MapController@saveCategory');
Route::post('execute-validate-pictures', 'MapController@executeVerifyPictures');
Route::post('execute-validate-tasks', 'MapController@executeVerifyTasks');
Route::post('execute-mark-task-complete', 'MapController@executeMarkTaskComplete');
Route::post('execute-mark-maintenance-complete', 'MapController@executeMarkMaintenanceComplete');
Route::post('execute-update-maintenance-rating', 'MapController@executeUpdateMaintenanceRating');


Auth::routes();

