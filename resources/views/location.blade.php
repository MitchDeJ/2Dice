<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 16:24
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-plane"></i> Airport {{$location->name}}</div>
            <div class="card-body">
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
                <p>You can fly to another country every <strong>30 minutes</strong>. The country you are currently in is
                    marked in bold.</p>
                <p>As a VIP you can fly to another country every <strong>10 minutes</strong>.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 0.5%;">Option</td>
                            <td class="table_dark_bg" style="width: 10%;">Country</td>
                            <td class="table_dark_bg" style="width: 10%;">Cost</td>
                        </tr>
                        </thead>
                        <tbody>
                        {!! Form::open(['route' => ['location.fly'], 'method' => 'post', 'id' => 'selection']) !!}
                        @foreach($locations as $loc)
                            <tr>
                                <td>
                                    <label>
                                        @if ($user->location != $loc->id)
                                            {{ Form::radio('location'.$loc->id, $loc->name)}}
                                        @else
                                            {{ Form::radio('location'.$loc->id, $loc->name, false, ["disabled"])}}
                                        @endif
                                    </label>
                                </td>
                                <td>
                                    <img src="{{asset("img/".$loc->flag)}}">
                                    @if ($user->location != $loc->id) {{$loc->name}}
                                    @else
                                        <b>{{$loc->name}}</b>
                                    @endif
                                </td>
                                <td>
                                    $5,000
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-default">Fly</button>
                {!! Form::close() !!}
                @if ($user->id == $object->owner)
                    <hr/>
                    <p>You are the owner of this Airport.</p>
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <tbody>
                            <tr>
                                <td>
                                    Current money in your Airport's bank: <b>${{number_format($object->cash)}}</b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-inline">
                        <label>Withdraw money &nbsp;</label>
                        {!! Form::open(['route' => ['object.bank'], 'method' => 'post']) !!}
                        {!! Form::hidden("type", 2) !!}
                        {!! Form::hidden("location", $location->id) !!}
                        <input type="number" class="form-control" placeholder="" id="maxbet" name="amount" value="">
                        {!! Form::select('action', array("WITHDRAW" => 'Withdraw', "WITHDRAWALL" => 'Withdraw all'), 'Withdraw', ['class' => 'form-control form-group form-inline']) !!}
                        <button type="submit" class="btn btn-default">Transfer</button>
                        {!! Form::close() !!}
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-dark">
                            <tbody>
                            <tr>
                                <td>
                                    Profit: <i style="color: green;">+${{number_format($object->profit)}}</i>
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