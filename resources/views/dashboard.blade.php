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
            <div class="card-header"><i class="fa fa-user i_button_background"></i> {{$user->name}}'s dashboard | <a
                        href="{{ url('/changepassword') }}" class="text-dark">Change password</a></div>
            <div class="row card-body">
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
                                    Position
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
                                <td><i class="fa fa-hourglass i_button_background"></i>
                                    XP
                                </td>
                                <td>
                                    {{number_format($user->xp)}}/100,000
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-rocket i_button_background"></i>
                                    Power
                                </td>
                                <td>
                                    {{number_format($user->power)}}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-diamond i_button_background"></i> VIP
                                </td>
                                <td>
                                    @if($user->vip == true)
                                        Yes @if($subscription != null)(until {{date("d-m-Y", $subscription->end)}})
                                    @endif

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
                                <td class="table_dark_bg" style="width: 50%;">Resources</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-area-chart i_button_background"></i>
                                    Stone
                                </td>
                                <td>
                                    {{number_format($user->stone)}}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-area-chart i_button_background"></i>
                                    Wood
                                </td>
                                <td>
                                    {{number_format($user->wood)}}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-area-chart i_button_background"></i>
                                    Oil
                                </td>
                                <td>
                                    {{number_format($user->oil)}}
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
                                <td class="table_dark_bg" style="width: 50%;">About</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-plane i_button_background"></i>
                                    Location
                                </td>
                                <td>
                                    {{$location->name}}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-calendar-check-o i_button_background"></i>
                                    Started
                                </td>
                                <td>
                                    {{$user->started}}
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
                                <td class="table_dark_bg" style="width: 50%;">Currency</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-money i_button_background"></i>
                                    Cash
                                </td>
                                <td>
                                    ${{number_format($user->cash)}}
                                </td>
                            </tr>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-cube i_button_background"></i>
                                    Prestige points
                                </td>
                                <td>
                                    {{number_format($user->prestigepoints)}}
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
                                <td class="table_dark_bg" style="width: 50%;">Betting</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-signal"></i>
                                    Highest bet:
                                </td>
                                <td>
                                    ${{number_format($user->highestbet)}}
                                </td>
                            </tr>
                            <tr>
                                <td><i style="color: #f39c12;" class="fa fa-signal"></i>
                                    Total bets</td>
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
                                <td class="table_dark_bg" style="width: 50%;">Company</td>
                                <td class="table_dark_bg" style="width: 50%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-building i_button_background"></i>
                                    Company
                                </td>
                                <td>
                                    {{$company}}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-building i_button_background"></i>
                                    Company rank
                                </td>
                                <td>
                                    Unknown
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
