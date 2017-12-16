<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 10-11-2017
 * Time: 16:19
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> {{$typename}} | <a class="text-dark" href="{{url("/expand")}}">Back</a>
            </div>
            <div class="card-body">
                <h5>Efficiency</h5>
                <p>This {{strtolower($typename)}} {{$action}} <b>{{number_format($units)}} {{strtolower($result)}} per hour.</b></p>
                <hr/>
                <h5>Upgrade requirements (level {{$factory->level}} -> level {{$factory->level+1}})</h5>
                <p @if($hascash == true) style="color:green" @else style="color:red" @endif>
                    @if($hascash == true) <strike> @endif
                        Upgrading this {{strtolower($typename)}} will cost you <b>${{number_format($cashreq)}}.</b>
                        @if($hascash == true) </strike> @endif
                </p>
                <p @if($hasresources == true) style="color:green" @else style="color:red" @endif>
                    @if($hasresources == true) <strike> @endif
                        Upgrading this {{strtolower($typename)}} requires a total of <b>{{number_format($resourcereq)}} {{strtolower($resource)}}.</b>
                        @if($hasresources == true) </strike> @endif
                </p>
                {!! Form::open(['route' => ['factory.upgrade'], 'method' => 'post', 'class' => 'form-inline']) !!}
                {!! Form::hidden("fid", $factory->id) !!}
                <button type="submit" class="btn btn-default">Upgrade</button>
                {!! Form::close() !!}
                <hr/>
                <h5>Remove</h5>
                <p>If you would like to remove this factory, you can use the button below to do so. <b>Removing this factory will make the company lose all the levels it has gained from this factory!</b></p>
                {!! Form::open(['route' => ['factory.remove'], 'method' => 'post']) !!}
                {!! Form::hidden("fid", $factory->id) !!}
                {!! Form::checkbox("confirm") !!} I hereby confirm that I will knowingly remove this factory and will lose all of it's progress by pressing 'Remove'.
                <br>
                <br>
                <button type="submit" class="btn btn-danger">Remove</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
