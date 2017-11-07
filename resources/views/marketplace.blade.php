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
                                            {{$itemnames->get($offer->item)}} - <b>${{number_format($offer->price)}}</b> each
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{number_format($offer->completed)}}/{{number_format($offer->amount)}} completed
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
                                            {!! Form::open(['route' => ['market.collect'], 'method' => 'post']) !!}
                                            <button type="submit" class="btn btn-dark form-group">Collect</button>
                                            {!! Form::hidden("id", $offer->id) !!}
                                            {!! Form::close() !!}
                                                &nbsp;
                                            {!! Form::open(['route' => ['market.cancel'], 'method' => 'post']) !!}
                                            <button type="submit" class="btn btn-dark form-group">Cancel</button>
                                            {!! Form::hidden("id", $offer->id) !!}
                                            {!! Form::close() !!}
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
