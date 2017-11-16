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
            <div class="card-header"><i class="fa fa-envelope i_button_background"></i> {{$m->title}}</div>
            <div class="card-body">
                <div class="row col-md-12">
                    <div class="mail_button"><a href="{{ url('/inbox') }}" class="text-dark">
                            <button type="button" class="btn btn-default">Back to inbox</button>
                        </a></div>
                    <div class="mail_button"><a href="#" class="text-dark">
                            {!! Form::open(['route' => ['message.delete'], 'method' => 'post']) !!}
                            {!! Form::hidden("id",$m->id) !!}
                            <button type="submit" class="btn btn-danger">Delete</button>
                            {!! Form::close() !!}
                        </a></div>
                </div>
                <hr/>
                <div class="row col-md-12">
                    <p><strong>From:</strong> <a href="#" class="text-dark">{{$m->from}}</a></p>
                </div>
                <div class="row col-md-12">
                    <p><strong>Received at:</strong> {{$m->sentat}}</p>
                </div>
                <div class="row col-md-12">
                    <p>{{$m->text}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

