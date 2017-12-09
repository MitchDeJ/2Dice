<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 17-11-2017
 * Time: 19:26
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> Company dashboard</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                    <a href="#" class="text-dark">
                        <button type="button" class="btn btn-outline-dark">Expand</button>
                    </a>
                    </div>

                    <div class="col-md-3 text-center">
                    <a href="#" class="text-dark">
                        <button type="button" class="btn btn-outline-dark">Manage</button>
                    </a>
                    </div>

                    <div class="col-md-3 text-center">
                        <a href={{url('viewrequests')}} class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Join requests</button>
                        </a>
                    </div>

                    <div class="col-md-3 text-center">
                        <a href="#" class="text-dark">
                            <button type="button" class="btn btn-outline-dark">Options</button>
                        </a>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-md-3"><br>
                        <div class="table-responsive">
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg text-center" style="width: 100%;">Cash</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">Current cash available: <b>$500,532,523,523</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <form class="form-inline">
                                            <input style="margin: 0 auto; width: 50%;" type="number"
                                                   class="form-control" id="amount">
                                            <button style="margin: 0 auto; width: 50%;" type="button"
                                                    class="btn btn-default">Deposit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3"><br>
                        <div class="table-responsive">
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg text-center" style="width: 100%;">Stone</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">Current stone available: <b>500</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <form class="form-inline">
                                            <input style="margin: 0 auto; width: 50%;" type="number"
                                                   class="form-control" id="amount">
                                            <button style="margin: 0 auto; width: 50%;" type="button"
                                                    class="btn btn-default">Deposit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3"><br>
                        <div class="table-responsive">
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg text-center" style="width: 100%;">Wood</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">Current wood available: <b>500</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <form class="form-inline">
                                            <input style="margin: 0 auto; width: 50%;" type="number"
                                                   class="form-control" id="amount">
                                            <button style="margin: 0 auto; width: 50%;" type="button"
                                                    class="btn btn-default">Deposit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3"><br>
                        <div class="table-responsive">
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg text-center" style="width: 100%;">Wheat</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">Current wheat available: <b>500</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <form class="form-inline">
                                            <input style="margin: 0 auto; width: 50%;" type="number"
                                                   class="form-control" id="amount">
                                            <button style="margin: 0 auto; width: 50%;" type="button"
                                                    class="btn btn-default">Deposit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Position</td>
                            <td class="table_dark_bg" style="width: 20%;">Name</td>
                            <td class="table_dark_bg" style="width: 20%;">Level</td>
                            <td class="table_dark_bg" style="width: 20%;">Base income</td>
                            <td class="table_dark_bg" style="width: 30%;">Total power</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#" class="text-dark">Company name</a></td>
                            <td>3</td>
                            <td>$545,534,555</td>
                            <td>500,000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>
@endsection
