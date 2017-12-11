<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 00:01
 */
?>
@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company dashboard >
                Company options | <a class="text-dark"
                                     href="{{url("/companydashboard")}}">Back</a></div>
            <div class="card-body">
                <div class="table-responsive"><br>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 50%;">Option</td>
                            <td class="table_dark_bg" style="width: 50%;">Value</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                Edit company profile
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['company.setoption'], 'method' => 'post']) !!}
                                    {!! Form::select('value', array(0 => 'Everyone', 1 => 'Moderator +', 2 => 'Admin +', 3 => 'Owner'),
                                     ComAff::getOption($company->id, "editprofile"), ['class' => 'form-control form-group form-inline', 'onchange' => "this.form.submit()", $enabled]) !!}
                                    {!! Form::hidden("option", "editprofile") !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Make / use market offers
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['company.setoption'], 'method' => 'post']) !!}
                                    {!! Form::select('value', array(0 => 'Everyone', 1 => 'Moderator +', 2 => 'Admin +', 3 => 'Owner'),
                                     ComAff::getOption($company->id, "makeoffers"), ['class' => 'form-control form-group form-inline', 'onchange' => "this.form.submit()", $enabled]) !!}
                                    {!! Form::hidden("option", "makeoffers") !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                View market offers
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['company.setoption'], 'method' => 'post']) !!}
                                    {!! Form::select('value', array(0 => 'Everyone', 1 => 'Moderator +', 2 => 'Admin +', 3 => 'Owner'),
                                     ComAff::getOption($company->id, "viewoffers"), ['class' => 'form-control form-group form-inline', 'onchange' => "this.form.submit()", $enabled]) !!}
                                    {!! Form::hidden("option", "viewoffers") !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Handle join requests / kick members
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['company.setoption'], 'method' => 'post']) !!}
                                    {!! Form::select('value', array(0 => 'Everyone', 1 => 'Moderator +', 2 => 'Admin +', 3 => 'Owner'),
                                     ComAff::getOption($company->id, "handlerequests"), ['class' => 'form-control form-group form-inline', 'onchange' => "this.form.submit()", $enabled]) !!}
                                    {!! Form::hidden("option", "handlerequests") !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Set roles
                            </td>
                            <td>
                                <div class="form-inline">
                                    {!! Form::open(['route' => ['company.setoption'], 'method' => 'post']) !!}
                                    {!! Form::select('value', array(0 => 'Everyone', 1 => 'Moderator +', 2 => 'Admin +', 3 => 'Owner'),
                                     ComAff::getOption($company->id, "setroles"), ['class' => 'form-control form-group form-inline', 'onchange' => "this.form.submit()", $enabled]) !!}
                                    {!! Form::hidden("option", "setroles") !!}
                                    {!! Form::close() !!}
                                </div>
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
                        {!! Form::open(['route' => ['company.disband'], 'method' => 'post']) !!}
                        {!! Form::checkbox("confirm") !!} I hereby confirm that I will knowingly delete my company and
                        it's progress by pressing 'Disband'.
                        <br>
                        <br>
                        <button type="submit" class="btn btn-danger">Disband</button>
                        {!! Form::close() !!}
                    @else
                        <b>Leaving</b>
                        <br>
                        If you want to leave this company, you can press the 'Leave' button below to do so.
                        <br><br>
                        {!! Form::open(['route' => ['company.leave'], 'method' => 'post']) !!}
                        <button type="submit" class="btn btn-danger">Leave</button>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection