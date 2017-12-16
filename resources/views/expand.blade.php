<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 17-11-2017
 * Time: 19:26
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company dashboard >
                Expand | <a class="text-dark"
                            href="{{url("/companydashboard")}}">Back</a></div>
            <div class="card-body">
                <div>
                    <a href="{{url('build')}}">
                    <button type="submit" class="btn btn-success">Build</button>
                    </a>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 33%;">Factory</td>
                                <td class="table_dark_bg" style="width: 33%;">Level</td>
                                <td class="table_dark_bg" style="width: 33%;">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($factories as $factory)
                        <tr>
                            <td>{{$names[$factory->type]}}</td>
                            <td>{{$factory->level}}</td>
                            <td><a href="{{url('factory/'.$factory->id)}}"><button type="submit" class="btn btn-info">View</button></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr/>
                    <b>Buy storage</b>
                    <br>
                    <p>Buying 1 storage unit costs $250 and will grant you one extra storage for every resource in the
                        company's warehouse.</p>
                    {!! Form::open(['route' => ['company.buystorage'], 'method' => 'post', 'class' => 'form-inline']) !!}
                    <input type="number" class="form-control" placeholder="Amount" id="samount"
                           name="amount">
                    &nbsp; &nbsp;
                    {!! Form::text('storageprice', null, ['class'=>"form-control", 'disabled', 'id'=>"storageprice"]) !!}
                    &nbsp;
                    <button type="submit" class="btn btn-default">Buy</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- jquery script -->
    <script type="text/javascript">
        $('#samount').keyup(calculateStorage);
        function calculateStorage(e) {
            var price = 250;
            var maths = price * $('#samount').val();
            $('#storageprice').val(numberWithCommas(maths));
        }
        function numberWithCommas(x) {
            return "$" + x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection
