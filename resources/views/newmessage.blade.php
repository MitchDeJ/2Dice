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
        <div class="card-header"><i class="fa fa-envelope i_button_background"></i> New message</div>
        <div class="card-body">
            <div class="row col-md-12">
                <div class="mail_button"><a href="{{ url('/inbox') }}" class="text-dark">
                        <button type="button" class="btn btn-default">Back to inbox</button>
                    </a></div>
            </div>
            <hr/>

            <div class="row col-md-12">
                <h6>Send to</h6>
                <input type="text" class="form-control" placeholder="Username">
            </div>
            <br>

            <div class="row col-md-12">
                <h6>Title</h6>
                <input type="text" class="form-control" placeholder="Title name">
            </div>
            <br>

            <div class="row col-md-12">
                <h6>Title</h6>
                <textarea class="form-control" rows="3" placeholder="Message"></textarea>
            </div>
            <br>

            <div class="mail_button"><a href="{{ url('/inbox') }}" class="text-dark">
                    <button type="button" class="btn btn-secondary">Send</button>
                </a></div>
        </div>
    </div>
</div>
@endsection

