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
                    <p>Your company will be located in <img src="{{asset("img/".$location->flag)}}"> <b>{{$location->name}}</b>. (Your current location)</p>
                    <div class="form-inline">
                        <label>Company name &nbsp;</label>
                        {!! Form::open(['route' => ['company.create'], 'method' => 'post']) !!}
                        <input type="text" class="form-control" placeholder="" id="companyCreate" name="name">
                        <button type="submit" class="btn btn-default">Create</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
