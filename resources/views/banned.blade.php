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
                <b>You are banned.</b>
                <hr/>
                Reason: {{$ban->reason}}
            </div>
        </div>
    </div>
    </div>
@endsection