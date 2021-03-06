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


//student bank create post api

Route::post('/v1/student/bank/new','\App\Http\Controllers\StudentController@student_bank_store');  //done

//parent create post api

Route::post('/v1/student/parent/new','\App\Http\Controllers\StudentController@parent_store');  //done

//student academic create post api

Route::post('/v1/student/academic/new','\App\Http\Controllers\StudentController@student_academic_store');  //done


//student document create post api

Route::post('/v1/student/document/new','\App\Http\Controllers\StudentController@student_document_store');  //done





//staff creation post api

Route::post('/v1/staff/new','\App\Http\Controllers\StaffDetailController@staff_store');  //done

//staff address create post api

Route::post('/v1/staff/address/new','\App\Http\Controllers\StaffDetailController@staff_address_store');  //done

//staff bank create post api

Route::post('/v1/staff/bank/new','\App\Http\Controllers\StaffDetailController@staff_bank_store');  //done


//staff creation post api

Route::post('/v1/staff/qualification/new','\App\Http\Controllers\StaffDetailController@staff_qualification_store');  //done


//student document create post api

Route::post('/v1/staff/document/new','\App\Http\Controllers\StaffController@staff_document_store');  //done



/*
|--------------------------------------------------------------------------
| update Api
|--------------------------------------------------------------------------
*/


//student update  api

Route::match(['put','patch'],'/v1/student/edit/{id}','\App\Http\Controllers\StudentController@student_update'); //done 

//student address update api

Route::match(['put','patch'],'/v1/student/address/edit/{id}','\App\Http\Controllers\StudentController@student_address_update'); //done 

//student bank update api

Route::match(['put','patch'],'/v1/student/bank/edit/{id}','\App\Http\Controllers\StudentController@student_bank_update'); //done 

//parent update  api

Route::match(['put','patch'],'/v1/student/parent/edit/{id}','\App\Http\Controllers\StudentController@parent_update'); //done 

//student academic update  api

Route::match(['put','patch'],'/v1/student/academic/edit/{id}','\App\Http\Controllers\StudentController@student_academic_update'); //done 



//staff update  api

Route::match(['put','patch'],'/v1/staff/edit/{id}','\App\Http\Controllers\StaffDetailController@staff_update'); //done 

//staff address update api

Route::match(['put','patch'],'/v1/staff/address/edit/{id}','\App\Http\Controllers\StaffDetailController@staff_address_update'); //done 

//staff bank update api

Route::match(['put','patch'],'/v1/staff/bank/edit/{id}','\App\Http\Controllers\StaffDetailController@staff_bank_update'); //done 


//staff qualification update api

Route::match(['put','patch'],'/v1/staff/qualification/edit/{id}/{type}','\App\Http\Controllers\StaffDetailController@staff_qualification_update'); //done 






//authentication route

Route::post('/v1/token', 'Laravel\Passport\Http\Controllers\AccessTokenController@issueToken'); //done