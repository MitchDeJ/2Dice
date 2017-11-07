<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 3-11-2017
 * Time: 18:23
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-shopping-bag i_button_background"></i> Prestige shop</div>
            <div class="card-body">
                <p>The prestige shop will only sell it's items for prestige points. Click <a href="{{ url('/general') }}" class="text-dark"><b>here</b></a> to go to the general store.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Product</td>
                            <td class="table_dark_bg" style="width: 10%;">Cost</td>
                            <td class="table_dark_bg" style="width: 10%;">Amount</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                100,000 Power
                            </td>
                            <td>
                                0.5 Prestige point
                            </td>
                            <td>
                                <div class="form-inline">
                                    <input type="number" class="form-control" placeholder="Amount" id="power" name="power">
                                    <button type="submit" class="btn btn-default">Buy</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                $7,500,000 Cash
                            </td>
                            <td>
                                0.5 Prestige point
                            </td>
                            <td>
                                <div class="form-inline">
                                    <input type="number" class="form-control" placeholder="Amount" id="cash" name="cash">
                                    <button type="submit" class="btn btn-default">Buy</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                1 month VIP
                            </td>
                            <td>
                                1 Prestige point
                            </td>
                            <td>
                                <div class="form-inline">
                                    <input type="number" class="form-control" placeholder="Amount" id="vip" name="vip">
                                    <button type="submit" class="btn btn-default">Buy</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
