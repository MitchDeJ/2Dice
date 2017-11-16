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
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Blackjack {{$location->name}}
            </div>
            <div class="card-body">
                @if ($user->id != $object->owner)
                    @if ($owner == null)
                        <p>This object isn't owned by anyone at the moment.</p>
                    @else
                        <p>Owner of this object: <a href="{{url("/profile/".$owner->name)}}"
                                                    @if($owner->vip == true)
                                                    class="vip_yes"
                                                    @else
                                                    class="text-dark"
                                    @endif >{{$owner->name}}</a></p>
                    @endif
                    <p>Max bet: <b>${{number_format($object->maxbet)}}</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($state == "NEW")
                                <div class="form-group">
                                    {!! Form::open(['route' => ['blackjack.start'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                    <input type="number" class="form-control" placeholder="Bet amount" id="bet"
                                           name="bet">
                                    {!! Form::hidden("location", $location->id) !!}
                                    <div>
                                        <button type="submit" class="btn btn-default">Gamble</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            @else
                                @if($state == "ONGOING")
                                    <p>Your bet: <b>${{number_format($bet)}}</b></p>
                                    @elseif ($state == "DRAW")
                                    <p style="color:royalblue">It's a draw! <b>${{number_format($bet)}}</b> has been returned.</p>
                                @elseif ($state == "LOSE")
                                    <p style="color:red">Dealer wins! You lose <b>${{number_format($bet)}}</b>.</p>
                                @elseif ($state == "WIN")
                                    <p style="color:green">{{$user->name}} wins! You win <b>${{number_format($bet)}}</b>.</p>
                                @elseif ($state == "WIN_BLACKJACK")
                                    <p style="color:green">{{$user->name}} wins (instant blackjack)! You win <b>${{number_format($bet*1.5)}}</b>.</p>
                                @endif
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
                                            <td
                                            @if($state == "WIN" || $state == "WIN_BLACKJACK")
                                                style="color:red;"
                                            @elseif($state == "LOSE")
                                                style="color:green"
                                            @elseif($state == "DRAW")
                                                style="color:royalblue;"
                                            @endif
                                            >
                                                Dealer ({{$cputotal}})
                                            </td>
                                            <td>
                                                @for($i = 0; $i < $turncount; $i++)
                                                    @if ($i == $hidecard && $state == "ONGOING")
                                                        <img src="img/cards/cardBack.png">
                                                        @else
                                                <img src="{{$cpucards[$i]}}">
                                                    @endif
                                                    @endfor
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                    @if($state == "WIN" || $state == "WIN_BLACKJACK")
                                                    style="color:green;"
                                                    @elseif($state == "LOSE")
                                                    style="color:red"
                                                    @elseif($state == "DRAW")
                                                    style="color:royalblue;"
                                                    @endif
                                            >
                                                {{Auth::user()->name}} ({{$usertotal}})
                                            </td>
                                            <td>
                                                @for($i = 0; $i < $turncount; $i++)
                                                <img src="{{$usercards[$i]}}">
                                                @endfor
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @if($state == "ONGOING")
                                        {!! Form::open(['route' => ['blackjack.hit'], 'method' => 'post']) !!}
                                        {!! Form::hidden("location", $location->id) !!}
                                    <button type="submit" class="btn btn-default">Hit!</button>
                                    {!! Form::close() !!}
                                        {!! Form::open(['route' => ['blackjack.stand'], 'method' => 'post']) !!}
                                        {!! Form::hidden("location", $location->id) !!}
                                    <button type="submit" class="btn btn-default">Stand</button>
                                        {!! Form::close() !!}
                                        @else
                                        {!! Form::open(['route' => ['blackjack.reset'], 'method' => 'post']) !!}
                                        {!! Form::hidden("location", $location->id) !!}
                                        <button type="submit" class="btn btn-default">Reset</button>
                                        {!! Form::close() !!}
                                        @endif
                                </div><br>
                            @endif
                            @else
                                <p>You are the owner of this Blackjack. Make sure there's enough money in your
                                    Blackjack. If a player wins more money than what your Blackjack holds, you will <b>lose</b>
                                    it!</p>

                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <tbody>
                                        <tr>
                                            <td>
                                                Current maximum bet: <b>${{number_format($object->maxbet)}}</b>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-inline">
                                    <label>Maximum bet amount &nbsp;</label>
                                    {!! Form::open(['route' => ['object.maxbet'], 'method' => 'post']) !!}
                                    {!! Form::hidden("type", 1) !!}
                                    {!! Form::hidden("location", $location->id) !!}
                                    <input type="number" class="form-control" placeholder="" id="maxbet" name="amount">
                                    <button type="submit" class="btn btn-default">Change</button>
                                    {!! Form::close() !!}
                                </div>
                                <br>


                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <tbody>
                                        <tr>
                                            <td>
                                                Current money in your Blackjack:
                                                <b>${{number_format($object->cash)}}</b>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-inline">
                                    <label>Deposit/withdraw money &nbsp;</label>
                                    {!! Form::open(['route' => ['object.bank'], 'method' => 'post']) !!}
                                    {!! Form::hidden("type", 1) !!}
                                    {!! Form::hidden("location", $location->id) !!}
                                    <input type="number" class="form-control" placeholder="" id="maxbet" name="amount"
                                           value="">
                                    {!! Form::select('action', array("DEPOSIT" => 'Deposit', "DEPOSITALL" => 'Deposit all',
                                     "WITHDRAW" => 'Withdraw', "WITHDRAWALL" => 'Withdraw all'), 'Deposit', ['class' => 'form-control form-group form-inline']) !!}
                                    <button type="submit" class="btn btn-default">Transfer</button>
                                    {!! Form::close() !!}
                                </div>
                                <br>

                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <tbody>
                                        <tr>
                                            <td>
                                                @if($object->profit < 0)
                                                    Profit: <i
                                                            style="color: red;">-${{number_format($object->profit*-1)}}</i>
                                                @else
                                                    Profit: <i
                                                            style="color: green;">+${{number_format($object->profit)}}</i>
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
@endsection
