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
                Manage members | <a class="text-dark"
                                    href="{{url("/companydashboard")}}">Back</a></div>
            <div class="card-body">
                @if (count($members) == 0)
                    <br>
                    <p>No members to manage. Maybe it's time to recruit some first?</p>
                @else
                    <div class="table-responsive"><br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 33%;">Player</td>
                                <td class="table_dark_bg" style="width: 33%;">Role</td>
                                <td class="table_dark_bg" style="width: 34%;">Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>
                                        <a class="text-dark"
                                           href="{{url("/profile/".$member->name)}}"> {{$member->name}}</a>
                                    </td>
                                    <td>
                                        <div class="form-inline">
                                            {!! Form::open(['route' => ['company.setrole'], 'method' => 'post']) !!}
                                            {!! Form::select('rights', array(0 => 'Member', 1 => 'Moderator', 2 => 'Admin'), ComAff::getRights($member), ['class' => 'form-control form-group form-inline', 'onchange' => "this.form.submit()"]) !!}
                                            {!! Form::hidden("id", $member->id) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-inline">
                                            {!! Form::open(['route' => ['company.kick'], 'method' => 'post']) !!}
                                            {!! Form::hidden("id", $member->id) !!}
                                            <button type="submit" class="btn btn-danger">Kick</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($user->name == $company->owner)
                            <hr/>
                            <b>Transfer ownership</b>
                            <br>
                            If you don't want to be the company's owner anymore, you can transfer ownership to another
                            member.
                            {!! Form::open(['route' => ['company.changeowner'], 'method' => 'post', 'class' => 'form-inline']) !!}
                            <input type="text" class="form-control" placeholder="Player" name="name">
                            <button type="submit" class="btn btn-default">Transfer</button>
                            {!! Form::close() !!}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection