<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 4-11-2017
 * Time: 22:09
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Stock market</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Company</td>
                            <td class="table_dark_bg" style="width: 10%;">Price</td>
                            <td class="table_dark_bg" style="width: 10%;">Last change</td>
                            <td class="table_dark_bg" style="width: 10%;">Stock owned</td>
                            <td class="table_dark_bg" style="width: 10%;">Stock available</td>
                            <td class="table_dark_bg" style="width: 10%;">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                Jamflex Studios
                            </td>
                            <td>
                                $201
                            </td>
                            <td>
                                <div style="color: green;">+5%</div>
                            </td>
                            <td>
                                123
                            </td>
                            <td>
                                49,999,877
                            </td>
                            <td>
                                <form method="POST" name="type">
                                    <select name="type">
                                        <option value="B">Buy</option>
                                        <option value="BA">Buy all</option>
                                        <option value="S">Sell</option>
                                        <option value="SA">Sell all</option>
                                    </select>

                                    <input name="stockid" type="hidden" value="1">
                                    <input class="form-control" placeholder="" name="amount" type="text">
                                    <button type="submit" class="btn btn-default">Exchange</button>
                                </form>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                Bob's Fried Chicken
                            </td>
                            <td>
                                $209
                            </td>
                            <td>
                                <div style="color: red;">-2%</div>
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                50,000,000
                            </td>
                            <td>
                                <form method="POST" name="type">
                                    <select name="type">
                                        <option value="B">Buy</option>
                                        <option value="BA">Buy all</option>
                                        <option value="S">Sell</option>
                                        <option value="SA">Sell all</option>
                                    </select>

                                    <input name="stockid" type="hidden" value="1">
                                    <input class="form-control" placeholder="" name="amount" type="text">
                                    <button type="submit" class="btn btn-default">Exchange</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
