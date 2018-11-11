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

Route::get('/', 'PagesController@home');

Route::get('/about', 'PagesController@about');

Route::get('/messages/{message}', 'MessagesController@show');



Auth::routes();

Route::get('/messages', 'MessagesController@search');
Route::get('/{username}', 'UsersController@show');

Route::get('login/facebook', 'SocialAuthController@redirectToProvider')->name('login.facebook');
Route::get('login/facebook/callback', 'SocialAuthController@handleProviderCallback')->name('login.callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

Route::get('/{username}', 'UsersController@show');
Route::get('/{username}/followers', 'UsersController@followers');
Route::post('/{usernane}/follow', 'UsersController@follow');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/conversations/{conversation}', 'UsersController@showConversation');
    Route::post('/messages/create', 'MessagesController@create');
    Route::post('/{username}/dms', 'UsersController@sendPrivateMessage');
    Route::get('/{username}/follows', 'UsersController@follows');    
    Route::post('/{username}/unfollow', 'UsersController@unfollow');    
});
