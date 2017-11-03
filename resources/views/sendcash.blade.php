<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 13:20
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-dollar i_button_background"></i> Send cash</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="exampleInputName2">Username &nbsp;</label>
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                            </div>&nbsp;
                            <div class="form-group">
                                <label for="exampleInputEmail2">Amount &nbsp;</label>
                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-default">Send cash </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
