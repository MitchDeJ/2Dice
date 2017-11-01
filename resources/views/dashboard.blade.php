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
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-user"></i> {{$user->name}}'s dashboard</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><a href="{{ url('/profile') }}" class="text-dark">View profile</a></div>
                    <div class="col-md-3"><a href="{{ url('/profile') }}" class="text-dark">View company</a></div>
                    <div class="col-md-3"><a href="{{ url('/profile') }}" class="text-dark">Account settings</a></div>
                    <div class="col-md-3"><a href="{{ url('/profile') }}" class="text-dark">Change password</a></div>
                </div> <hr />


                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>Status</td>
                            <td>Statistics</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-user"></i> <strong>Leaderboard rank:</strong> #1</td>
                            <td><i style="color: #f39c12;" class="fa fa-industry"></i> <strong>Stone:</strong> 101.556.677</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-user"></i> <strong>Power:</strong> {{number_format($user->power)}}</td>
                            <td><i style="color: #f39c12;" class="fa fa-industry"></i> <strong>Wood:</strong> 264.634.664</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-plane"></i> <strong>Location:</strong> The Netherlands</td>
                            <td><i style="color: #f39c12;" class="fa fa-industry"></i> <strong>Wheat:</strong> 464.634.664</td>
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
                            <td><i style="color: #f39c12;" class="fa fa-calendar-check-o"></i> <strong>Started:</strong> 1-11-2017</td>
                            <td><i style="color: #f39c12;" class="fa fa-usd"></i> <strong>Cash:</strong> {{number_format($user->cash)}}</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-id-card"></i> <strong>Titles unlocked:</strong> 9/11</td>
                            <td><i style="color: #f39c12;" class="fa fa-bank"></i> <strong>????:</strong> ??????????</td>
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
                            <td><i style="color: #f39c12;" class="fa fa-calendar-check-o"></i> <strong>Started:</strong> 1-11-2017</td>
                            <td><i style="color: #f39c12;" class="fa fa-usd"></i> <strong>Cash:</strong> $101.556.677</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-id-card"></i> <strong>Titles unlocked:</strong> 9/11</td>
                            <td><i style="color: #f39c12;" class="fa fa-bank"></i> <strong>Bank:</strong> $64.634.664.666</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
