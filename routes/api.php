<?php

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

Route::post('login', 'Api\AuthController@login')->name('api.login');
Route::post('register', 'Api\AuthController@register')->name('api.register');
Route::post('talent-register', 'Api\AuthController@talent_register')->name('api.talent_register');
Route::post('refreshtoken', 'Api\AuthController@refreshToken')->name('api.refreshtoken');
Route::get('unauthorized', 'Api\AuthController@unauthorized')->name('api.unauthorized');

Route::group(['prefix' => 'user', 'middleware' => ['CheckClientCredentials','auth:api']], function() {
    Route::post('/home', 'Api\AppController@home')->name('api.user.home');
    Route::post('/category', 'Api\AppController@category')->name('api.user.category');
    Route::post('/talent-profile/{username}', 'Api\AppController@talent_profile')->name('api.user.talent.profile');
    Route::post('/talent-profile/{id}/follow', 'Api\AppController@follow')->name('api.user.talent.follow');
    Route::post('/talent-profile/{id}/unfollow', 'Api\AppController@unfollow')->name('api.user.talent.unfollow');
    Route::post('/about', 'Api\AppController@about')->name('api.user.about');
    Route::post('/faq', 'Api\AppController@faq')->name('api.user.faq');
    Route::post('/tos', 'Api\AppController@tos')->name('api.user.tos');
    Route::post('/ppy', 'Api\AppController@ppy')->name('api.user.ppy');
    Route::post('/profile', 'Api\UserController@profile')->name('api.user.profile');
    Route::post('/profile-update', 'Api\UserController@profile_update')->name('api.user.profile.update');
    Route::post('/account-deactivate', 'Api\UserController@account_deactivate')->name('api.user.account.deactivate');
    Route::post('/logout', 'Api\UserController@logout')->name('api.user.logout');
});
