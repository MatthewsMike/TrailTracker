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
Route::post('save-new-marker', 'MapController@saveNewMarker');
Route::post('get-maintenance-markers', 'MapController@GetAllTasksInDateRangeJSON');
Route::post('get-points-of-interest-markers', 'MapController@GetAllPointsOfInterestJSON');

Route::get('/welcome', function () {
    return view('welcome');
});
