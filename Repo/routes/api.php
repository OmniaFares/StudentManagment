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

//  List courses for single student

Route::get('courses/{id}','App\Http\Controllers\CourseController@index');

Route::get('courses','App\Http\Controllers\CourseController@index2');

//List Single Article
Route::get('course/{id}','App\Http\Controllers\CourseController@show');

//Create new Article
Route::post('course','App\Http\Controllers\CourseController@store');

//Update Article
Route::put('course','App\Http\Controllers\CourseController@store');

//Delete Article
Route::delete('course/{id}','App\Http\Controllers\CourseController@destroy');

Route::get('Scourses/{valueToSearch}','App\Http\Controllers\CourseController@search');

//-----------------------------------

Route::get('students/{id}','App\Http\Controllers\StudentController@index');

Route::get('students2/{id}','App\Http\Controllers\StudentController@view');

//List Articles
Route::get('students','App\Http\Controllers\StudentController@index2');

//List Single Article
Route::get('student/{id}','App\Http\Controllers\StudentController@show');

//Create new Article
Route::post('student','App\Http\Controllers\StudentController@store');

//Update Article
Route::put('student','App\Http\Controllers\StudentController@store');

//Delete Article
Route::delete('student/{id}','App\Http\Controllers\StudentController@destroy');

Route::get('students/{selected}/{valueToSearch}','App\Http\Controllers\StudentController@search');
//hna
Route::post('studentEnroll','App\Http\Controllers\EnrollmentController@Enroll');