<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 16:57
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Roulette</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 logo_center">
                        <b>Red 1 to 7</b>
                        <img src="img/roulette_red.png" width="250px" height="250px" class="img-thumbnail">

                        <input type="number" class="form-control" style="text-align: center" id="roulette" placeholder="Amount">

                        <button type="submit" class="btn btn-default" style="width: 100%;">Play</button>
                    </div>

                    <div class="col-md-2 logo_center">
                        <b>Black 8 to 14</b>
                        <img src="img/roulette_black.png" width="250px" height="250px" class="img-thumbnail">

                        <input type="number" class="form-control" style="text-align: center" id="roulette" placeholder="Amount">

                        <button type="submit" class="btn btn-default" style="width: 100%;">Play</button>
                    </div>

                    <div class="col-md-2 logo_center">
                        <b>Green 0</b>
                        <img src="img/roulette_green.png" width="250px" height="250px" class="img-thumbnail">

                        <input type="number" class="form-control" style="text-align: center" id="roulette" placeholder="Amount">

                        <button type="submit" class="btn btn-default" style="width: 100%;">Play</button>
                    </div>
                </div>

                <h5>Roulette {{$location->name}}</h5>
                <p>You are currently the owner of the Roulette. Make sure you have enough money in your
                    Roulette. If a player wins more money then what your Roulette holds, you will <b>lose</b>
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
                                Current money in your Roulette: <b>$100,325,523,555</b>
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
                                Roulette player count: <b>100</b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Profit made: <i style="color: red;">-$16,000,000</i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
