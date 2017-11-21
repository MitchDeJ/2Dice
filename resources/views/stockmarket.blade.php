<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 4-11-2017
 * Time: 22:09
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Stock market</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Company</td>
                            <td class="table_dark_bg" style="width: 10%;">Price</td>
                            <td class="table_dark_bg" style="width: 10%;">Last change</td>
                            <td class="table_dark_bg" style="width: 10%;">Stock owned</td>
                            <td class="table_dark_bg" style="width: 10%;">Stock available</td>
                            <td class="table_dark_bg" style="width: 10%;">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stocks as $stock)
                        <tr>
                            <td>
                                {{$stock->name}}
                            </td>
                            <td>
                                ${{number_format($stock->price)}}
                            </td>
                            <td>
                                @if ($stock->price > $stock->lastprice)
                                <div style="color: green;">+${{number_format($stock->price-$stock->lastprice)}}</div>
                                    @elseif($stock->price == $stock->lastprice)
                                    <div style="color: royalblue;">+${{number_format($stock->price-$stock->lastprice)}}</div>
                                    @else
                                    <div style="color: red;">-${{number_format(($stock->price-$stock->lastprice)*-1)}}</div>
                                @endif
                            </td>
                            <td>
                                {{number_format($owned[$stock->id])}}
                            </td>
                            <td>
                               {{number_format($limit-($owned[$stock->id]))}}
                            </td>
                            <td>
                                {!! Form::open(['route' => ['stock.exchange'], 'method' => 'post']) !!}
                                    {!! Form::select('action', array("BUY" => 'Buy', "BUYALL" => 'Buy all',
                                     "SELL" => 'Sell', "SELLALL" => 'Sell all'), 'Buy') !!}

                                    <input name="stocknum" type="hidden" value={{$stock->id}}>
                                    <input class="form-control" placeholder="" name="amount" type="number">
                                    <button type="submit" class="btn btn-default">Exchange</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
