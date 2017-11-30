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
                <br>
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
                <br>
                <b>Ban player</b>
                <br>
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
                <br>
                <b>Unban player</b>
                <br>
                {!! Form::open(['route' => ['admin.unban'], 'method' => 'post', 'class' => 'form-inline']) !!}
                <div class="form-group">
                    <label for="exampleInputName2">Username: &nbsp;</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="name">
                </div>
                <button type="submit" class="btn btn-success">Unban</button>
                {!! Form::close() !!}
                <br><br>
                {!! Form::open(['route' => ['admin.send'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <h6><b>Send system message</b></h6>
                {!! Form::select('action', array("SOLO" => 'Player', "ALL" => 'All Players'), "SOLO", ['class' => 'form-control form-group form-inline col-sm-1']) !!}
                <div class="row col-md-12">
                    <input type="text" class="form-control" placeholder="Username" value="" name="to">
                </div>
                <br>

                <div class="row col-md-12">
                    <h6>Title</h6>
                    <input type="text" class="form-control" placeholder="Title" name="title">
                </div>
                <br>

                <div class="row col-md-12">
                    <h6>Message</h6>
                    <textarea class="form-control" rows="3" placeholder="Message" name="text"></textarea>
                </div>
                <br>

                <div class="mail_button"><a href="{{ url('/inbox') }}" class="text-dark">
                        <button type="submit" class="btn btn-secondary">Send</button>
                    </a></div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection