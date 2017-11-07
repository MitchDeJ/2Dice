<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 6-11-2017
 * Time: 21:48
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-university i_button_background"></i> Marketplace</div>
            <div class="card-body">
                <div class="col-md-2">
                    <label for="type">Type</label>
                    {!! Form::open(['route' => ['market.newoffer'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden("creator", $user->id) !!}
                    {!! Form::hidden("creatortype", 0) !!}
                    {!! Form::hidden("location", $user->location) !!}
                    {!! Form::select('offertype', array(0 => 'Buy', 1 => 'Sell'), 0, ['class' => 'form-control form-group form-inline']) !!}
                </div>
                <div class="col-md-2">
                    <label for="item">Item</label>
                    {!! Form::select('item', array(0 => 'Wood', 1 => 'Stone', 2 => 'Wheat'), 0, ['class' => 'form-control form-group form-inline']) !!}
                </div>
                <div class="col-md-2 form-group form-inline">
                    <label for="amount">Amount &nbsp;</label>
                    {!! Form::number('amount', null, ['class'=>"form-control", 'id'=>"amount"]) !!}
                </div>
                <div class="col-md-2 form-group form-inline">
                    <label for="price">Price each &nbsp;</label>
                    {!! Form::number('price', null, ['class'=>"form-control", 'id'=>"price"]) !!}
                </div>
                <div class="col-md-2 form-group form-inline">
                    <label for="price">Total price &nbsp;</label>
                    {!! Form::text('totalprice', null, ['class'=>"form-control", 'disabled', 'id'=>"totalprice"]) !!}
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-default">Create offer</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
<!-- jquery script -->
    <script type="text/javascript">
        $('#price').keyup(calculate);
        $('#amount').keyup(calculate);
        function calculate(e) {
            var maths = $('#price').val() * $('#amount').val();
            $('#totalprice').val(numberWithCommas(maths));
        }
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection