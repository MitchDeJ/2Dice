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

                            <input type="number" class="form-control" style="text-align: center" id="roulette"
                                   placeholder="Amount">

                            <button type="submit" class="btn btn-default" style="width: 100%;">Play</button>
                        </div>

                        <div class="col-md-2 logo_center">
                            <b>Black 8 to 14</b>
                            <img src="img/roulette_black.png" width="250px" height="250px" class="img-thumbnail">

                            <input type="number" class="form-control" style="text-align: center" id="roulette"
                                   placeholder="Amount">

                            <button type="submit" class="btn btn-default" style="width: 100%;">Play</button>
                        </div>

                        <div class="col-md-2 logo_center">
                            <b>Green 0</b>
                            <img src="img/roulette_green.png" width="250px" height="250px" class="img-thumbnail">

                            <input type="number" class="form-control" style="text-align: center" id="roulette"
                                   placeholder="Amount">

                            <button type="submit" class="btn btn-default" style="width: 100%;">Play</button>
                        </div>
                    </div>
                @else
                    <p>You are the owner of this Roulette. Make sure there's enough money in your
                        Roulette. If a player wins more money than what your Roulette holds, you will <b>lose</b>
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
                                    Current money in your Roulette: <b>${{number_format($object->cash)}}</b>
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
                                    Roulette player count: <b>100</b>
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
                @endif
            </div>
        </div>
@endsection
