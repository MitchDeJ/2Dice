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
            <div class="card-header"><i class="fa fa-university i_button_background"></i> Market prices</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 33%;">Marketplace (player controlled)</td>
                            <td class="table_dark_bg" style="width: 33%;">Quantity for sale</td>
                            <td class="table_dark_bg" style="width: 33%;">Guide price</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    {{$item}}
                                </td>
                                <td>
                                    @if ($amounts[$loop->iteration-1] != 0)
                                        {{number_format($amounts[$loop->iteration-1])}}
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>
                                    @if ($prices[$loop->iteration-1] != 0)
                                        ${{number_format($prices[$loop->iteration-1])}}
                                    @else
                                        Unknown
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">


                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;"><img src="img/netherlands.png">
                                        Netherlands
                                    </td>
                                    <td class="table_dark_bg" style="width: 50%;">Quick-sell price</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    @if($loop->iteration-1 != 3)
                                        <tr>
                                            <td>
                                                {{$item}}
                                            </td>
                                            <td>
                                                ${{number_format($quicksells[1][$loop->iteration-1])}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;"><img src="img/uk.png"> United Kingdom
                                    </td>
                                    <td class="table_dark_bg" style="width: 50%;">Quick-sell price</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    @if($loop->iteration-1 != 3)
                                        <tr>
                                            <td>
                                                {{$item}}
                                            </td>
                                            <td>
                                                ${{number_format($quicksells[2][$loop->iteration-1])}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;"><img src="img/russia.png"> Russia</td>
                                    <td class="table_dark_bg" style="width: 50%;">Quick-sell price</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    @if($loop->iteration-1 != 3)
                                        <tr>
                                            <td>
                                                {{$item}}
                                            </td>
                                            <td>
                                                ${{number_format($quicksells[3][$loop->iteration-1])}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection