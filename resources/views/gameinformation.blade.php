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
            <div class="card-header"><i class="fa fa-comments i_button_background"></i> Game information -
                <small>last updated 20-12-2017</small>
            </div>
            <div class="card-body">
                <p>This page will explain everything you need to know about 2Dice.</p>

                <h4>What's inside</h4>
                <hr/>
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

                <br><h4>1.1 The basics</h4>
                <hr/>
                <ul>
                    <li>
                        An alternate/second account is <b>not allowed.</b>
                    </li>
                    <li>
                        You start at Prestige 0, Rank 1. 100.000 XP is required to gain a rank.
                    </li>
                    <li>
                        To gain Prestige, you have to reach 100.000xp whilst you're Rank 10 (as if your were ranking to
                        rank 11)
                    </li>
                    <li>
                        Whenever you gain Prestige, you will be reset to rank 1 and gain 1 Prestige point which can be
                        spent in the prestige shop.
                    </li>
                    <li>
                        You receive $200.000 starter cash, this includes your daily login bonus.
                    </li>
                    <li>
                        Every day on login you will receive $100.000.
                    </li>
                    <li>
                        You can send messages to other players by clicking on the envelope in the top right, or visit a
                        player profile and click "Send message" in the top left.
                    </li>
                    <li>
                        If you have unread messages your envelope will turn orange, keep an eye out for this.
                    </li>
                </ul>

                <br><h4>2. Leaderboard</h4>
                <hr/>
                <p>The leaderboard will display all users ordered by power. You can buy power in the general shop, in
                    the
                    shop dropdown.</p>
                <p>There is a max of 25 players per page. You can select a different page in the top right dropdown.</p>
                <p>You can search users by typing their name in the search bar in the top right and pressing enter. If
                    this player exists it will open his profile.</p>

                <br><h4>3. Statistics</h4>
                <hr/>
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

                <br><h4>4. Marketplace</h4>
                <hr/>
                <p>The marketplace s a trading system for players and companies to buy and sell resources and items.</p>
                <p>Users can make Buy or Sell offers and the marketplace will automatically match your offer with other
                    offers. Resources / Cash can always be collected from your offer and is not location-restricted.</p>
                <ul>
                    <li>Your offers can not match up with other offers created by you.</li>
                    <li>Players can not buy from / sell to the company they're part of.</li>
                    <li>Non-VIPs have 3 market slots available, VIPs have 6.</li>
                    <li>Companies have 2 market slots. Upgrades coming soon.</li>
                </ul>

                <br><h4>5. Location</h4>
                <hr/>
                <p>You can fly to another country by paying a small fee. The cooldown is 30 minutes for non-VIPs and 10
                    minutes for VIPs.</p>
                <p>Each location has different objects. If another location has an object with a higher max bet, you
                    might want to fly there.</p>

                <br><h4>6. Objects</h4>
                <hr/>
                <p>Objects are owned by players. There are 4 different objects. An airport, blackjack, 55x2 and a
                    roulette. Every country has these objects.</p>
                <p>Objects can be put up for auction at the <a href="{{ url('/marketplace') }}" class="text-dark">marketplace</a>.
                    The
                    highest bidder at the end of the auction will be the new owner of the object.</p>
                <p>If you own an object, you can change it's maximum bet and deposit/withdraw cash. Make sure there is
                    enough cash in the bank to payout bets.</p>
                <p>If the object doesn't have enough money to payout someone's winnings, you will lose the object and
                    the winner will be the new owner of the object!</p>

                <br><h4>7. VIP</h4>
                <hr/>
                <p>What VIP will offer you is already explained on the VIP page. Click <a href="{{ url('/vip') }}"
                                                                                          class="text-dark"><b>here</b></a>
                    to go there.</p>

                <br><h4>8. Shop</h4>
                <hr/>
                <b>General store</b>
                <p>Here you can buy stuff with cash.</p>

                <b>Prestige shop</b>
                <p>You can spend your prestige points from ranking here.</p>

                <br><h4>9. Betting</h4>
                <hr/>
                <b>55x2</b>
                <p>In this game your place your bet and roll a random number between 1 and 100. If this number is higher
                    than 55 you double your bet!</p>

                <b>Coinflip</b>
                <p>Place your bet and flip a coin against another player. You have a 50/50 chance of winning and so does
                    your opponent.</p>

                <b>Blackjack</b>
                <p>The aim of the game is to create a better hand than the dealer. Create a hand with a value that is as
                    close to 21 as possible, without exceeding 21.</p>
                <p>If your hand exceeds 21 you lose. Have you got a better hand than the dealer? Then you win the amount
                    you bet. Have you got blackjack, meaning two cards that add up to 21? Then you will win 1.5 times
                    your bet!.</p>

                <b>Roulette</b>
                <p>The roulette wheel has three colors and fifteen numbers. 0 is green, 1-7 is red and 8-14 is black. In
                    this game you are able to place an individual bet on each color.</p>
                <p>Black and red will double your money, whereas the risky green will multiply your bet by 13!</p>

                <br><h4>10. Business</h4>
                <hr/>
                <b>Send cash</b>
                <p>Here you can send cash to another player if you wish to.</p>

                <b>Stock market</b>
                <p>The stock market has the ability of making or losing you cash over time. Use your cash to invest into
                    companies and hope for the prices to change in your favour.</p>
                <p>The prices of the stock market update every hour (12:00, 13:00, 14:00 etc.). Stocks have a minimum
                    price of $500 and a maximum price of $1500.</p>

                <b>Collaboration</b>
                <p>Every 4 hours you can do a business collaboration with another player. This activity has a 80% chance
                    of profiting you 200k each, a 10% chance of 100k each and a 10% chance of 400k each.</p>

                <b>Jobs</b>
                <p>Jobs can be done for cash and XP. You can choose on which option to focus in the dropdown. Focus on
                    cash to receive more cash, focus on XP to gain more XP. Jobs have different cooldowns and
                    rewards.</p>

                <br><h4>11. Profile</h4>
                <hr/>
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

                <br><h4>12. Titles</h4>
                <hr/>
                <p>Titles are displayed in front of your name and are a way of showing off certain achievements.</p>
                <p>Some titles can be bought with cash, whilst others can be unlocked with other requirements. To
                    unlock/activate a title click 'Title selection' whilst editing your profile.</p>

                <br><h4>13. Company</h4>
                <hr/>
                <b>Creating a company</b>
                <p>Creating a company costs <b>$500.000</b>. Your company will be located in your current location.</p>
                <p> You can also choose a factory type you'd like to build. You're only able to choose from gathering
                    factories as your first factory. (More about factories below</p>
                <b>Company leaderboard</b>
                <p>The company leaderboard will display all companies ordered by level. Gain levels by building and
                    upgrading factories.</p>
                <b>Company profile</b>
                <p>The company's profile can be viewed by anyone. It shows some general information about the
                    company:</p>
                <ul>
                    <li>
                        Leaderboard position
                    </li>
                    <li>
                        Level
                    </li>
                    <li>
                        Total power
                    </li>
                    <li>
                        Owner
                    </li>
                    <li>
                        Creation date
                    </li>
                    <li>
                        Location
                    </li>
                    <li>
                        Member list
                    </li>
                </ul>
                <b>Company dashboard</b>
                <p>The company's dashboard is only accessible by members of the company.</p>
                <p>From here you can access these pages:</p>
                <ul>
                    <li>
                        Expand - Build & upgrade factories, buy more storage.
                    </li>
                    <li>
                        Manage - Set roles for every member, or kick them to remove them from the company.
                    </li>
                    <li>
                        Marketplace - Access the company's marketplace slots.
                    </li>
                    <li>
                        Join requests - Accept or decline join requests here.
                    </li>
                    <li>
                        Options - The owner can change the company's options here. Members can only view them.
                    </li>
                </ul>
                <p>The company dashboard page also shows how many resources and how much cash the company currently has in
                    storage.</p>

                <b>Roles</b>
                <p>In the options menu, the owner can restrict certain actions to certain roles.</p>
                <p>Available roles:</p>
                <ul>
                    <li>
                        Member (default)
                    </li>
                    <li>
                        Moderator
                    </li>
                    <li>
                        Admin
                    </li>
                    <li>
                        Owner (restricted to one player)
                    </li>
                </ul>
                <b>Factories</b>
                <p>Companies can build up to <b>4</b> factories. Factories gather or produce resources <b>every hour</b> which will be
                    stored in the company's storage.</p>
                <p>Available factories:</p>
                <p>Gathering</p>
                <ul>
                    <li>
                        Lumberyard (gathers wood)
                    </li>
                    <li>
                        Quarry (gathers stone)
                    </li>
                    <li>
                        Oil rig (gathers oil)
                    </li>
                </ul>
                <p>Processing</p>
                <ul>
                    <li>
                        Sawmill (Processes 2 wood into 1 plank)
                    </li>
                    <li>
                        Brickworks (Processes 2 stone into 1 brick)
                    </li>
                    <li>
                        Sawmill (Processes 2 oil into 1 gasoline)
                    </li>
                </ul>
                <p>Factories can be upgraded for an increasing cost of cash and resources. This will increase it's efficiency per hour.</p>
                <b>Selling resources</b>
                <p>Resources can be quick-sold on the company dashboard page. For current quick sell prices, check the "Prices" tab. <b>Prices change every 6 hours.</b></p>
                <p>If you would like to decide on the pricing yourself, consider selling resources to other players/companies using the marketplace.</p>
                <br>
                <p>Is there any information we did not include? <a href="mailto:2DiceInfo@gmail.com">Let us know!</a></p>
            </div>
        </div>
    </div>
@endsection
