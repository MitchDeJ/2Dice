<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 1-11-2017
 * Time: 18:09
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-tasks i_button_background"></i> Leaderboard</div>
            <div class="table-responsive">
                <div class="card-body">
                    <div class="col-md-2" style="float: right;">
                        <label>Search:
                            {!! Form::open(['route' => ['leaderboard.getPlayer'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            {!! Form::text('name', '', ["class" => "form-control form-control-sm"]) !!}
                            {!! Form::close() !!}
                        </label>

                        <label>Page
                            {!! Form::open(['route' => ['leaderboard.getPage'], 'method' => 'post', 'id' => 'pageselect']) !!}
                            <select name="pageselected" class="form-control form-control-sm" form="pageselect"
                                    onchange="this.form.submit()">
                                @for($i=1; $i<=$pages; $i++)
                                    <option value="{{$i}}" @if ($i == $num) selected="selected"@endif>{{$i}}</option>
                                @endfor
                            </select>
                            {!! Form::close() !!}
                        </label>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Rank</td>
                            <td class="table_dark_bg" style="width: 45%;">Player</td>
                            <td class="table_dark_bg" style="width: 45%;">Power</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{(($num-1)*25)+$loop->iteration}}</td>
                                <td><a href="{{url("/profile/".$user->name)}}"
                                       @if($user->vip == true)
                                       class="vip_yes"
                                       @else
                                       class="text-dark"
                                       @endif >{{$user->name}}</a>
                                </td>
                                <td>{{number_format($user->power)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection