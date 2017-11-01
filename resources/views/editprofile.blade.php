<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 31-10-2017
 * Time: 21:46
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-user"></i> {{$user->name}}'s profile | <a
                        class="text-dark" href="{{ url('/profile') }}"> Back
                </a></div>
            <div class="card-body">
                <img src="{!! url("/userimg/".$user->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <div class="text-center form-group">
                    <form enctype="multipart/form-data" action="" method="POST">
                        <input type="file" required name="avatar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
                <h4 class="text-center"><strong>Title</strong> {{$user->name}}</h4>

                <div class="form-group">
                    <label for="about_area"><h5>About me</h5></label>
                </div>
                {!! Form::open(['route' => ['profile.updateDesc'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                {{ Form::textarea('desc',''.$user->desc, ['class' => 'form-control', 'rows' => 6, 'style' => 'text-align:center']) }}
                <br>
                <button type="submit" class="btn btn-secondary">Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
