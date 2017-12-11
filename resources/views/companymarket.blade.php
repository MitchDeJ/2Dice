<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 18:34
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company dashboard >
                Marketplace | <a class="text-dark"
                                 href="{{url("/companydashboard")}}">Back</a></div>

        <div class="card-body">
            @if ($rights >= $options->makeoffers)
                <a href="{{ url('/newcompanyoffer') }}">
                    <button type="submit" class="btn btn-default">New offer</button>
                </a>
            @endif
            <div class="row">
                @foreach($offers as $offer)
                    <div class="col-md-4 logo_center">
                        <div class="table-responsive"><br>
                            <table class="table table-active" style="text-align: center;">
                                <thead>
                                <tr>
                                    @if ($offer->offertype == 0)
                                        <td class="table_dark_bg" style="width: 10%;">Buying</td>
                                    @elseif ($offer->offertype == 1)
                                        <td class="table_dark_bg" style="width: 10%;">Selling</td>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{$itemnames->get($offer->item)}} - <b>${{number_format($offer->price)}}</b>
                                        each
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{number_format($offer->completed)}}/{{number_format($offer->amount)}}
                                        completed
                                    </td>
                                </tr>
                                <tr>
                                    @if($offer->cancelled == true)
                                        <td class="table-danger">
                                            Cancelled
                                        </td>
                                    @elseif($offer->cancelled == false && $offer->completed >= $offer->amount)
                                        <td class="table-success">
                                            Offer completed
                                        </td>
                                    @elseif($offer->cancelled == false && $offer->completed < $offer->amount)
                                        <td class="table-info">
                                            Offer in progress
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row" style="margin: auto; justify-content: center">
                                            @if($rights >= $options->makeoffers)
                                                {!! Form::open(['route' => ['market.companycollect'], 'method' => 'post']) !!}
                                                <button type="submit" class="btn btn-dark form-group">Collect</button>
                                                {!! Form::hidden("id", $offer->id) !!}
                                                {!! Form::close() !!}
                                                &nbsp;
                                                {!! Form::open(['route' => ['market.cancel'], 'method' => 'post']) !!}
                                                <button type="submit" class="btn btn-dark form-group">Cancel</button>
                                                {!! Form::hidden("id", $offer->id) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection

