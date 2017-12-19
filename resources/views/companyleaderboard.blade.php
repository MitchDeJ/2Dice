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
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company Leaderboard</div>
            <div class="table-responsive">
                <div class="card-body">
                    <div class="col-md-12" style="text-align: right">
                        <label>
                            {!! Form::open(['route' => ['leaderboard.getcompany'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            {!! Form::text('name', '', ["class" => "form-control form-control-sm form-inline", 'placeholder' => 'Search'])!!}
                            {!! Form::close() !!}
                        </label>

                        <label>
                            {!! Form::open(['route' => ['leaderboard.getcompanypage'], 'method' => 'post', 'id' => 'pageselect']) !!}
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
                            <td class="table_dark_bg" style="width: 12%;">Rank</td>
                            <td class="table_dark_bg" style="width: 22%;">Company</td>
                            <td class="table_dark_bg" style="width: 22%;">Level</td>
                            <td class="table_dark_bg" style="width: 22%;">Members</td>
                            <td class="table_dark_bg" style="width: 22%;">Total power</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{(($num-1)*25)+$loop->iteration}}</td>
                                <td>
                                    <a class="text-dark" href="{{url("/companyprofile/".$company->name)}}">{{$company->name}}</a>
                                </td>
                                <td>{{number_format($company->level)}}</td>
                                <td>{{number_format($members[$company->id])}}</td>
                                <td>{{number_format($totalpower[$company->id])}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection