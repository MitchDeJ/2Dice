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
            <div class="card-header"><i class="fa fa-user i_button_background"></i> {{$user->name}}'s dashboard | <a href="{{ url('/changepassword') }}" class="text-dark">Change password</a></div>
            <div class="row card-body">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 10%;">Status</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-trophy i_button_background"></i> Leaderboard position: #{{$lbrank}}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-star i_button_background"></i> Rank: {{$user->rank}} (Prestige {{$user->prestige}})
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-rocket i_button_background"></i>
                                    Power: {{number_format($user->power)}}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-diamond i_button_background"></i> VIP:
                                    @if($user->vip == true)
                                        Yes @if($subscription != null)(until {{date("d-m-Y", $subscription->end)}}
                                        ) @endif
                                    @else
                                        No
                                    @endif
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
                                <td class="table_dark_bg" style="width: 10%;">Resources</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-area-chart i_button_background"></i>
                                    Stone: {{number_format($user->stone)}}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-area-chart i_button_background"></i>
                                    Wood: {{number_format($user->wood)}}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-area-chart i_button_background"></i>
                                    Wheat: {{number_format($user->wheat)}}</td>
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
                                <td class="table_dark_bg" style="width: 10%;">About</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-plane i_button_background"></i> Location: {{$location->name}}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-calendar-check-o i_button_background"></i>
                                    Started: {{$user->started}}</td>
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
                                <td class="table_dark_bg" style="width: 10%;">Currency</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-usd i_button_background"></i> Cash:
                                    ${{number_format($user->cash)}}</td>
                            </tr>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-cube i_button_background"></i> Prestige
                                    points: {{number_format($user->prestigepoints)}}</td>
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
                                <td class="table_dark_bg" style="width: 10%;">Betting</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-signal"></i> Highest bet:
                                    ${{number_format($user->highestbet)}}</td>
                            </tr>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-signal"></i> Total
                                    bets: {{$user->totalbets}}</td>
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
                                <td class="table_dark_bg" style="width: 10%;">Company</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-building i_button_background"></i> Company: {{$user->company}}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-building i_button_background"></i> Company rank: ?</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
