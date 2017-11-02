<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 23:54
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> 55x45</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <input type="number" class="form-control" placeholder="Bet amount">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default">Roll</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
