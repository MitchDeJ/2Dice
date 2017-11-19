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
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Company profile | <a
                        class="text-dark" href="#">Edit profile</a></div>
            <div class="card-body">
                <img src="{!! url("/userimg/".$user->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <h4 class="text-center">Company name</h4>

                <button style="display: block;margin: auto;" class="btn btn-success">Join this company</button>

                <div class="form-group">
                    <br>
                    <textarea class="form-control text-center" id="about_area" rows="6"
                              disabled>company desc</textarea>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">Company status</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i class="fa fa-trophy i_button_background"></i>
                                        Position
                                    </td>
                                    <td>
                                        #1
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-star i_button_background"></i>
                                        Level
                                    </td>
                                    <td>
                                        55
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-rocket i_button_background"></i>
                                        Total power
                                    </td>
                                    <td>
                                        500,000
                                    </td>
                                </tr>
                                <tr>
                                    <td><i style="color: #f39c12;" class="fa fa-money i_button_background"></i>
                                        Base income
                                    </td>
                                    <td>
                                        $10,000
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">Company information</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i class="fa fa-suitcase i_button_background"></i>
                                        Owner
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark">{{$user->name}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-calendar-check-o i_button_background"></i>
                                        Created
                                    </td>
                                    <td>
                                        01-01-2000
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Position</td>
                            <td class="table_dark_bg" style="width: 30%;">Members</td>
                            <td class="table_dark_bg" style="width: 30%;">Role</td>
                            <td class="table_dark_bg" style="width: 30%;">Power</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>523523</td>
                            <td><a href="#" class="text-dark">{{$user->name}}</a></td>
                            <td>Owner</td>
                            <td>{{number_format($user->power)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

