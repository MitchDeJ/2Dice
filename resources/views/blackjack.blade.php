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
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Blackjack {{$location->name}}</div>
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
                        <div class="form-group">
                            {!! Form::open(['route' => ['55x2.roll'], 'method' => 'post', 'class' => 'form-inline']) !!}
                            <input type="number" class="form-control" placeholder="Bet amount" id="bet" name="bet">
                            <div>
                                <button type="submit" class="btn btn-default">Gamble</button>
                            </div>
                            {!! Form::close() !!}
                        </div>


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
                                    <td>
                                        Blackjack dealer
                                    </td>
                                    <td>
                                        <img src="img/placeholder.png" width="100px" height="50px"
                                             class="img-thumbnail">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{Auth::user()->name}}
                                    </td>
                                    <td>
                                        <img src="img/placeholder.png" width="100px" height="50px"
                                             class="img-thumbnail">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-default">Take another card</button>
                            <button type="submit" class="btn btn-default">Stop playing</button>
                        </div><br>
                        @else
                        <p>You are the owner of this Blackjack. Make sure there's enough money in your
                            Blackjack. If a player wins more money than what your Blackjack holds, you will <b>lose</b>
                            it!</p>

                        <div class="table-responsive">
                            <table class="table table-dark">
                                <tbody>
                                <tr>
                                    <td>
                                        Current max bet amount: <b>${{number_format($object->maxbet)}}</b>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-inline">
                            <label>Max bet amount &nbsp;</label>
                            <input type="number" class="form-control" placeholder="" id="maxbet" name="maxbet">
                            <button type="submit" class="btn btn-default">Change</button>
                        </div>
                        <br>


                        <div class="table-responsive">
                            <table class="table table-dark">
                                <tbody>
                                <tr>
                                    <td>
                                        Current money in your Blackjack: <b>${{number_format($object->cash)}}</b>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-inline">
                            <label>Deposit/withdraw money &nbsp;</label>
                            <input type="number" class="form-control" placeholder="" id="maxbet" name="maxbet" value="">
                            <select class="form-control form-group form-inline" id="type">
                                <option>Deposit</option>
                                <option>Deposit all</option>
                                <option>Withdraw</option>
                                <option>Withdraw all</option>
                            </select>
                            <button type="submit" class="btn btn-default">Transfer</button>
                        </div>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-dark">
                                <tbody>
                                <tr>
                                    <td>
                                        Blackjack player count: <b>100</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if($object->profit < 0)
                                            Profit made: <i style="color: red;">-${{number_format($object->profit)}}</i>
                                        @else
                                            Profit made: <i style="color: green;">+${{number_format($object->profit)}}</i>
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
