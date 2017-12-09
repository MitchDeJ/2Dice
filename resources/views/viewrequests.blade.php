<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 00:01
 */
?>
@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company dashboard > Join
                requests | <a class="text-dark"
                              href="{{url("/companydashboard")}}">Back</a></div>
            <div class="card-body">
                @if (count($requests) == 0)
                    <br>
                    <p>There are currently no pending join requests.</p>
                @else
                    <div class="table-responsive"><br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 30%;">Player</td>
                                <td class="table_dark_bg" style="width: 70%;">Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $req)
                                <tr>
                                    <td>
                                        <a class="text-dark"
                                           href="{{url("/profile/".$users[$req->id]->name)}}"> {{$users[$req->id]->name}}</a>
                                    </td>
                                    <td>
                                        <div class="form-inline">
                                        {!! Form::open(['route' => ['request.accept'], 'method' => 'post']) !!}
                                        {!! Form::hidden("id", $req->id) !!}
                                        <button type="submit" class="btn btn-success">Accept</button>&nbsp;
                                        {!! Form::close() !!}
                                        {!! Form::open(['route' => ['request.decline'], 'method' => 'post']) !!}
                                        {!! Form::hidden("id", $req->id) !!}
                                        <button type="submit" class="btn btn-danger">Decline</button>
                                        {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection