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
                <div class="table-bordered table-responsive">
                    <div class="col-md-2" style="float: right;">
                    <label>Search:
                        <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                    </label>

                    <label>Page
                        <select name="dataTable_length" aria-controls="dataTable" class="form-control form-control-sm">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </label>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>Rank</td>
                            <td>Player</td>
                            <td>Power</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#" class="text-dark">Envy</a></td>
                            <td>{{number_format($user->power)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
@endsection
