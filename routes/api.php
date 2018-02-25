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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
  
 
 
Route::get('/all_cat', 'apicompanycategoryController@index');
Route::get('/company_data/{id}', 'apiCompaniesController@show');
Route::get('/cat_company_data/{cat_id}', 'apiCompaniesController@cat');
Route::post('/add_company_data', 'apiCompaniesController@store');
Route::get('/company_jobs/{company_id}', 'apijobsController@index');
Route::get('/single_job/{job_id}', 'apijobsController@show');
Route::get('/company_product/{company_id}', 'apiproductController@index');
Route::get('/single_product/{single_id}', 'apiproductController@show');





// user routes

Route::post('/logging-user', 'apiSigninController@apiSignin');
Route::post('/create-user', 'apiSigninController@apiSignup');


// profile routes
Route::get('/profile/{id}','apiProfileController@apiGetProfile');
Route::post('/create-profile','apiProfileController@apiCreateProfile');
Route::put('/update-profile','apiProfileController@apiUpdateProfile');

  
 
// post routes
Route::get('/posts','apiPostController@index');
Route::post('/posts','apiPostController@getPosts');
Route::post('/create-post','apiPostController@store');
route::get('/post/{id}','apiPostController@show');
route::put('/post/{id}/edit','apiPostController@update');
route::delete('/post/{id}','apiPostController@delete');
 