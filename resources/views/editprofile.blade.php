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
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-user"></i> {{$user->name}}'s profile | <a class="text-dark" href="{{ url('/profile') }}"> Cancel
                    </a></div>
            <div class="card-body">
                <img src="img/placeholder.png" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <div class="text-center form-group">
                    <label for="exampleInputFile">Upload avatar</label>
                    <input type="file" id="exampleInputFile">
                </div>
                <h4 class="text-center"><strong>Title</strong> {{$user->name}}</h4>

                <div class="form-group">
                    <label for="about_area"><h5>About me</h5></label>
                    <textarea class="form-control text-center" id="about_area" rows="3" >{{$user->desc}}</textarea>
                </div>

                <button type="button" class="btn btn-secondary">Save</button>
            </div>
        </div>
    </div>
@endsection
