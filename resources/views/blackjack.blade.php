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
                                        <img src="img/placeholder.png" width="100px" height="50px" class="img-thumbnail">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{Auth::user()->name}}
                                    </td>
                                    <td>
                                        <img src="img/placeholder.png" width="100px" height="50px" class="img-thumbnail">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-default">Take another card</button>
                            <button type="submit" class="btn btn-default">Stop playing</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
