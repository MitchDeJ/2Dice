<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 4-11-2017
 * Time: 20:03
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Collaboration</div>
            <div class="card-body">
                {!! Form::open(['route' => ['collab.start'], 'method' => 'post']) !!}
                <button type="submit" class="btn btn-default">Start a new collab</button>
                {!! Form::close() !!}
                <br>
                @if (count($collabs) == 0)
                <p>There are currently no collab groups available.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Host</td>
                            <td class="table_dark_bg" style="width: 10%;">Status</td>
                            <td class="table_dark_bg" style="width: 1%;">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($collabs as $collab)
                        <tr>
                            <td>
                                {{$collab->user}}
                            </td>
                            <td>
                                Waiting for partner...
                            </td>
                            <td>
                                @if ($collab->user != Auth::user()->name)
                                    {!! Form::open(['route' => ['collab.join'], 'method' => 'post']) !!}
                                    {!! Form::hidden("id", $collab->id) !!}
                                    <button type="submit" class="btn btn-default">Join</button>
                                    {!! Form::close() !!}
                                    @else
                                    {!! Form::open(['route' => ['collab.cancel'], 'method' => 'post']) !!}
                                    {!! Form::hidden("id", $collab->id) !!}
                                    <button type="submit" class="btn btn-default">Cancel</button>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
