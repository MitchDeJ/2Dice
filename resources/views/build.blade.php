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
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Build | <a class="text-dark" href="{{url("/expand")}}">Back</a>
            </div>
            <div class="card-body">
                <h5>Requirements</h5>
                <p @if($hascash == true) style="color:green" @else style="color:red" @endif>
                    @if($hascash == true) <strike> @endif
                        Building a new factory will cost you <b>${{number_format($cashreq)}}.</b>
                        @if($hascash == true) </strike> @endif
                </p>
                <p @if($haspower == true) style="color:green" @else style="color:red" @endif>
                    @if($haspower = true) <strike> @endif
                        Building a new factory requires a total of <b>{{number_format($powerreq)}} power.</b>
                        @if($haspower) </strike> @endif
                </p>
                <hr/>
                {!! Form::open(['route' => ['factory.build'], 'method' => 'post', 'class' => 'form-inline']) !!}
                {!! Form::select('type', $factories, null, ['class' => 'form-control']) !!}
                &nbsp;
                <button type="submit" class="btn btn-default">Build</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
