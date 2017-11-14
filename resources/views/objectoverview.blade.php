<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 12-11-2017
 * Time: 19:24
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-globe i_button_background"></i> Objects</div>
            <div class="card-body">
                <p>Objects are owned by players. You can overtake an object by winning an amount, that the object bank
                    does not hold.</p>
                <p>Because the object isn't able to pay you, you will be the new owner of that object.</p>
                <p>You can also buy an object from players, if they put it up for <a href="{{ url('/marketplace') }}">auction</a>.
                </p>
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;"><img src="img/netherlands.png">
                                        Netherlands
                                    </td>
                                    <td class="table_dark_bg" style="width: 10%;">Owner</td>
                                    <td class="table_dark_bg" style="width: 10%;">Maximum bet</td>
                                    <td class="table_dark_bg" style="width: 10%;">Profit</td>
                                </tr>
                                </thead>
                                <tbody>
                                @for ($i = 0; $i < 4; $i++)
                                    <tr>
                                        <td>{{$objectTypes[$objects[$i]->type]}}</td>
                                        @if (!$users[$i] == null)
                                            <td><a href="{{url("/profile/".$users[$i]->name)}}"
                                                   class="text-dark">{{$users[$i]->name}}</a></td>
                                        @else
                                            <td><a href="#" class="text-dark"></a></td>
                                        @endif
                                        <td><a href="#" class="text-dark">${{number_format($objects[$i]->maxbet)}}</a>
                                        </td>
                                        @if($objects[$i]->profit < 0)
                                            <td style="color: red;">-${{$objects[$i]->profit}}</td>
                                        @else
                                            <td style="color: green;">+${{$objects[$i]->profit}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;"><img src="img/uk.png"> United Kingdom
                                    </td>
                                    <td class="table_dark_bg" style="width: 10%;">Owner</td>
                                    <td class="table_dark_bg" style="width: 10%;">Max bet</td>
                                    <td class="table_dark_bg" style="width: 10%;">Profit</td>
                                </tr>
                                </thead>
                                <tbody>
                                @for ($i = 4; $i < 8; $i++)
                                    <tr>
                                        <td>{{$objectTypes[$objects[$i]->type]}}</td>
                                        @if (!$users[$i] == null)
                                            <td><a href="{{url("/profile/".$users[$i]->name)}}"
                                                   class="text-dark">{{$users[$i]->name}}</a></td>
                                        @else
                                            <td><a href="#" class="text-dark"></a></td>
                                        @endif
                                        <td><a href="#" class="text-dark">${{number_format($objects[$i]->maxbet)}}</a>
                                        </td>
                                        @if($objects[$i]->profit < 0)
                                            <td style="color: red;">-${{$objects[$i]->profit}}</td>
                                        @else
                                            <td style="color: green;">+${{$objects[$i]->profit}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;"><img src="img/russia.png"> Russia</td>
                                    <td class="table_dark_bg" style="width: 10%;">Owner</td>
                                    <td class="table_dark_bg" style="width: 10%;">Max bet</td>
                                    <td class="table_dark_bg" style="width: 10%;">Profit</td>
                                </tr>
                                </thead>
                                <tbody>
                                @for ($i = 8; $i < 12; $i++)
                                    <tr>
                                        <td>{{$objectTypes[$objects[$i]->type]}}</td>
                                        @if (!$users[$i] == null)
                                            <td><a href="{{url("/profile/".$users[$i]->name)}}"
                                                   class="text-dark">{{$users[$i]->name}}</a></td>
                                        @else
                                            <td><a href="#" class="text-dark"></a></td>
                                        @endif
                                        <td><a href="#" class="text-dark">${{number_format($objects[$i]->maxbet)}}</a>
                                        </td>
                                        @if($objects[$i]->profit < 0)
                                            <td style="color: red;">-${{$objects[$i]->profit}}</td>
                                        @else
                                            <td style="color: green;">+${{$objects[$i]->profit}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

