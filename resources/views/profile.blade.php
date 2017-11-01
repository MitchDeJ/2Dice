<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 31-10-2017
 * Time: 21:46
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-user"></i> {{$user->name}}'s profile | <a class="text-dark" href="{{ url('/editprofile') }}"> Edit
                    profile</a></div>
            <div class="card-body">
                <img src="{!! url("/userimg/".$user->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <h4 class="text-center"><strong>Title</strong> {{$user->name}}</h4>

                <div class="form-group">
                    <label for="about_area"><h5>About me</h5></label>
                    <textarea class="form-control text-center" id="about_area" rows="6" disabled>{{$user->desc}}</textarea>
                </div>

                <label for="about_area"><h5>Player information</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-user"></i> <strong>Leaderboard rank:</strong> #1</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-user"></i> <strong>Power:</strong> {{ number_format($user->power) }}</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-home"></i> <strong>Company:</strong> Ome Duo</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-usd"></i> <strong>Cash:</strong> ${{number_format($user->cash)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <br> <label for="about_area"><h5>Betting information</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-user"></i> <strong>Bet stat:</strong> #1</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <br> <label for="about_area"><h5>Object information</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-globe"></i> <strong>Object(s):</strong> Blackjack Holland | Roulette Belgium
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
