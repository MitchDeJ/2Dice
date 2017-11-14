<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 5-11-2017
 * Time: 19:36
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Jobs</div>
            <div class="card-body">
                <p>vip yes = 5 jobs, vip no = 3 jobs. <b>get vip</b></p>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-inline">
                            <label for="job1">Choose a job: &nbsp;</label>
                            {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                            {!! Form::select('action', array("moneyjob" => 'Give a business proposal (more cash)', "xpjob" => 'Give personal financial advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                            <button type="submit" class="btn btn-default">Start job</button>
                            {!! Form::close() !!}
                        </div>
                        Cooldown
                    </div>
                </div>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-inline">
                            <label for="job2">Choose a job: &nbsp;</label>
                            {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                            {!! Form::select('action', array("moneyjob" => 'Organise a business trip (more cash)', "xpjob" => 'Give personal stock market advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                            <button type="submit" class="btn btn-default">Start job</button>
                            {!! Form::close() !!}
                        </div>
                        Cooldown
                    </div>
                </div>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-inline">
                            <label for="job3">Choose a job: &nbsp;</label>
                            {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                            {!! Form::select('action', array("moneyjob" => 'Guide a company with their business plan(more cash)', "xpjob" => 'Give personal marketplace advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                            <button type="submit" class="btn btn-default">Start job</button>
                            {!! Form::close() !!}
                        </div>
                        Cooldown
                    </div>
                </div>
                <br>
                @if($user->vip == true)
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-inline">
                                <label for="job3">Choose a job: &nbsp;</label>
                                {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                                {!! Form::select('action', array("moneyjob" => 'Guide a company with their business plan(more cash)', "xpjob" => 'Give personal marketplace advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                                <button type="submit" class="btn btn-default">Start job</button>
                                {!! Form::close() !!}
                            </div>
                            Cooldown
                        </div>
                    </div>
                    <br>
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-inline">
                                <label for="job3">Choose a job: &nbsp;</label>
                                {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                                {!! Form::select('action', array("moneyjob" => 'Guide a company with their business plan(more cash)', "xpjob" => 'Give personal marketplace advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                                <button type="submit" class="btn btn-default">Start job</button>
                                {!! Form::close() !!}
                            </div>
                            Cooldown
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

