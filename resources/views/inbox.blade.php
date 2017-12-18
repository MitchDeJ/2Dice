<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 1-11-2017
 * Time: 18:09
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-envelope"></i> {{$user->name}}'s inbox
            </div>
            <div class="card-body">
                <div class="row col-md-12">
                    <div class="mail_button"><a href="{{ url('/newmessage') }}" class="text-dark">
                            <button type="button" class="btn btn-dark">New message</button>
                        </a></div>
                    <div class="mail_button"><a href="{{ url('/newglobalmessage') }}" class="text-dark">
                            <button type="button" class="btn btn-secondary">New global message</button>
                        </a></div>
                    <div class="mail_button"><a href="#" class="text-dark">
                            {!! Form::open(['route' => ['message.readall'], 'method' => 'post']) !!}
                            <button type="submit" class="btn btn-default">Mark all as read</button>
                            {!! Form::close() !!}
                        </a></div>
                    <div class="mail_button"><a href="#" class="text-dark">
                            {!! Form::open(['route' => ['message.deleteall'], 'method' => 'post']) !!}
                            <button type="submit" class="btn btn-danger">Delete all</button>
                            {!! Form::close() !!}
                        </a></div>
                </div>
                <hr/>


                <div class="table-responsive">
                    @if (count($newmessages)+count($oldmessages) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 10%;">Title</td>
                                <td class="table_dark_bg" style="width: 10%;">From</td>
                                <td class="table_dark_bg" style="width: 10%;">Received at</td>
                                <td class="table_dark_bg" style="width: 10%;">Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($newmessages as $m)
                                <tr>
                                    <td><a href="{{ url('/message/'.$m->id) }}" class="text-dark"><b>{{$m->title}}</b></a></td>
                                    <td><a href="profile/"{{$m->from}} class="text-dark"><b>{{$m->from}}</b></a></td>
                                    <td><b>{{$m->sentat}}</b></td>
                                    <td>
                                        {!! Form::open(['route' => ['message.delete'], 'method' => 'post']) !!}
                                        {!! Form::hidden("id",$m->id) !!}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($oldmessages as $m)
                                <tr>
                                    <td><a href="{{ url('/message/'.$m->id) }}" class="text-dark">{{$m->title}}</a></td>
                                    <td><a href="profile/" .{{$m->from}} class="text-dark">{{$m->from}}</a></td>
                                    <td>{{$m->sentat}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['message.delete'], 'method' => 'post']) !!}
                                        {!! Form::hidden("id",$m->id) !!}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <i>You currently do not have any messages to view.</i>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
