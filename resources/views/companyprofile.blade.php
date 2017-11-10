<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 10-11-2017
 * Time: 16:53
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Company profile</div>
            <div class="card-body">
                <img src="{!! url("/userimg/".$user->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <h4 class="text-center">Company name</h4>

                <div class="form-group">
                    <br>
                    <textarea class="form-control text-center" id="about_area" rows="6"
                              disabled>company desc</textarea>
                </div>
                <br>

                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Company status</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i class="fa fa-trophy i_button_background"></i> Position: #1</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-star i_button_background"></i> Level: 54</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-rocket i_button_background"></i> Total power: 500,000</td>
                        </tr>
                        <tr>
                            <td><i style="color: #f39c12;" class="fa fa-money i_button_background"></i> Base income:
                                $346,634,434
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Company information</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i class="fa fa-suitcase i_button_background"></i> Founder: m1tch</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar-check-o i_button_background"></i> Created: 01-01-2000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 2%;">Rank</td>
                            <td class="table_dark_bg" style="width: 4%;">Members</td>
                            <td class="table_dark_bg" style="width: 20%;">Power</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#" class="text-dark">m1tch</a></td>
                            <td>500,000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

