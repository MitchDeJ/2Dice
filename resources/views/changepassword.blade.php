<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 1-11-2017
 * Time: 20:33
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-lock i_button_background"></i> Change password</div>
            <div class="card-body">
                <div class="row col-md-12">
                    <div class="mail_button"><a href="{{ url('/dashboard') }}" class="text-dark">
                            <button type="button" class="btn btn-default">Back to dashboard</button>
                        </a></div>
                </div>
                <hr/>
                {!! Form::open(['route' => ['changepass'], 'method' => 'post']) !!}
                <div class="row col-md-12">
                    <h6>Current password</h6>
                    <input name="old" type="password" class="form-control" placeholder="Current password">
                </div>
                <br>

                <div class="row col-md-12">
                    <h6>New password</h6>
                    <input name="new" type="password" class="form-control" placeholder="New password">
                </div>
                <br>

                <div class="row col-md-12">
                    <h6>Confirm new password</h6>
                    <input name="newconfirm" type="password" class="form-control" placeholder="Confirm new password">
                </div>
                <br>
                <button type="submit" class="btn btn-secondary">Change password</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection