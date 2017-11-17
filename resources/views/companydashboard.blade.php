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
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Company dashboard</div>
            <div class="card-body">
                <a href="#" class="text-dark">
                    <button type="button" class="btn btn-outline-dark">View profile</button>
                </a>
                <a href="#" class="text-dark">
                    <button type="button" class="btn btn-outline-dark">View join requests</button>
                </a>

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
                </div>
            </div>
        </div>
    </div>
@endsection
