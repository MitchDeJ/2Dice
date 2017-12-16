<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 18:31
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-area-chart i_button_background"></i> Statistics</div>
            <div class="row card-body">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 50%;">Top richest players</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($toprichest as $user)
                                <tr>
                                    <td><a href="{{url("/profile/".$user->name)}}" class="text-dark">{{$user->name}}</a>
                                    </td>
                                    <td>${{number_format($user->cash)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 50%;">Top ranked players</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topranked as $user)
                                <tr>
                                    <td><a href="{{url("/profile/".$user->name)}}" class="text-dark">{{$user->name}}</a>
                                    </td>
                                    <td>Prestige {{$user->prestige}} (Rank {{$user->rank}})</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 50%;">Top highest bets</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topbets as $user)
                                <tr>
                                    <td><a href="{{url("/profile/".$user->name)}}" class="text-dark">{{$user->name}}</a>
                                    </td>
                                    <td>${{number_format($user->highestbet)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 50%;">Top total bets</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($toptotalbets as $user)
                                <tr>
                                    <td><a href="{{url("/profile/".$user->name)}}" class="text-dark">{{$user->name}}</a>
                                    </td>
                                    <td>{{number_format($user->totalbets)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
