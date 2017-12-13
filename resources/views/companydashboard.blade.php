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
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company dashboard</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <a href="#" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Expand</button>
                        </a>
                    </div>

                    <div class="col-md-2 text-center">
                        <a href="{{url('managemembers')}}" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Manage</button>
                        </a>
                    </div>

                    <div class="col-md-2 text-center">
                        <a href="{{url('companymarket')}}" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Marketplace</button>
                        </a>
                    </div>

                    <div class="col-md-2 text-center">
                        <a href={{url('viewrequests')}} class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Join requests</button>
                        </a>
                    </div>

                    <div class="col-md-2 text-center">
                        <a href="{{url("/companyoptions")}}" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Options</button>
                        </a>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 33%;">Resource</td>
                            <td class="table_dark_bg" style="width: 33%;">Storage</td>
                            <td class="table_dark_bg" style="width: 34%;">Deposit</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cash</td>
                            <td>${{number_format($company->cash)}}</td>
                            <td>
                                {!! Form::open(['route' => ['company.depositcash'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Wood</td>
                            <td>{{number_format($company->wood)}} / {{number_format(1000000)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Stone</td>
                            <td>{{number_format($company->stone)}} / {{number_format(1000000)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Oil</td>
                            <td>{{number_format($company->oil)}} / {{number_format(1000000)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Planks</td>
                            <td>{{number_format($company->planks)}} / {{number_format(1000000)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Bricks</td>
                            <td>{{number_format($company->bricks)}} / {{number_format(1000000)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Gasoline</td>
                            <td>{{number_format($company->gasoline)}} / {{number_format(1000000)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <hr/>
                    <b>Quick-sell</b>
                    <br>
                    <p>For current quick-sell prices, check out the <a class="text-dark" href="{{url('/marketprices')}}">Market prices page.</a></p>
                    {!! Form::open(['route' => ['company.quicksell'], 'method' => 'post', 'class' => 'form-inline']) !!}
                    <input type="number" class="form-control" placeholder="Amount" id="qsamount"
                           name="amount">
                    &nbsp;
                    {!! Form::select('item', $items, 0, ['class' => 'form-control', 'id'=>'item']) !!}
                    &nbsp;
                    {!! Form::text('totalprice', null, ['class'=>"form-control", 'disabled', 'id'=>"totalprice"]) !!}
                    &nbsp;
                    <button type="submit" class="btn btn-default">Sell</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- jquery script -->
    <script type="text/javascript">
        $('#item').change(calculate);
        $('#qsamount').keyup(calculate);
        function calculate(e) {
            var item = $('#item').val();
            var quicksells = <?php echo json_encode($quicksells); ?>;
            var itemprice = quicksells[item];
            var maths = itemprice * $('#qsamount').val();
            $('#totalprice').val(numberWithCommas(maths));
        }
        function numberWithCommas(x) {
            return "$"+x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection
