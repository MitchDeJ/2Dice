<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 23:54
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> 55x2 {{$location->name}}</div>
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
                            {!! Form::open(['route' => ['55x2.roll'], 'method' => 'post', 'class' => 'form-inline']) !!}
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Bet amount" id="bet" name="bet">
                                <div>
                                    <button type="submit" class="btn btn-default">Roll</button>

                                    <button type="button" herf="#"  onclick="allInButton()" class="btn btn-outline-success">ALL</button>

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p>You are the owner of this 55x2. Make sure there's enough money in your
                        55x2. If a player wins more money than what your 55x2's bank holds, you will <b>lose</b>
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
                        {!! Form::hidden("type", 3) !!}
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
                                    Current money in your 55x2: <b>${{number_format($object->cash)}}</b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-inline">
                        <label>Deposit/withdraw money &nbsp;</label>
                        {!! Form::open(['route' => ['object.bank'], 'method' => 'post']) !!}
                        {!! Form::hidden("type", 3) !!}
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
            </div>
                @endif
            </div>
        </div>
    </div>
@endsection
{{--Load all in button Javascript--}}
<script>
    function allInButton() {
        document.getElementById("bet").value =
        @if ($user->cash > $object->maxbet) {{$object->maxbet}}
        @else {{$user->cash}}
        @endif
    }
</script>
