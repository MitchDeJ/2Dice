<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 23:08
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Blackjack</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => ['55x2.roll'], 'method' => 'post', 'class' => 'form-inline']) !!}
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Bet amount" id="bet" name="bet">
                            <div>
                                <button type="submit" class="btn btn-default">Gamble</button>
                                {!! Form::close() !!}
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 1%;">Player</td>
                                    <td class="table_dark_bg" style="width: 10%;">Card</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Blackjack dealer
                                    </td>
                                    <td>
                                        <img src="img/placeholder.png" width="100px" height="50px"
                                             class="img-thumbnail">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{Auth::user()->name}}
                                    </td>
                                    <td>
                                        <img src="img/placeholder.png" width="100px" height="50px"
                                             class="img-thumbnail">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-default">Take another card</button>
                            <button type="submit" class="btn btn-default">Stop playing</button>
                        </div><br>


                        <h5>Blackjack {{$location->name}}</h5>
                        <p>You are currently the owner of the Blackjack. Make sure you have enough money in your
                            Blackjack. If a player wins more money then what your Blackjack holds, you will <b>lose</b>
                            it!</p>

                        <div class="table-responsive">
                            <table class="table table-dark">
                                <tbody>
                                <tr>
                                    <td>
                                        Current max bet amount: <b>$50,000,000</b>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-inline">
                            <label>Max bet amount &nbsp;</label>
                            <input type="number" class="form-control" placeholder="" id="maxbet" name="maxbet">
                            <button type="submit" class="btn btn-default">Change</button>
                        </div>
                        <br>


                        <div class="table-responsive">
                            <table class="table table-dark">
                                <tbody>
                                <tr>
                                    <td>
                                        Current money in your Blackjack: <b>$100,325,523,555</b>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-inline">
                            <label>Deposit/withdraw money &nbsp;</label>
                            <input type="number" class="form-control" placeholder="" id="maxbet" name="maxbet" value="">
                            <button type="submit" class="btn btn-default">Deposit</button>&nbsp;
                            <button type="submit" class="btn btn-default">Withdraw</button>
                        </div>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-dark">
                                <tbody>
                                <tr>
                                    <td>
                                        Blackjack player count: <b>100</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Profit made: <i style="color: green;">$100,000,000</i>
                                    </td>
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
