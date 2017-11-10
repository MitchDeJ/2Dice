<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 10-11-2017
 * Time: 16:19
 */
?>
@extends('layouts.app')

@section('content')
    @if ($user->company == -1)
        <div class="container-fluid">
            <div id="fail" class="alert alert-danger" align="center">
                <strong>Creating or joining a company is recommended. If you decide not to create or join a company,
                    you'll miss out on a big part of the game.</strong>
            </div>
            <div class="card mb-3">
                <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Company create</div>
                <div class="card-body">
                    <p>Creating a company is an one time payment of $500,000. Joining one is free. </p>
                    <div class="form-inline">
                        <label>Company name &nbsp;</label>
                        <input type="text" class="form-control" placeholder="" id="companyCreate" name="companyCreate">
                        <button type="submit" class="btn btn-default">Create</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        Redirect
    @endif
@endsection
