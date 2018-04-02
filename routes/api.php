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


Route::group(['middleware' => 'apiUser' ], function ()
{


// Msg routes
Route::post('/create_Msg', 'msgController@create_Msg');
Route::post('/Rooms', 'msgController@Rooms');
Route::post('/Msgs', 'msgController@Msgs');
Route::post('/get_my_reserved_message_only', 'msgController@get_my_reserved_message_only');




// user routes
Route::post('/logging-user', 'apiSigninController@apiSignin');
Route::post('/create-user', 'apiSigninController@apiSignup');
Route::post('/active_my_account', 'apiSigninController@active_my_account');
Route::post('/resending_email', 'apiSigninController@resending_email');
Route::post('social_login', 'apiSigninController@social_login');
Route::post('forget_password', 'apiSigninController@forget_password');


// profile routes
Route::post('/profile','apiProfileController@apiGetProfile');
Route::post('/create-profile','apiProfileController@apiCreateProfile');
Route::put('/update-profile','apiProfileController@apiUpdateProfile');


// post routes
Route::post('/all_Post','apiPostController@index');
Route::post('all_Post_by_ownerid_or_companyid','apiPostController@getPosts');
Route::post('/create-post','apiPostController@store');
route::post('/single_post','apiPostController@show');
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
Route::post('/all_cat', 'apicompanycategoryController@index');
Route::post('/get_children', 'apicompanycategoryController@get_children');


// company routes
Route::post('/company_data', 'apiCompaniesController@show');
Route::post('/cat_company_data', 'apiCompaniesController@cat');
Route::post('/get_all_company_in_cat/', 'apiCompaniesController@cat_and_company');
Route::post('/get_popular/', 'apiCompaniesController@get_popular');
//Route::post('/company_like/', 'apiCompaniesController@company_like');
Route::post('/add_company_data', 'apiCompaniesController@store');
Route::post('/company_search', 'apiCompaniesController@company_search');
Route::post('/my_followed_company', 'apiCompaniesController@my_followed_company');
Route::post('/my_company', 'apiCompaniesController@my_company');



//job routes
Route::post('/company_jobs', 'apijobsController@index');
Route::post('/single_job', 'apijobsController@show');
Route::post('/job', 'apijobsController@store');
Route::put('/job/{id}/edit', 'apijobsController@update');
Route::delete('/job/{id}', 'apijobsController@delete');

// product routes
Route::post('/company_product', 'apiproductController@index');
Route::post('/single_product', 'apiproductController@show');
Route::post('/product', 'apiproductController@store');
Route::put('/product/{id}/edit', 'apiproductController@update');
Route::delete('/product/{id}', 'apiproductController@delete');

});