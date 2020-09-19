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
        <div class="card">
            <div class="card-header"><i class="fa fa-diamond i_button_background"></i> VIP</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <h5>VIP will offer you the following:</h5>
                        <ul>
                            <li>
                                Bold name and '★' icon next to your name in the leaderboards.
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

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5>Buy a code</h5>
                        <p>Order a code with the button down here. <br><b>You will receive your code in your email once the payment has been confirmed.</b></p>
                        <button data-shoppy-product="nENJjUd" class="btn btn-success">Buy now!</button>
                        <br><br>

                        <h5>Redeem VIP code</h5>
                        <form method="post" action="{{ route('vip.redeem') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="redeem">A code can only be used once and will active VIP for <b>30 days</b>.</label>
                                <input id="redeem" name="code" class="form-control w-50" type="text"
                                       placeholder="XXXX-XXXX-XXXX"><br>
                                <button type="submit" class="btn btn-default">Redeem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://shoppy.gg/api/embed.js"></script>
@endsection

