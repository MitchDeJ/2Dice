<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 8-11-2017
 * Time: 22:33
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-diamond i_button_background"></i> VIP</div>
            <div class="card-body">
                <h5>VIP will offer you the following:</h5>
                <ul>
                    <li>
                        Orange color in the leaderboards.
                    </li>
                    <li>
                        Exclusive title in the title selection screen.
                    </li>
                    <li>
                        3 extra marketplace slots.
                    </li>
                    <li>
                        10 minute flight cooldown.
                    </li>
                    <li>
                        2 extra stock market companies.
                    </li>
                    <li>
                        2 extra VIP jobs.
                    </li>
                    <li>
                        50% more login cash.
                    </li>
                </ul>

                <h5>Prestige points</h5>
                <ul>
                    <li>You can use <b>1</b> Prestige point to claim <b>14 days</b> of VIP status.</li>
                </ul>

                <h5>Donation rewards</h5>
                <ul>
                    <li>Every <b>€1,-</b> you donate, you'll receive 10 days of VIP status.</li>
                    <li>Every <b>€3,-</b> you donate, you'll receive 30 days of VIP status.</li>
                </ul>

                <h5>Instructions</h5>
                <ul>
                    <li>If you would like to donate to become a VIP, please click <a href="https://www.paypal.me/2Dice" target="_blank">here</a> (opens in a new tab)</li>
                    <li>Enter the amount you would like to donate</li>
                    <li>Enter your username as a comment</li>
                    <li>Do <b>not</b> check this checkbox (see screenshot). This will get us less money, and will get you less VIP time</li>
                </ul>
                <img src="{!! url("/img/vipexplain.png") !!}" width="425px" height="488px" style="display: block; margin-bottom: 1%">

                <p>Every donation is appreciated and will be used towards funding the hosting.</p>
                <p>Currently donations are processed manually, so it might take a bit for your VIP status to be granted.</p>
                    <p>If you did not receive your VIP within 24h, please contact us via mail: <a href="mailto:2DiceInfo@gmail.com">2DiceInfo@gmail.com</a></p>
            </div>
        </div>
    </div>
@endsection

