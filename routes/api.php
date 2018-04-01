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




// Msg routes
Route::post('/create_Msg', 'msgController@create_Msg');
Route::post('/Rooms', 'msgController@Rooms');
Route::post('/Msgs', 'msgController@Msgs');
Route::post('/get_my_reserved_message_only', 'msgController@get_my_reserved_message_only');




// user routes
Route::post('/logging-user', 'apiSigninController@apiSignin');
Route::post('/create-user', 'apiSigninController@apiSignup');
Route::get('active_my_account/{userid}/{code}', 'apiSigninController@active_my_account');
Route::get('resending_email/{user_id}', 'apiSigninController@resending_email');
Route::post('social_login', 'apiSigninController@social_login');




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


// Comment Routes
Route::post('/comment', 'apiCommentController@store');
route::put('/comment/{id}/edit','apiCommentController@update');
route::delete('/comment/{id}','apiCommentController@delete');



//  Follow
Route::post('/user_follow', 'followController@user_follow');
route::post('/Company_Follow','followController@Company_Follow');
 Route::post('/user_unfollow', 'followController@user_unfollow');
route::post('/Company_unfollow','followController@Company_unfollow');


//  timeline
Route::post('/timeline', 'timelineController@timeline');
  
 
 
// Like Routes
Route::post('/like', 'apiLikeController@store');
Route::delete('/like/{id}', 'apiLikeController@delete');
//Route::get('count_company_like/{company_id}', 'apiLikeController@count_company_like');


// category routes
Route::get('/all_cat', 'apicompanycategoryController@index');
Route::get('/get_children/{cat_id}', 'apicompanycategoryController@get_children');


// company routes
Route::get('/company_data/{id}', 'apiCompaniesController@show');
Route::get('/cat_company_data/{cat_id}', 'apiCompaniesController@cat');
Route::get('/get_all_company_in_cat/', 'apiCompaniesController@cat_and_company');
Route::get('/get_popular/', 'apiCompaniesController@get_popular');
Route::get('/company_like/', 'apiCompaniesController@company_like');
Route::post('/add_company_data', 'apiCompaniesController@store');
Route::get('/company_search/{keyword}', 'apiCompaniesController@company_search');
Route::post('/my_followed_company', 'apiCompaniesController@my_followed_company');
Route::post('/my_company', 'apiCompaniesController@my_company');



//job routes
Route::get('/company_jobs/{company_id}', 'apijobsController@index');
Route::get('/single_job/{job_id}', 'apijobsController@show');
Route::post('/job', 'apijobsController@store');
Route::put('/job/{id}/edit', 'apijobsController@update');
Route::delete('/job/{id}', 'apijobsController@delete');

// product routes
Route::get('/company_product/{company_id}', 'apiproductController@index');
Route::get('/single_product/{single_id}', 'apiproductController@show');
Route::post('/product', 'apiproductController@store');
Route::put('/product/{id}/edit', 'apiproductController@update');
Route::delete('/product/{id}', 'apiproductController@delete');
