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
                    <div class="col-md-3 text-center">
                        <a href="#" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Expand</button>
                        </a>
                    </div>

                    <div class="col-md-3 text-center">
                        <a href="#" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Manage</button>
                        </a>
                    </div>

                    <div class="col-md-3 text-center">
                        <a href={{url('viewrequests')}} class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Join requests</button>
                        </a>
                    </div>

                    <div class="col-md-3 text-center">
                        <a href="#" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Options</button>
                        </a>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Resource</td>
                            <td class="table_dark_bg" style="width: 10%;">Storage</td>
                            <td class="table_dark_bg" style="width: 20%;"></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cash</td>
                            <td>${{number_format($company->cash)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                {!! Form::hidden("id", 2) !!}
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
                                {!! Form::hidden("id", 2) !!}
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
                                {!! Form::hidden("id", 2) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Wheat</td>
                            <td>{{number_format($company->wheat)}} / {{number_format(1000000)}}</td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                {!! Form::hidden("id", 2) !!}
                                <input type="number" class="form-control" placeholder="Amount" id="offer"
                                       name="amount">
                                <button type="submit" class="btn btn-default">Deposit</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <hr/>
                    @if ($user->name == $company->owner)
                        <b>Disbanding</b>
                        <br>
                        If you want to <b>delete all progress and the entire company itself,</b> you can disband your
                        company.
                        Alternatively, if you still want the company to exist, you can transfer the ownership of the
                        company to
                        another member in the member management menu.
                        <br>
                        <br>
                        {!! Form::checkbox("confirm") !!} I hereby confirm that I will knowingly delete my company and
                        it's progress by pressing 'Disband'.
                        <br>
                        <br>
                        <button type="submit" class="btn btn-danger">Disband</button>
                    @else
                        <b>Leaving</b>
                        <br>
                        If you want to leave this company, you can press the 'Leave' button below to do so.
                        <br><br>
                        <button type="submit" class="btn btn-danger">Leave</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
