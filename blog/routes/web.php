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
// Route::get('/tweets', 'TweetController@index');
// Route::get('/tweets/create', 'TweetController@create');
// Route::post('/tweets', 'TweetController@store');
// Route::get('/tweets/{id}', 'TweetController@show');
// Route::get('/tweets/{id}/edit', 'TweetController@edit');
// Route::put('/tweets/{id}', 'TweetController@update');
// Route::delete('/tweets/{id}', 'TweetController@destroy');
Route::resource('/tweets', 'TweetController');
