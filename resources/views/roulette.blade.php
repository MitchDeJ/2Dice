<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 16:57
 */
?>
@extends('layouts.app')

@section('content')
    {{--Load all in button Javascript--}}
    <script>
        function allInButton() {
            document.getElementById("rouletteRed").value =
            @if ($user->cash > $object->maxbet) {{$object->maxbet}}
            @else {{$user->cash}}
            @endif
        }
        function allInButtonBlack() {
            document.getElementById("rouletteBlack").value =
            @if ($user->cash > $object->maxbet) {{$object->maxbet}}
            @else {{$user->cash}}
            @endif
        }
        function allInButtonGreen() {
            document.getElementById("rouletteGreen").value =
            @if ($user->cash > $object->maxbet) {{$object->maxbet}}
            @else {{$user->cash}}
            @endif
        }
    </script>

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Roulette {{$location->name}}</div>
            <div class="card-body">
                @if ($user->id != $object->owner)
                    @if ($owner == null)
                        <p>This object isn't owned by anyone at the moment.</p>
                    @else
                        <p>Owner of this object: <a
                                    href="{{url("/profile/".$owner->name)}}"
                                    @if($owner->vip == true)
                                    class="vip_yes"
                                    @else
                                    class="text-dark"
                                    @endif >{{$owner->name}}</a></p>
                    @endif
                    <p>Max bet: <b>${{number_format($object->maxbet)}}</b></p>
                    <div class="row">
                        <div class="col-md-2 logo_center">
                            <b>Red 1 to 7</b>
                            <img src="img/roulette_red.png" width="250px" height="250px" class="img-thumbnail">
                            {!! Form::open(['route' => ['roulette.spin'], 'method' => 'post']) !!}
                            <input type="number" class="form-control" style="text-align: center" id="rouletteRed"
                                   placeholder="Amount" name="red_amount">
                            <button type="button" herf="#"  onclick="allInButton()" class="btn btn-outline-success">ALL</button>
                        </div>

                        <div class="col-md-2 logo_center">
                            <b>Black 8 to 14</b>
                            <img src="img/roulette_black.png" width="250px" height="250px" class="img-thumbnail">

                            <input type="number" class="form-control" style="text-align: center" id="rouletteBlack"
                                   placeholder="Amount" name="black_amount">
                            <button type="button" herf="#"  onclick="allInButtonBlack()" class="btn btn-outline-success">ALL</button>
                        </div>

                        <div class="col-md-2 logo_center">
                            <b>Green 0</b>
                            <img src="img/roulette_green.png" width="250px" height="250px" class="img-thumbnail">

                            <input type="number" class="form-control" style="text-align: center" id="rouletteGreen"
                                   placeholder="Amount" name="green_amount">
                            <button type="button" herf="#"  onclick="allInButtonGreen()" class="btn btn-outline-success">ALL</button>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-default">Spin</button>
                    {!! Form::close() !!}
                @else
                    <p>You are the owner of this Roulette. Make sure there's enough money in your
                        Roulette. If a player wins more money than what your Roulette holds, you will <b>lose</b>
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
                        {!! Form::hidden("type", 0) !!}
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
                                    Current money in your Roulette: <b>${{number_format($object->cash)}}</b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-inline">
                        <label>Deposit/withdraw money &nbsp;</label>
                        {!! Form::open(['route' => ['object.bank'], 'method' => 'post']) !!}
                        {!! Form::hidden("type", 0) !!}
                        {!! Form::hidden("location", $location->id) !!}
                        <input type="number" class="form-control" placeholder="" id="maxbet" name="amount" value="">
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
                                        Profit: <i style="color: red;">-${{number_format($object->profit*-1)}}</i>
                                    @else
                                        Profit: <i style="color: green;">+${{number_format($object->profit)}}</i>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
