<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 16:24
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-plane"></i> Location</div>
            <div class="card-body">
                <p>You can fly to another country every <strong>30 minutes</strong>. The country you are currently in is marked in bold.</p>
                <p>As a VIP you can fly to another country every <strong>10 minutes</strong>.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 0.5%;">Option</td>
                            <td class="table_dark_bg" style="width: 10%;">Country</td>
                            <td class="table_dark_bg" style="width: 10%;">Cost</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($locations as $loc)
                        <tr>
                            <td>
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios[]" value="option[]">
                                </label>
                            </td>
                            <td>
                                <img src="{{asset("img/".$loc->flag)}}"> {{$loc->name}}
                            </td>
                            <td>
                                $1,000
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-default">Fly</button>
            </div>
        </div>
    </div>
@endsection