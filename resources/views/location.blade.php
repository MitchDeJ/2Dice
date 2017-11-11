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
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-plane"></i> Location</div>
            <div class="card-body">
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
                                    $1,000
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-default">Fly</button>
                {!! Form::close() !!}
                <hr />
                <p>You are currently the owner of this Airport.</p>
                <div class="table-responsive">
                    <table class="table table-dark">
                        <tbody>
                        <tr>
                            <td>
                                Current money in your Airport's bank: <b>$100,000</b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-inline">
                    <label>Withdraw money &nbsp;</label>
                    <input type="number" class="form-control" placeholder="" id="maxbet" name="maxbet" value="">
                    <select class="form-control form-group form-inline" id="type">
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
                                Profit: ja
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection