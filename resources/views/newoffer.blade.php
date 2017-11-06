<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 6-11-2017
 * Time: 21:48
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-university i_button_background"></i> Marketplace</div>
            <div class="card-body">
                <div class="col-md-1">
                    <label for="type">Type</label>
                    <select class="form-control form-group form-inline">
                        <option>Buy</option>
                        <option>Sell</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="item">Item</label>
                    <select class="form-control form-group form-inline">
                        <option>Wood</option>
                        <option>Stone</option>
                        <option>Wheat</option>
                    </select>
                </div>
                <div class="col-md-2 form-group form-inline">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="email" class="form-control" id="price" placeholder="">
                </div>
                <div class="col-md-2 form-group form-inline">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="email" class="form-control" id="amount" placeholder="">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-default">Create offer</button>
                </div>
            </div>
        </div>
    </div>
@endsection