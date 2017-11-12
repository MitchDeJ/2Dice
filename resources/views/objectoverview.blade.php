<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 12-11-2017
 * Time: 19:24
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-globe i_button_background"></i> Objects</div>
            <div class="card-body">
                <p>Objects are owned by players. You can overtake an object by winning an amount, that the object bank does not hold.</p>
                <p>Because the object isn't able to pay you, you will be the new owner of that object.</p>
                <p>You can also buy an object from players, if they put it up for <a href="{{ url('/marketplace') }}">auction</a>.</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;"><img src="img/netherlands.png">
                                        Netherlands
                                    </td>
                                    <td class="table_dark_bg" style="width: 10%;">Owner</td>
                                    <td class="table_dark_bg" style="width: 10%;">Max bet</td>
                                    <td class="table_dark_bg" style="width: 10%;">Profit</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>55x2</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                <tr>
                                    <td>Blackjack</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                <tr>
                                    <td>Roulette</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: red;">-$5000</td>
                                </tr>
                                <tr>
                                    <td>Airport</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;"><img src="img/uk.png"> United Kingdom
                                    </td>
                                    <td class="table_dark_bg" style="width: 10%;">Owner</td>
                                    <td class="table_dark_bg" style="width: 10%;">Max bet</td>
                                    <td class="table_dark_bg" style="width: 10%;">Profit</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>55x2</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                <tr>
                                    <td>Blackjack</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                <tr>
                                    <td>Roulette</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: red;">-$5000</td>
                                </tr>
                                <tr>
                                    <td>Airport</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;"><img src="img/russia.png"> Russia</td>
                                    <td class="table_dark_bg" style="width: 10%;">Owner</td>
                                    <td class="table_dark_bg" style="width: 10%;">Max bet</td>
                                    <td class="table_dark_bg" style="width: 10%;">Profit</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>55x2</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                <tr>
                                    <td>Blackjack</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                <tr>
                                    <td>Roulette</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: red;">-$5000</td>
                                </tr>
                                <tr>
                                    <td>Airport</td>
                                    <td><a href="#" class="text-dark">Username</a></td>
                                    <td>$1000</td>
                                    <td style="color: green;">+$5000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

