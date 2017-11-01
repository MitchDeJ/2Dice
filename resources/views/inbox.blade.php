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
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-envelope"></i> {{$user->name}}'s inbox</div>
            <div class="card-body">
                <div class="row col-md-12">
                    <div class="mail_button"><a href="{{ url('/newmessage') }}" class="text-dark">
                            <button type="button" class="btn btn-secondary">New message</button>
                        </a></div>
                    <div class="mail_button"><a href="#" class="text-dark">
                            <button type="button" class="btn btn-default">Mark all as read</button>
                        </a></div>
                    <div class="mail_button"><a href="#" class="text-dark">
                            <button type="button" class="btn btn-danger">Delete all</button>
                        </a></div>
                </div>
                <hr/>


                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>Title</td>
                            <td>From</td>
                            <td>Received at</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="{{ url('/message') }}" class="text-dark">Snel kijken</a></td>
                            <td><a href="#" class="text-dark">Envy</a></td>
                            <td>1-11-2107</td>
                            <td><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
