<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 18:23
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-shopping-bag i_button_background"></i> Prestige shop</div>
            <div class="card-body">
                <p>You currently have {{number_format($user->prestigepoints)}} prestige points.</p>
                <p>The prestige shop accepts prestige points only. Click <a href="{{ url('/general') }}" class="text-dark"><b>here</b></a> to go to the general store.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 33%;">Product</td>
                            <td class="table_dark_bg" style="width: 33%;">Cost</td>
                            <td class="table_dark_bg" style="width: 34%;">Amount</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                50,000 Power
                            </td>
                            <td>
                                1 Prestige point
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['shop.claimpower'], 'method' => 'post']) !!}
                                    <input type="number" class="form-control" placeholder="Amount" id="power" name="amount">
                                    <button type="submit" class="btn btn-default">Buy</button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                $3,000,000 Cash
                            </td>
                            <td>
                                1 Prestige point
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['shop.claimcash'], 'method' => 'post']) !!}
                                    <input type="number" class="form-control" placeholder="Amount" id="cash" name="amount">
                                    <button type="submit" class="btn btn-default">Buy</button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                14 days VIP
                            </td>
                            <td>
                                1 Prestige point
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['shop.claimvip'], 'method' => 'post']) !!}
                                    <input type="number" class="form-control" placeholder="Amount" id="vip" name="amount">
                                    <button type="submit" class="btn btn-default">Buy</button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Global message
                            </td>
                            <td>
                                1 Prestige point
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['shop.claimvip'], 'method' => 'post']) !!}
                                    <input type="number" class="form-control" placeholder="Amount" id="message" name="amount">
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

