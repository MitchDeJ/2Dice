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
Route::get('/inbox', 'MessageController@inbox')->name('inbox');
Route::get('/message', 'MessageController@viewMessage')->name('message');
Route::get('newmessage/{name}', "MessageController@newTargetMessage");
Route::get('newmessage', "MessageController@newMessage");
Route::get('message/{m}', "MessageController@viewMessage");
Route::get('/leaderboard/{num}', 'LeaderboardController@index')->name('leaderboard');
Route::get('/changepassword', 'ChangePasswordController@index')->name('changepassword');
Route::get('/editprofile', 'ProfileController@edit')->name('editprofile');
Route::get('/location', 'LocationController@index')->name('location');
Route::get('/statistics', 'StatisticsController@index')->name('statistics');
Route::get('/marketplace', 'MarketplaceController@index')->name('marketplace');
Route::get('/55x2', 'GamblingController@index')->name('55x2');
Route::get('/coinflip', 'GamblingController@coinflip')->name('coinflip');
Route::get('/roulette', 'GamblingController@roulette')->name('roulette');
Route::get('/blackjack', 'GamblingController@blackjack')->name('blackjack');
Route::get('/sendcash', 'BusinessController@index')->name('sendcash');
Route::get('/general', 'ShopController@general')->name('general');
Route::get('/prestige', 'ShopController@prestige')->name('prestige');

Route::post('editprofile', 'ProfileController@updateAvatar');
Route::post("/updateDesc",["uses" => "ProfileController@updateDesc", "as"=>"profile.updateDesc"]);
Route::post("/getPlayer",["uses" => "LeaderboardController@getPlayer", "as"=>"leaderboard.getPlayer"]);
Route::post("/getPage",["uses" => "LeaderboardController@getPage", "as"=>"leaderboard.getPage"]);
Route::post("/fly", ["uses" => "LocationController@fly", "as"=>'location.fly']);
Route::post("/roll55x2", ["uses" => "GamblingController@roll55x2", "as"=>'55x2.roll']);
Route::post("/sendMessage", ["uses" => "MessageController@sendMessage", "as"=>"message.send"]);
Route::post("/deletemessage",["uses" => "MessageController@deleteMessage", "as"=>"message.delete"]);
Route::post("/deleteallmessages",["uses" => "MessageController@deleteAllMessages", "as"=>"message.deleteall"]);
Route::post("/readallmessages",["uses" => "MessageController@readAllMessages", "as"=>"message.readall"]);