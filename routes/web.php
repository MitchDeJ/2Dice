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
    return redirect('/login');
});

Auth::routes();

Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register');
Route::get('/--forcelogin', 'Auth\LoginController@forceLogin')->name('forcelogin');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{name}', "ProfileController@otherProfile");
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/inbox', 'MessageController@inbox')->name('inbox');
Route::get('/message', 'MessageController@viewMessage')->name('message');
Route::get('newmessage/{name}', "MessageController@newTargetMessage");
Route::get('newmessage', "MessageController@newMessage");
Route::get('newglobalmessage', "MessageController@newGlobalMessage");
Route::get('message/{m}', "MessageController@viewMessage");
Route::get('/leaderboard/{num}', 'LeaderboardController@index')->name('leaderboard');
Route::get('/changepassword', 'ChangePasswordController@index')->name('changepassword');
Route::get('/editprofile', 'ProfileController@edit')->name('editprofile');
Route::get('/titleselection', 'ProfileController@titleIndex')->name('titeselection');
Route::get('/location', 'LocationController@index')->name('location');
Route::get('/statistics', 'StatisticsController@index')->name('statistics');
Route::get('/marketplace', 'MarketplaceController@index')->name('marketplace');
Route::get('/newoffer', 'MarketplaceController@newOffer')->name('newoffer');
Route::get('/companymarket', 'MarketplaceController@companyIndex')->name('companymarket');
Route::get('/newcompanyoffer', 'MarketplaceController@newCompanyOffer')->name('newcompanyoffer');
Route::get('/marketprices', 'MarketplaceController@marketPrices')->name('marketPrices');
Route::get('/55x2', 'GamblingController@diceIndex')->name('55x2');
Route::get('/coinflip', 'GamblingController@coinflipIndex')->name('coinflip');
Route::get('/roulette', 'GamblingController@rouletteIndex')->name('roulette');
Route::get('/blackjack', 'BlackjackController@blackjackIndex')->name('blackjack');
Route::get('/newauction', 'AuctionController@newAuction')->name('newauction');
Route::get('/sendcash', 'BusinessController@sendCashIndex')->name('sendcash');
Route::get('/general', 'ShopController@general')->name('general');
Route::get('/prestige', 'ShopController@prestige')->name('prestige');
Route::get('/collab', 'BusinessController@collabIndex')->name('collab');
Route::get('/stockmarket', 'StocksController@index')->name('stockmarket');
Route::get('/jobs', 'JobsController@index')->name('jobs');
Route::get('/vip', 'VipController@index')->name('vip');
Route::get('/gameinformation', 'DashboardController@gameinformation')->name('gameinformation');
Route::get('/objectoverview', 'ObjectController@objectOverview')->name('objectoverview');
Route::get('/companycreate', 'CompanyController@companyCreate')->name('companycreate');
Route::get('/companyprofile', 'CompanyController@companyProfile')->name('companyprofile');
Route::get('/editcompanyprofile', 'CompanyController@editProfile')->name('editcompanyprofile');
Route::get('/companyprofile/{name}', "CompanyController@otherProfile");
Route::get('/companyleaderboard/{num}', 'LeaderboardController@companyIndex')->name('companyleaderboard');
Route::get('/companydashboard', 'CompanyController@companyDashboard')->name('companydashboard');
Route::get('/viewrequests', 'CompanyController@viewRequests')->name('viewrequests');
Route::get('/managemembers', 'CompanyController@manageMembers')->name('managemembers');
Route::get('/companyoptions', 'CompanyController@companyOptions')->name('companyOptions');
Route::get('/expand', 'CompanyController@expand')->name('expand');
Route::get('/build', 'FactoryController@buildView')->name('build');
Route::get('/adminpanel', 'AdminController@index')->name('adminpanel');
Route::get('/factory/{num}', 'FactoryController@factoryPage');

Route::post('editprofile', 'ProfileController@updateAvatar');
Route::post("/updateDesc",["uses" => "ProfileController@updateDesc", "as"=>"profile.updateDesc"]);
Route::post("/getPlayer",["uses" => "LeaderboardController@getPlayer", "as"=>"leaderboard.getPlayer"]);
Route::post("/getPage",["uses" => "LeaderboardController@getPage", "as"=>"leaderboard.getPage"]);
Route::post("/getCompany",["uses" => "LeaderboardController@getCompany", "as"=>"leaderboard.getcompany"]);
Route::post("/getCompanyPage",["uses" => "LeaderboardController@getCompanyPage", "as"=>"leaderboard.getcompanypage"]);
Route::post("/fly", ["uses" => "LocationController@fly", "as"=>'location.fly']);
Route::post("/roll55x2", ["uses" => "GamblingController@roll55x2", "as"=>'55x2.roll']);
Route::post("/sendMessage", ["uses" => "MessageController@sendMessage", "as"=>"message.send"]);
Route::post("/sendGlobalMessage", ["uses" => "MessageController@sendGlobalMessage", "as"=>"message.sendglobal"]);
Route::post("/deletemessage",["uses" => "MessageController@deleteMessage", "as"=>"message.delete"]);
Route::post("/deleteallmessages",["uses" => "MessageController@deleteAllMessages", "as"=>"message.deleteall"]);
Route::post("/readallmessages",["uses" => "MessageController@readAllMessages", "as"=>"message.readall"]);
Route::post("/buypower",["uses" => "ShopController@buyPower", "as"=>"shop.buypower"]);
Route::post("/claimpower",["uses" => "ShopController@claimPower", "as"=>"shop.claimpower"]);
Route::post("/claimcash",["uses" => "ShopController@claimCash", "as"=>"shop.claimcash"]);
Route::post("/claimvip",["uses" => "ShopController@claimVIP", "as"=>"shop.claimvip"]);
Route::post("/claimgms",["uses" => "ShopController@claimGMs", "as"=>"shop.claimgms"]);
Route::post("/createoffer",["uses" => "MarketplaceController@createOffer", "as"=>"market.newoffer"]);
Route::post("/collectoffer",["uses" => "MarketplaceController@collectOffer", "as"=>"market.collect"]);
Route::post("/canceloffer",["uses" => "MarketplaceController@cancelOffer", "as"=>"market.cancel"]);
Route::post("/createcompanyoffer",["uses" => "MarketplaceController@createCompanyOffer", "as"=>"market.newcompanyoffer"]);
Route::post("/collectcompanyoffer",["uses" => "MarketplaceController@collectCompanyOffer", "as"=>"market.companycollect"]);
Route::post("/changepass",["uses" => "ChangePasswordController@changePassword", "as"=>"changepass"]);
Route::post("/cashsender",["uses" => "BusinessController@sendCash", "as"=>"business.sendcash"]);
Route::post("/objectmaxbet",["uses" => "ObjectController@changeMaxBet", "as"=>"object.maxbet"]);
Route::post("/objectbank",["uses" => "ObjectController@bankObject", "as"=>"object.bank"]);
Route::post("/spinroulette",["uses" => "GamblingController@spinRoulette", "as"=>"roulette.spin"]);
Route::post("/newcoinflip",["uses" => "GamblingController@newCoinflip", "as"=>"coinflip.new"]);
Route::post("/cancelcoinflip",["uses" => "GamblingController@cancelCoinflip", "as"=>"coinflip.cancel"]);
Route::post("/playcoinflip",["uses" => "GamblingController@playCoinflip", "as"=>"coinflip.play"]);
Route::post("/jobs",["uses" => "JobsController@businessJob", "as"=>"business.job"]);
Route::post("/startblackjack",["uses" => "BlackjackController@startBlackJack", "as"=>"blackjack.start"]);
Route::post("/hitblackjack",["uses" => "BlackjackController@hitBlackJack", "as"=>"blackjack.hit"]);
Route::post("/standblackjack",["uses" => "BlackjackController@standBlackJack", "as"=>"blackjack.stand"]);
Route::post("/resetblackjack",["uses" => "BlackjackController@resetBlackJack", "as"=>"blackjack.reset"]);
Route::post("/settitle",["uses" => "ProfileController@setTitle", "as"=>"title.set"]);
Route::post("/unlocktitle",["uses" => "ProfileController@unlockTitle", "as"=>"title.unlock"]);
Route::post("/cleartitle",["uses" => "ProfileController@clearTitle", "as"=>"title.clear"]);
Route::post("/exchangestock",["uses" => "StocksController@exchangeStock", "as"=>"stock.exchange"]);
Route::post("/addauction",["uses" => "AuctionController@addAuction", "as"=>"auction.add"]);
Route::post("/bidauction",["uses" => "AuctionController@bid", "as"=>"auction.bid"]);
Route::post("/newcollab",["uses" => "BusinessController@newCollab", "as"=>"collab.start"]);
Route::post("/cancelcollab",["uses" => "BusinessController@cancelCollab", "as"=>"collab.cancel"]);
Route::post("/joincollab",["uses" => "BusinessController@joinCollab", "as"=>"collab.join"]);
Route::post("/adminaddvip",["uses" => "AdminController@addVip", "as"=>"admin.addvip"]);
Route::post("/adminban",["uses" => "AdminController@ban", "as"=>"admin.ban"]);
Route::post("/adminunban",["uses" => "AdminController@unban", "as"=>"admin.unban"]);
Route::post("/adminsend",["uses" => "AdminController@sendAdminMessage", "as"=>"admin.send"]);
Route::post("/createcompany",["uses" => "CompanyController@createCompany", "as"=>"company.create"]);
Route::post('editcompanyprofile', 'CompanyController@updateAvatar');
Route::post("/companydesc",["uses" => "CompanyController@updateDesc", "as"=>"company.updateDesc"]);
Route::post("/sendjoinrequest",["uses" => "CompanyController@sendJoinRequest", "as"=>"company.joinrequest"]);
Route::post("/acceptrequest",["uses" => "CompanyController@acceptJoinRequest", "as"=>"request.accept"]);
Route::post("/declinerequest",["uses" => "CompanyController@declineJoinRequest", "as"=>"request.decline"]);
Route::post("/kickmember",["uses" => "CompanyController@kick", "as"=>"company.kick"]);
Route::post("/setrole",["uses" => "CompanyController@setRole", "as"=>"company.setrole"]);
Route::post("/disband",["uses" => "CompanyController@disband", "as"=>"company.disband"]);
Route::post("/leave",["uses" => "CompanyController@leave", "as"=>"company.leave"]);
Route::post("/depositcash",["uses" => "CompanyController@depositCash", "as"=>"company.depositcash"]);
Route::post("/deposititem",["uses" => "CompanyController@depositItem", "as"=>"company.deposit"]);
Route::post("/changeowner",["uses" => "CompanyController@changeOwner", "as"=>"company.changeowner"]);
Route::post("/setoption",["uses" => "CompanyController@setOption", "as"=>"company.setoption"]);
Route::post("/quicksell",["uses" => "CompanyController@quickSell", "as"=>"company.quicksell"]);
Route::post("/buystorage",["uses" => "CompanyController@buyStorage", "as"=>"company.buystorage"]);
Route::post("/setSalary",["uses" => "CompanyController@setSalary", "as"=>"company.setsalary"]);
Route::post("/buildfactory",["uses" => "FactoryController@build", "as"=>"factory.build"]);
Route::post("/upgradefactory",["uses" => "FactoryController@upgrade", "as"=>"factory.upgrade"]);
Route::post("/removefactory",["uses" => "FactoryController@remove", "as"=>"factory.remove"]);
Route::post("/redeemvip",["uses" => "SubscriptionController@redeem", "as"=>"vip.redeem"]);

