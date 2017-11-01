<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 1-11-2017
 * Time: 14:51
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-user i_button_background"></i> {{$user->name}}'s dashboard</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3" style="padding-bottom: 5px;"><a href="{{ url('/profile') }}" class="text-dark"><button type="button" class="btn btn-default">View profile</button></a></div>
                    <div class="col-md-3" style="padding-bottom: 5px;"><a href="{{ url('/profile') }}" class="text-dark"><button type="button" class="btn btn-default">View company</button></a></div>
                    <div class="col-md-3" style="padding-bottom: 5px;"><a href="{{ url('/inbox') }}" class="text-dark"><button type="button" class="btn btn-default">View messages</button></a></div>
                    <div class="col-md-3" style="padding-bottom: 5px;"><a href="{{ url('/profile') }}" class="text-dark"><button type="button" class="btn btn-default">Change password</button></a></div>
                </div> <hr />


                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>Status</td>
                            <td>Resources</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i class="fa fa-user i_button_background"></i> <strong>Leaderboard rank:</strong> #1</td>
                            <td><i class="fa fa-area-chart i_button_background"></i> <strong>Stone:</strong> 101.556.677</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-rocket i_button_background"></i> <strong>Power:</strong> {{number_format($user->power)}}</td>
                            <td><i class="fa fa-area-chart i_button_background"></i> <strong>Wood:</strong> 264.634.664</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-plane i_button_background"></i> <strong>Location:</strong> The Netherlands</td>
                            <td><i class="fa fa-area-chart i_button_background"></i> <strong>Wheat:</strong> 464.634.664</td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="table table-bordered table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>About</td>
                            <td>Money</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i class="fa fa-calendar-check-o i_button_background"></i> <strong>Started:</strong> 1-11-2017</td>
                            <td><i style="color: #f39c12;" class="fa fa-usd i_button_background"></i> <strong>Cash:</strong> ${{number_format($user->cash)}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-id-card i_button_background"></i> <strong>Titles unlocked:</strong> 9/11</td>
                            <td><i class="fa fa-bank i_button_background"></i> <strong>Total worth:</strong> $50,666,666</td>
                        </tr>
                        </tbody>
                    </table>

                    <br>
                    <table class="table table-bordered table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>Betting</td>
                            <td>Company</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i class="fa fa-signal i_button_background"></i> <strong>Bet stat:</strong> 1</td>
                            <td><i class="fa fa-building i_button_background"></i> <strong>Company:</strong> Ome Duo</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-signal i_button_background"></i> <strong>Bet stat:</strong> 1</td>
                            <td><i class="fa fa-building i_button_background"></i> <strong>Company rank:</strong> #3</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
