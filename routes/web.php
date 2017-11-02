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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{name}', "ProfileController@otherProfile");
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/inbox', 'InboxController@index')->name('inbox');
Route::get('/message', 'MessageController@index')->name('message');
Route::get('/newmessage', 'NewMessageController@index')->name('newmessage');
Route::get('/leaderboard/{num}', 'LeaderboardController@index')->name('leaderboard');
Route::get('/changepassword', 'ChangePasswordController@index')->name('changepassword');
Route::get('/editprofile', 'ProfileController@edit')->name('editprofile');
Route::get('/location', 'LocationController@index')->name('location');
Route::get('/statistics', 'StatisticsController@index')->name('statistics');
Route::get('/marketplace', 'MarketplaceController@index')->name('marketplace');
Route::get('/55x45', 'GamblingController@index')->name('55x45');
Route::get('/coinflip', 'GamblingController@coinflip')->name('coinflip');

Route::post('editprofile', 'ProfileController@updateAvatar');
Route::post("/updateDesc",["uses" => "ProfileController@updateDesc", "as"=>"profile.updateDesc"]);
Route::post("/getPlayer",["uses" => "LeaderboardController@getPlayer", "as"=>"leaderboard.getPlayer"]);
Route::post("/getPage",["uses" => "LeaderboardController@getPage", "as"=>"leaderboard.getPage"]);
Route::post("/fly", ["uses" => "LocationController@fly", "as"=>'location.fly']);