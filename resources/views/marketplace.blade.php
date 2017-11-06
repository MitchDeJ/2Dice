<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 2-11-2017
 * Time: 18:34
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-university i_button_background"></i> Marketplace</div>
            <div class="card-body">
                <button type="submit" class="btn btn-dark">New offer</button>
                <div class="row">
                    <div class="col-md-4 logo_center">
                        <div class="table-responsive"><br>
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;">Buying</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Stone - <b>$100</b> each
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        69/69 bought
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="img/netherlands.png"> Netherlands
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-success">
                                        Offer completed
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-dark form-inline">Collect</button>
                                        <button type="submit" class="btn btn-dark form-inline">Cancel</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-4 logo_center">
                        <div class="table-responsive"><br>
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;">Selling</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Wheat - <b>$120</b> each
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        10/100 sold
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="img/uk.png"> United Kingdom
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-info">
                                        Offer in progress
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-dark form-inline">Collect</button>
                                        <button type="submit" class="btn btn-dark form-inline">Cancel</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-4 logo_center">
                        <div class="table-responsive"><br>
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 10%;">Selling</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Wood - <b>$200</b> each
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        0/10 sold
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="img/russia.png"> Russia
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-danger">
                                        Canceled
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-dark form-inline">Collect</button>
                                        <button type="submit" class="btn btn-dark form-inline">Cancel</button>
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
