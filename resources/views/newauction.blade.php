<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 11-11-2017
 * Time: 00:45
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-university i_button_background"></i> New auction</div>
            <div class="card-body">
                <div class="col-md-2 form-group form-inline">
                    <label for="type">Object type &nbsp;</label>
                    <select class="form-control form-group form-inline" id="type">
                        <option>Blackjack Netherlands</option>
                    </select>
                </div>

                <div class="col-md-2 form-group form-inline">
                    <label for="price">Minimum price &nbsp;</label>
                    <input type="number" class="form-control" placeholder="Amount" id="price" name="price">
                </div>

                <div class="col-md-2 form-group form-inline">
                    <label for="price">Time (hours:minutes) &nbsp;</label>
                    <input type="time" class="form-control" placeholder="Amount" id="time" name="time">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-default">Create auction</button>
                </div>
            </div>
        </div>
    </div>
@endsection
