<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 10-11-2017
 * Time: 16:53
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> {{$company->name}} | <a
                        class="text-dark" href="{{url("/companyprofile/".$company->name)}}">Back</a></div>
            <div class="card-body">
                <img src="{!! url("/companyimg/".$company->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <div class="text-center form-group">
                    <form enctype="multipart/form-data" action="" method="POST">
                        <input type="file" required name="avatar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
                <h4 class="text-center">{{$company->name}}</h4>

                <div class="form-group">
                    <label for="about_area"><h5>About me</h5></label>
                </div>
                {!! Form::open(['route' => ['company.updateDesc'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                {{ Form::textarea('desc',''.$company->desc, ['class' => 'form-control', 'rows' => 6, 'style' => 'text-align:center']) }}
                <br>
                <button type="submit" class="btn btn-secondary">Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

