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

Route::get('/','HomeController@index');
Route::get('/university','HomeController@university');
Route::get('/programme/{id}','HomeController@programme');
Route::get('/get-programme','HomeController@getProgramme');
Route::get('/get-quals','HomeController@getQuals');
Route::post('/save-quals','HomeController@saveQuals');
Route::get('/get-gradelist/{id}','HomeController@getGradelist');

Auth::routes();
Route::post('/save-applicant','HomeController@saveApplicant');
Route::post('/apply-application','HomeController@applyApplication');

Route::group(['middleware' => ['sasadmin']], function () {
/* Setup qualification */
Route::get('/admin/setup-qualification','AdminController@setup_qualification');
Route::get('/admin/data-gradelist/{id}','AdminController@dataGradelist');
Route::get('/admin/get-grade/{id}','AdminController@getGrade');
Route::put('/admin/update-grade/{id}','AdminController@updateGrade');
Route::put('/admin/update-quals/{id}','AdminController@updateQuals');
Route::get('/admin/data-quals','AdminController@dataQuals');
Route::post('/admin/save-quals','AdminController@saveQuals');
/* Verify qualification */
Route::get('/admin/verify-quals','AdminController@verifyQuals');
Route::get('/admin/get-verifyquals','AdminController@getVerifyquals');
Route::put('/admin/update-verifyquals/{id}','AdminController@updateVerifyquals');
/* Register univ */
Route::get('/admin/register-university','AdminController@register_univ');
Route::get('/admin/get-univ','AdminController@getUniv');
Route::get('/admin/show-admin/{id}','AdminController@showAdmin');
Route::post('/admin/save-univ','AdminController@saveUniv');
Route::post('/admin/add-admin','AdminController@addAdmin');
});

Route::group(['middleware' => ['univadmin']], function () {
/* Record programme */
Route::get('/admin/record-programme','AdminController@record_programme');
Route::get('/admin/get-programme/{id}','AdminController@getProgramme');
Route::post('/admin/save-programme','AdminController@save_programme'); 

/* Review Applications */
Route::get('/admin/review-applications/{id?}','AdminController@review_applications');
Route::get('/admin/get-application/{id}','AdminController@getApplication');
Route::get('/admin/success-email/{id}','AdminController@emailSuccess');
Route::get('/admin/unsuccess-email/{id}','AdminController@emailUnsuccess');
});
