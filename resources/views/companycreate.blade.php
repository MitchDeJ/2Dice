<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 10-11-2017
 * Time: 16:19
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div id="fail" class="alert alert-info" align="center">
            <strong>Creating or joining a company is recommended. If you decide not to create or join a company,
                you'll miss out on a big part of the game.</strong>
        </div>
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company create</div>
            <div class="card-body">
                <p>Creating a company costs <b>$500,000</b>. Joining one is free. </p>
                <p>Your company will be located in <img src="{{asset("img/".$location->flag)}}">
                    <b>{{$location->name}}</b>. (Your current location)</p>
                <p>Your first factory will be built instantly when you create your company. At first you can only choose a
                    gathering factory, later on you will be able to build
                    other types of factories.</p>

                <div class="form-check-inline">
                    <label>Company name</label>
                    {!! Form::open(['route' => ['company.create'], 'method' => 'post'], ['class' => 'form-control']) !!}
                    <input type="text" class="form-control" placeholder="" id="companyCreate" name="name">
                </div>
                <div class="form-check-inline">
                    <label>Factory type</label>
                    {!! Form::select('type', $factories, null, ['class' => 'form-control form-inline']) !!}
                </div>
                <button type="submit" class="btn btn-default">Create</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
