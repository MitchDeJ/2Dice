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
                    <div class="col-md-2">
                        <input type="number" class="form-control" placeholder="Bet amount">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default">New game</button>
                    </div>
                </div>

                <div class="table-responsive"> <br>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Host</td>
                            <td class="table_dark_bg" style="width: 10%;">Bet</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <a href="#" class="text-dark">Envy</a>
                            </td>
                            <td>
                                $100,000
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
