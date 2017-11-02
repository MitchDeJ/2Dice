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
            @if ($user->name == Auth::user()->name)
                <div class="card-header"><i style="color: #f39c12;" class="fa fa-user"></i> {{$user->name}}'s profile |
                    <a class="text-dark" href="{{ url('/editprofile') }}"> Edit
                        profile</a></div>
            @else
                <div class="card-header"><i style="color: #f39c12;" class="fa fa-user"></i> {{$user->name}}'s profile |
                    <a class="text-dark" href="{{ url('/newmessage') }}"> Send Message</a></div>
            @endif
            <div class="card-body">
                <img src="{!! url("/userimg/".$user->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <h4 class="text-center"><strong>Title</strong> {{$user->name}}</h4>

                <div class="form-group">
                    <label for="about_area"><h5>About me</h5></label>
                    <textarea class="form-control text-center" id="about_area" rows="6"
                              disabled>{{$user->desc}}</textarea>
                </div>

                <label for="about_area"><h5>Status</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i class="fa fa-trophy i_button_background"></i> <strong>Leaderboard position:</strong> #{{$lbrank}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-star i_button_background"></i> <strong>Rank:</strong> {{$user->rank}} (Prestige {{$user->prestige}})</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-rocket"></i>
                                <strong>Power:</strong> {{ number_format($user->power) }}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-diamond i_button_background"></i> <strong>VIP:</strong>
                                @if($user->vip == true)
                                    Yes
                                @else
                                    No
                                @endif</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <br> <label for="about_area"><h5>Cash</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-usd i_button_background"></i> <strong>Cash:</strong> ${{number_format($user->cash)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <br> <label for="about_area"><h5>About</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-building"></i> <strong>Company:</strong> <a href="#" class="text-dark"> {{$user->company}}</a></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-plane i_button_background"></i> <strong>Location:</strong> {{$user->location}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar i_button_background"></i> <strong>Started:</strong> {{$user->started}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar-check-o i_button_background"></i> <strong>Last logged in:</strong> {{$user->lastlogin}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <br> <label for="about_area"><h5>Betting</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-signal"></i> <strong>Highest bet:</strong> ${{number_format($user->highestbet)}}</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-signal"></i> <strong>Total bets:</strong> {{$user->totalbets}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <br> <label for="about_area"><h5>Object</h5></label>

                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-globe"></i> <strong>Object(s):</strong>
                                Blackjack Holland | Roulette Belgium
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
