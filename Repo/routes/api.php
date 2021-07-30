<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//List Articles
Route::get('students','App\Http\Controllers\StudentController@index');

//List Single Article
Route::get('student/{id}','App\Http\Controllers\StudentController@show');

//Create new Article
Route::post('student','App\Http\Controllers\StudentController@store');

//Update Article
Route::put('student','App\Http\Controllers\StudentController@store');

//Delete Article
Route::delete('student/{id}','App\Http\Controllers\StudentController@destroy');

Route::get('students/{selected}/{valueToSearch}','App\Http\Controllers\StudentController@search');