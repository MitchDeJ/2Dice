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
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Admin Panel</div>
            <div class="card-body">
                <b>Gib Vip</b>
                <hr/>
                {!! Form::open(['route' => ['admin.addvip'], 'method' => 'post', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    <label for="exampleInputName2">Username: &nbsp;</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="name">
                </div>
                &nbsp;
                <div class="form-group">
                    <label for="exampleInputEmail2">Days: &nbsp;</label>
                    <input type="number" class="form-control" id="exampleInputEmail2" placeholder=""
                           name="days">
                </div>
                <button type="submit" class="btn btn-default">Add vip</button>
                {!! Form::close() !!}
                <hr/>
                <b>Ban player</b>
                <hr/>
                {!! Form::open(['route' => ['admin.ban'], 'method' => 'post', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    <label for="exampleInputName2">Username: &nbsp;</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="name">
                </div>
                &nbsp;
                <div class="form-group">
                    <label for="exampleInputEmail2">Reason: &nbsp;</label>
                    <input type="text" class="form-control" id="exampleInputEmail2" placeholder=""
                           name="reason">
                </div>
                <button type="submit" class="btn btn-danger">B A N</button>
                {!! Form::close() !!}
                <hr/>
                <b>Unban player</b>
                <hr/>
                {!! Form::open(['route' => ['admin.unban'], 'method' => 'post', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    <label for="exampleInputName2">Username: &nbsp;</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="name">
                </div>
                <button type="submit" class="btn btn-success">Unban</button>
                {!! Form::close() !!}
                <hr/>
            </div>
            </div>
        </div>
    </div>
@endsection