<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 18:20
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-shopping-bag i_button_background"></i> General store</div>
            <div class="card-body">
                    <p>The general store will only sell it's items for money. Click <a href="{{ url('/prestige') }}" class="text-dark"><b>here</b></a> to go to the prestige shop.</p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 10%;">Product</td>
                                <td class="table_dark_bg" style="width: 10%;">Cost</td>
                                <td class="table_dark_bg" style="width: 10%;">Amount</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    1 Power
                                </td>
                                <td>
                                    $100 Cash
                                </td>
                                <td>
                                    <div class="form-inline">
                                        {!! Form::open(['route' => ['shop.buypower'], 'method' => 'post']) !!}
                                        <input type="number" class="form-control" placeholder="Amount" id="power" name="amount">
                                        <button type="submit" class="btn btn-default">Buy</button>
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
