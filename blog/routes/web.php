<?php
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('user/{id}/profile', 'UserProfileController@show')->name('user_profile.show');
    Route::get('user/{id}/profile/edit', 'UserProfileController@edit')->name('user_profile.edit');
    Route::match(['put', 'patch'], 'user/{user}/profile', 'UserProfileController@update')->name('user_profile.update');
    Route::get('/hash_tags/{id}/tweets', 'TweetController@showByHashTag')->name('hash_tags.tweets');
});
// Route::get('/tweets', 'TweetController@index');
// Route::get('/tweets/create', 'TweetController@create');
// Route::post('/tweets', 'TweetController@store');
// Route::get('/tweets/{id}', 'TweetController@show');
// Route::get('/tweets/{id}/edit', 'TweetController@edit');
// Route::put('/tweets/{id}', 'TweetController@update');
// Route::delete('/tweets/{id}', 'TweetController@destroy');
Route::resource('/tweets', 'TweetController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
