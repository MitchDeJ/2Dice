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
    <script>
        @foreach($cooldowns as $c)
        @if ($c != null)
        // Set the date we're counting down to
        var countDownDate{{$loop->iteration}} = {{$c->end}};

        // Update the count down every 1 second
        var x{{$loop->iteration}} = setInterval(function () {

            // Get todays date and time
            var now = Math.round((new Date()).getTime() / 1000);

            // Find the distance between now an the count down date
            var distance{{$loop->iteration}} = countDownDate{{$loop->iteration}} - now;

            // Time calculations for days, hours, minutes and seconds
            var minutes{{$loop->iteration}} = Math.floor((distance{{$loop->iteration}} % (60 * 60)) / (60));
            var seconds{{$loop->iteration}} = Math.floor((distance{{$loop->iteration}} % (60)));

            // Output the result in an element with id="demo"
            document.getElementById("cd{{$loop->iteration}}").innerHTML = "This job will be available in "+ minutes{{$loop->iteration}} + "m " + seconds{{$loop->iteration}} + "s. ";

            // If the count down is over, write some text
            if (distance{{$loop->iteration}} < 0) {
                clearInterval(x{{$loop->iteration}});
                document.getElementById("cd{{$loop->iteration}}").innerHTML = "This job is available.";
                document.getElementById("cd{{$loop->iteration}}").style.color = "green";
            }
        }, 100);
        @endif
        @endforeach
    </script>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Jobs</div>
            <div class="card-body">
                <p>You will have 5 jobs available if you're VIP and 3 if you're not a VIP.</p>
                <p>You can choose between 2 options: More cash, or more XP.</p>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-inline">
                            <label for="job1">Choose a job: &nbsp;</label>
                            {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                            {!! Form::hidden("num", 1) !!}
                            {!! Form::select('action', array("moneyjob" => 'Give a business proposal (more cash)', "xpjob" => 'Give personal financial advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                            <button type="submit" class="btn btn-default">Start job</button>
                            {!! Form::close() !!}
                        </div>
                        @if ($cooldowns[1] == null)
                            <p style="color:green">This job is available.</p>
                            @else
                            <p id="cd1" style="color:red"></p>
                            @endif
                    </div>
                </div>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-inline">
                            <label for="job2">Choose a job: &nbsp;</label>
                            {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                            {!! Form::hidden("num", 2) !!}
                            {!! Form::select('action', array("moneyjob" => 'Organise a business trip (more cash)', "xpjob" => 'Give personal stock market advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                            <button type="submit" class="btn btn-default">Start job</button>
                            {!! Form::close() !!}
                        </div>
                        @if ($cooldowns[2] == null)
                            <p style="color:green">This job is available.</p>
                        @else
                            <p id="cd2" style="color:red"></p>
                        @endif
                    </div>
                </div>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-inline">
                            <label for="job3">Choose a job: &nbsp;</label>
                            {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                            {!! Form::hidden("num", 3) !!}
                            {!! Form::select('action', array("moneyjob" => 'Guide a company with their business plan(more cash)', "xpjob" => 'Give personal marketplace advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                            <button type="submit" class="btn btn-default">Start job</button>
                            {!! Form::close() !!}
                        </div>
                        @if ($cooldowns[3] == null)
                            <p style="color:green">This job is available.</p>
                        @else
                            <p id="cd3" style="color:red"></p>
                        @endif
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
                                {!! Form::hidden("num", 4) !!}
                                {!! Form::select('action', array("moneyjob" => 'Guide a company with their business plan(more cash)', "xpjob" => 'Give personal marketplace advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                                <button type="submit" class="btn btn-default">Start job</button>
                                {!! Form::close() !!}
                            </div>
                            @if ($cooldowns[4] == null)
                                <p style="color:green">This job is available.</p>
                            @else
                                <p id="cd4" style="color:red"></p>
                            @endif
                        </div>
                    </div>
                    <br>
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-inline">
                                <label for="job3">Choose a job: &nbsp;</label>
                                {!! Form::open(['route' => ['business.job'], 'method' => 'post']) !!}
                                {!! Form::hidden("num", 5) !!}
                                {!! Form::select('action', array("moneyjob" => 'Guide a company with their business plan(more cash)', "xpjob" => 'Give personal marketplace advice (more xp)'), 'moneyjob', ['class' => 'form-control form-group']) !!}
                                <button type="submit" class="btn btn-default">Start job</button>
                                {!! Form::close() !!}
                            </div>
                            @if ($cooldowns[5] == null)
                                <p style="color:green">This job is available.</p>
                            @else
                                <p id="cd5" style="color:red"></p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

