<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 18:31
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-area-chart i_button_background"></i> Statistics</div>
            <div class="row card-body">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 5%;">Top richest players</td>
                                <td class="table_dark_bg" style="width: 10%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="#" class="text-dark">Envy</a></td>
                                <td>$100,000</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-dark">Envy</a></td>
                                <td>$100,000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td class="table_dark_bg" style="width: 5%;">Top ranked players</td>
                                <td class="table_dark_bg" style="width: 10%;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="#" class="text-dark">Envy</a></td>
                                <td>Rank 6 (Prestige 8)</td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-dark">Envy</a></td>
                                <td>Rank 6 (Prestige 8)</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
