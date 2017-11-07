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
            <div class="card-header"><i class="fa fa-university i_button_background"></i> Marketplace</div>
            <div class="card-body">
                <a href="{{ url('/newoffer') }}">
                    <button type="submit" class="btn btn-dark">New offer</button>
                </a>
                <div class="row">
                    @foreach($offers as $offer)
                        <div class="col-md-4 logo_center">
                            <div class="table-responsive"><br>
                                <table class="table table-active">
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
                                            {{$itemnames->get($offer->item)}} - <b>${{$offer->price}}</b> each
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$offer->completed}}/{{$offer->amount}} completed
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/{{$locs->get($offer->location - 1)->flag}}"> {{$locs->get($offer->location - 1)->name}}
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
                                            {!! Form::open(['route' => ['market.collect'], 'method' => 'post']) !!}
                                            <button type="submit" class="btn btn-dark form-inline">Collect</button>
                                            {!! Form::hidden("id", $offer->id) !!}
                                            {!! Form::close() !!}
                                            {!! Form::open(['route' => ['market.cancel'], 'method' => 'post']) !!}
                                            <button type="submit" class="btn btn-dark form-inline">Cancel</button>
                                            {!! Form::hidden("id", $offer->id) !!}
                                            {!! Form::close() !!}
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
