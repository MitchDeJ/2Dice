<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 25-11-2017
 * Time: 20:07
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-comments i_button_background"></i> Game information - <small>last updated 25-11-2017</small></div>
            <div class="card-body">
                <p>This page will explain everything you need to know about 2Dice.</p>

                <h4>What's inside</h4><hr />
                <ol>
                    <li>
                        The basics
                    </li>
                    <li>
                        Leaderboard
                    </li>
                    <li>
                        Statistics
                    </li>
                    <li>
                        Marketplace
                    </li>
                    <li>
                        Location
                    </li>
                    <li>
                        Objects
                    </li>
                    <li>
                        VIP
                    </li>
                    <li>
                        Shop
                    </li>
                    <li>
                        Betting
                    </li>
                    <li>
                        Business
                    </li>
                    <li>
                        Profile
                    </li>
                    <li>
                        Titles
                    </li>
                    <li>
                        Company
                    </li>
                </ol>

                <br><h4>1. The basics</h4><hr />
                <ul>
                    <li>
                        An alternate/second account is <b>not allowed</b>.
                    </li>
                    <li>
                        When you rank up at rank 10 (to rank 11), you will prestige. Your rank will reset back to 1 and become prestige 1. You'll receive one prestige point that you will be able to spend in the prestige shop.
                    </li>
                    <li>
                        You receive $200.000 starter cash, this includes your login money.
                    </li>
                    <li>
                        Every day on login you will receive $100.000.
                    </li>
                    <li>
                        You can send messages to other players by clicking on the envelope in the top right, or visit a player profile and click "Send message" in the top left.
                    </li>
                    <li>
                        If you have unread messages your envelope will turn orange, keep an eye out for this.
                    </li>
                </ul>

                <br><h4>2. Leaderboard</h4><hr />
                <p>The leaderboard will display all users based on power. You can buy power in the general shop, in the shop dropdown.</p>
                <p>There is a max of 25 players per page. You can select a different page in the top right dropdown.</p>
                <p>You can search users by typing their name in the search bar in the top right and pressing enter. If this player exists it will open his profile.</p>

                <br><h4>3. Statistics</h4><hr />
                <p>The statistics will show the top 5 in the following categories</p>
                <ul>
                    <li>
                        Top richest players
                    </li>
                    <li>
                        Top ranked players
                    </li>
                    <li>
                        Top highest bets
                    </li>
                    <li>
                        Top total bets
                    </li>
                </ul>

                <br><h4>4. Marketplace</h4><hr />
                <p>You can buy and sell items here. All offers are from players. If your offers aren't buying or selling any time soon, you might want to change your price.</p>
                <p>You can also bid on objects here or put up an object for auction yourself.</p>

                <br><h4>5. Location</h4><hr />
                <p>You can fly to another location by paying a small fee. The cooldown is 30 minutes or 10 minutes if you're a VIP.</p>
                <p>Each location has different objects. If another location has an object with a higher max bet, you might want to fly there.</p>

                <br><h4>6. Objects</h4><hr />
                <p>Objects are owned by players. There are 4 different objects. An airport, blackjack, 55x2 and a roulette. Each location has these objects.</p>
                <p>Objects can be put to auction at the <a href="{{ url('/marketplace') }}" class="text-dark">marketplace</a>. At the start of a new version all objects will be put up for auction for 24h. The highest bidder will win.</p>
                <p>If you own an object, you can change it's max bet and deposit/withdraw cash. Make sure there is enough money in the bank to payout bets.</p>
                <p>If the casino doesn't have enough money to payout the bet, the winner of the bet will be the new owner of the casino!</p>

                <br><h4>7. VIP</h4><hr />
                <p>What VIP will offer you is already explained on the VIP page. Click <a href="{{ url('/vip') }}" class="text-dark"><b>here</b></a> to go there.</p>

                <br><h4>8. Shop</h4><hr />
                <b>General shop</b>
                <p>You can buy 1 power for $100 here.</p>

                <b>Prestige shop</b>
                <p>You can spend your prestige points from ranking here. You can choose between a few options</p>
                <ul>
                    <li>
                        Power: You will receive an amount of power (amount can change at any moment)
                    </li>
                    <li>
                        Cash: You will receive an amount of cash (amount can change at any moment)
                    </li>
                    <li>
                        VIP: You will receive 14 days of VIP, which provide a few extra's
                    </li>
                    <li>
                        Global message: You will receive one global message point. You will be able to send the same message to every user
                    </li>
                </ul>

                <br><h4>9. Betting</h4><hr />
                <b>55x2</b>
                <p>In this game your place your bet and roll a random number between 1 and 100. If this number is higher than 55 you double your bet!</p>

                <b>Coinflip</b>
                <p>Place your bet and flip a coin against another player. You have a 50/50 chance of winning and so does your opponent.</p>

                <b>Blackjack</b>
                <p>The aim of the game is to create a better hand than the dealer. Create a hand with a value that is as close to 21 as possible, without exceeding 21.</p>
                <p>If your hand exceeds 21 you lose. Have you got a better hand than the dealer? Then you win the amount you bet. Have you got blackjack, meaning two cards that add up to 21? Then you will win 1.5 times your bet!.</p>

                <b>Roulette</b>
                <p>The roulette wheel has three colors and fifteen numbers. 0 is green, 1-7 is red and 8-14 is black. In this game you are able to place an individual bet on each color.</p>
                <p>Black and red will double your money, whereas the risky green will multiply your bet by 13!</p>

                <br><h4>10. Business</h4><hr />
                <b>Send cash</b>
                <p>Here you can send cash to another player if you wish to.</p>

                <b>Stock market</b>
                <p>The stock market has the ability of making or losing you cash over time. Use your cash to invest into companies and hope for the prices to change in your favour.</p>
                <p>The prices of the stock market update every hour (12:00, 13:00, 14:00 etc.). Stocks have a minimum price of $500 and a maximum price of $1500.</p>

                <b>Collaboration</b>
                <p>Every 4 hours you can do a business collaboration with another player. This activity has a 90% chance of giving you 200k each, a 10% chance of giving you 100k each and a 10% chance of giving you 400k each.</p>

                <b>Jobs</b>
                <p>Jobs can be done for money or xp. You can choose on which option to focus in the dropdown. Each job has a different cooldown and amount of money/xp reward.</p>

                <br><h4>11. Profile</h4><hr />
                <p>Every player has a personal profile. This profile consists of the following:</p>
                <ul>
                    <li>
                        An avatar (.JPG or .PNG)
                    </li>
                    <li>
                        A personal description which is displayed under your avatar
                    </li>
                    <li>
                        A title to display a certain achievement in front of your name (optional)
                    </li>
                    <li>
                        Player status (position, prestige, power, cash etc.)
                    </li>
                    <li>
                        About the player (company, location, start date etc.)
                    </li>
                    <li>
                        Player betting stats
                    </li>
                    <li>
                        Player objects
                    </li>
                </ul>

                <br><h4>12. Titles</h4><hr />
                <p>Titles are displayed in front of your name and are a way of showing off certain achievements.</p>
                <p>Some titles can be bought with cash, whilst others can be unlocked with other requirements. To unlock/activate a title click 'Title selection' whilst editing your profile.</p>

                <br><h4>13. Company</h4><hr />
                <p>Coming soon.</p>
            </div>
        </div>
    </div>
@endsection
