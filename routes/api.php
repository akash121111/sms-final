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

Route::post('/v1/student/new','\App\Http\Controllers\StudentController@student_store');  //done

//student address store post api

Route::post('/v1/student/address/new','\App\Http\Controllers\StudentController@student_address_store');  //done



//staff store post api

Route::post('/v1/staff/new','\App\Http\Controllers\StaffDetailController@staff_store');  //done

//staff address store post api

Route::post('/v1/staff/address/new','\App\Http\Controllers\StaffDetailController@staff_address_store');  //done



/*
|--------------------------------------------------------------------------
| update Api
|--------------------------------------------------------------------------
*/


//student update  api

Route::match(['put','patch'],'/v1/student/edit/{id}','\App\Http\Controllers\StudentController@student_update'); //done 

//student address update api

Route::match(['put','patch'],'/v1/student/address/edit/{id}','\App\Http\Controllers\StudentController@student_address_update'); //done 


//student update  api

Route::match(['put','patch'],'/v1/staff/edit/{id}','\App\Http\Controllers\StaffDetailController@staff_update'); //done 

//student address update api

Route::match(['put','patch'],'/v1/staff/address/edit/{id}','\App\Http\Controllers\StaffDetailController@staff_address_update'); //done 





//authentication route

Route::post('/v1/token', 'Laravel\Passport\Http\Controllers\AccessTokenController@issueToken'); //done