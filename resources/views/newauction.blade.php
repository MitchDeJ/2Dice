<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 11-11-2017
 * Time: 00:45
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-university i_button_background"></i> New auction</div>
            <div class="card-body">
                <div class="col-md-2 form-group form-inline">
                    <label for="type">Object type &nbsp;</label>
                    {!! Form::open(['route' => ['auction.add'], 'method' => 'post']) !!}
                    {!! Form::select('object', $optionlist, null, ['class' => 'form-group, form-control']) !!}
                </div>

                <div class="col-md-2 form-group form-inline">
                    <label for="price">Minimum price &nbsp;</label>
                    <input type="number" class="form-control" placeholder="Amount" id="price" name="minprice">
                </div>

                <div class="col-md-2 form-group form-inline">
                    <label for="time">Time (hours) &nbsp;</label>
                    <input type="number" class="form-control" placeholder="Hours" id="time" name="time">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-default">Create auction</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
