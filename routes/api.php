<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('states/{code}',"Api\StatesController@show");

Route::get('upload/images', "Api\FileUploadController@image");
Route::post('graph/visitors', "Api\GraphController@visitors");

Route::get('redirect/ads/{id}', "Api\RedirectController@ads");