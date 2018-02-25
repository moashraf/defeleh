<?php
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

Route::group(['middleware' => 'auth'], function ()
{
    Route::resource('mainCompanies', 'mainCompaniesController');
    Route::get('mainCompanies_cat/{cat}', 'mainCompaniesController@cat');


    // ==================== mekk  ====================

    Route::resource('user-profile', 'mainProfileController');

    Route::resource('mainjobs', 'mainjobsController');
    Route::get('company_jobs/{company_id}', 'mainjobsController@Jobs_in_company');



});

Auth::routes();
 
Route::get('/create-user', 'userController@showSignup');
Route::post('/create-user', 'userController@signup')->name('create-user');
Route::get('/logging-user', 'userController@showSignin');
Route::post('/logging-user', 'userController@signin')->name('logging-user');

Route::get('/home', 'HomeController@index');
 
Route::group(['middleware' => 'admin'], function(){

    Route::get('/admin', 'HomeController@index');
 
    Route::resource('profiles', 'profileController');

    Route::resource('posts', 'postController');

    Route::resource('companycategories', 'companycategoryController');

    Route::resource('companies', 'companyController');

    Route::resource('posts', 'postController');

    Route::resource('comments', 'commentController');

    Route::resource('likes', 'likeController');

    Route::resource('jobs', 'jobController');

    Route::resource('products', 'productController');

 
});