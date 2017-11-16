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
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Coinflip</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => ['coinflip.new'], 'method' => 'post', 'class' => 'form-inline']) !!}
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Bet amount" id="bet" name="bet">
                            <div>
                                <button type="submit" class="btn btn-default">New coinflip</button>

                                <button type="button" herf="#"  onclick="allInButton()" class="btn btn-outline-success">ALL</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

                @if (count($coinflips) == 0)
                    <br>
                <p>There are currently no coinflip games available.</p>
                    @else
                <div class="table-responsive"><br>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Host</td>
                            <td class="table_dark_bg" style="width: 10%;">Bet</td>
                            <td class="table_dark_bg" style="width: 1%;">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coinflips as $cf)
                        <tr>
                            <td>
                                <a class="text-dark" href="{{url("/profile/".$cf->user)}}"> {{$cf->user}}</a>
                            </td>
                            <td>
                                ${{number_format($cf->bet)}}
                            </td>
                            <td>
                                @if($cf->user != Auth::user()->name)
                                    {!! Form::open(['route' => ['coinflip.play'], 'method' => 'post']) !!}
                                    {!! Form::hidden("id", $cf->id) !!}
                                <button type="submit" class="btn btn-default">Play</button>
                                    {!! Form::close() !!}
                                    @else
                                    {!! Form::open(['route' => ['coinflip.cancel'], 'method' => 'post']) !!}
                                    {!! Form::hidden("id", $cf->id) !!}
                                    <button type="submit" class="btn btn-danger">Cancel</button>
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
{{--Load all in button Javascript--}}
<script>
    function allInButton() {
        document.getElementById("bet").value = "{{$user->cash}}";
    }
</script>
