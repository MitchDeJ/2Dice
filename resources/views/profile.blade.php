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
                    <a class="text-dark" href="{{url("/newmessage/".$user->name)}}"> Send message</a></div>
            @endif
            <div class="card-body">
                <img src="{!! url("/userimg/".$user->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <h4 class="text-center"><strong style="color:{{Titles::getTitleColor($user->title)}}">
                        {{Titles::getTitle($user->title)}}</strong>{{$user->name}}</h4>

                <div class="form-group">
                    <br>
                    <textarea class="form-control text-center" id="about_area" rows="6"
                              disabled>{{$user->desc}}</textarea>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">Status</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i class="fa fa-trophy i_button_background"></i>
                                        Leaderboard position
                                    </td>
                                    <td>
                                        #{{$lbrank}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-star i_button_background"></i>
                                        Prestige
                                    </td>
                                    <td>
                                        {{$user->prestige}} (Rank {{$user->rank}})
                                    </td>
                                </tr>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-rocket"></i>
                                        Power
                                    </td>
                                    <td>
                                        {{ number_format($user->power) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-money i_button_background"></i>
                                        Cash
                                    </td>
                                    <td>
                                        ${{number_format($user->cash)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-diamond i_button_background"></i>
                                        VIP
                                    </td>
                                    <td>
                                        @if($user->vip == true)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">About</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-building"></i>
                                        Company
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark"> {{$user->company}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-building"></i>
                                        Company rank
                                    </td>
                                    <td>
                                        #1
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-plane i_button_background"></i>
                                        Location
                                    </td>
                                    <td>
                                        {{$location->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-calendar i_button_background"></i>
                                        Started
                                    </td>
                                    <td>
                                        {{$user->started}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-calendar-check-o i_button_background"></i>
                                        Last logged in
                                    </td>
                                    <td>
                                        {{$user->lastlogin}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <br>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">Betting</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-signal"></i>
                                        Highest bet
                                    </td>
                                    <td>
                                        ${{number_format($user->highestbet)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-signal"></i>
                                        Total bets
                                    </td>
                                    <td>
                                        {{number_format($user->totalbets)}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">Object</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-globe"></i>
                                        Object(s)
                                    </td>
                                    <td>
                                        {{$list}}
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
