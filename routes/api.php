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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| Post Api
|--------------------------------------------------------------------------
*/

//student store post api

Route::post('/v1/student/create','student\StudentController@student_store');

//student update post api

Route::match(['put','patch'],'/v1/student/{id}','StudentController@student_update'); 



//authentication route

Route::post('/v1/token', 'Laravel\Passport\Http\Controllers\AccessTokenController@issueToken'); //done