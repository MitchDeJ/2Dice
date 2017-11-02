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
                <p>You can fly to another country every <strong>30 minutes</strong>. The country you are currently in, will be bold.</p>
                <p>As a VIP you can fly to another country every <strong>10 minutes</strong>.</p>
                <div class="table-bordered table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 0.5%;">Option</th>
                            <th style="width: 10%;">Country</th>
                            <th style="width: 10%;">Cost</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios[]" value="option[]">
                                </label>
                            </td>
                            <td>
                                <img src="{{asset("img/netherlands.png")}}"> Netherlands
                            </td>
                            <td>
                                $1,000
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios[]" value="option[]">
                                </label>
                            </td>
                            <td>
                                <img src="{{asset("img/uk.png")}}"> United Kingdom
                            </td>
                            <td>
                                $1,000
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios[]" value="option[]">
                                </label>
                            </td>
                            <td>
                                <img src="{{asset("img/russia.png")}}"> Russia
                            </td>
                            <td>
                                $1,000
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-default">Fly</button>
            </div>
        </div>
    </div>
@endsection