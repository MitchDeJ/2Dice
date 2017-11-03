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
            </div>
        </div>
    </div>
@endsection
