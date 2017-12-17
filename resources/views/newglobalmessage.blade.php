<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 25-11-2017
 * Time: 19:43
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-envelope i_button_background"></i> New global message</div>
            <div class="card-body">
                <div class="row col-md-12">
                    <div class="mail_button"><a href="{{ url('/inbox') }}" class="text-dark">
                            <button type="button" class="btn btn-default">Back to inbox</button>
                        </a></div>
                </div> <br>
                <p>You currently have {{number_format($user->globalmsg)}} global message points.</p>
                <p>This message will be sent to every user and will cost you 1 global message point. You can buy points at the <a href="{{ url('/prestige') }}" class="text-dark">prestige shop</a>.</p>
                <hr/>
                {!! Form::open(['route' => ['message.sendglobal'], 'method' => 'post', 'class' => 'form-horizontal'], 'required') !!}
                <div class="row col-md-12">
                    <h6>Title</h6>
                    <input type="text" class="form-control" placeholder="Title" name="title" required>
                </div>
                <br>

                <div class="row col-md-12">
                    <h6>Message</h6>
                    <textarea class="form-control" rows="3" placeholder="Message" name="text" required></textarea>
                </div>
                <br>

                <div class="mail_button">
                        <button type="submit" class="btn btn-secondary">Send</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

