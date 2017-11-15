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
                <a href="{{ url('/newoffer') }}">
                    <button type="submit" class="btn btn-default">New offer</button>
                </a>
                <div class="row">
                    @foreach($offers as $offer)
                        <div class="col-md-4 logo_center">
                            <div class="table-responsive"><br>
                                <table class="table table-active" style="text-align: center;">
                                    <thead>
                                    <tr>
                                        @if ($offer->offertype == 0)
                                            <td class="table_dark_bg" style="width: 10%;">Buying</td>
                                        @elseif ($offer->offertype == 1)
                                            <td class="table_dark_bg" style="width: 10%;">Selling</td>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{$itemnames->get($offer->item)}} - <b>${{number_format($offer->price)}}</b> each
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{number_format($offer->completed)}}/{{number_format($offer->amount)}} completed
                                        </td>
                                    </tr>
                                    <tr>
                                        @if($offer->cancelled == true)
                                            <td class="table-danger">
                                                Cancelled
                                            </td>
                                        @elseif($offer->cancelled == false && $offer->completed >= $offer->amount)
                                            <td class="table-success">
                                                Offer completed
                                            </td>
                                        @elseif($offer->cancelled == false && $offer->completed < $offer->amount)
                                            <td class="table-info">
                                                Offer in progress
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row" style="margin: auto; justify-content: center">
                                            {!! Form::open(['route' => ['market.collect'], 'method' => 'post']) !!}
                                            <button type="submit" class="btn btn-dark form-group">Collect</button>
                                            {!! Form::hidden("id", $offer->id) !!}
                                            {!! Form::close() !!}
                                                &nbsp;
                                            {!! Form::open(['route' => ['market.cancel'], 'method' => 'post']) !!}
                                            <button type="submit" class="btn btn-dark form-group">Cancel</button>
                                            {!! Form::hidden("id", $offer->id) !!}
                                            {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-university i_button_background"></i> Auction</div>
            <div class="card-body">
                <a href="{{ url('/newauction') }}">
                    <button type="submit" class="btn btn-default">New auction</button>
                </a>
                <p><br>If an object is for sale, it will be for auction here.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Auction</td>
                            <td class="table_dark_bg" style="width: 10%;">Auctioneer</td>
                            <td class="table_dark_bg" style="width: 20%;">Type</td>
                            <td class="table_dark_bg" style="width: 20%;">Highest bid</td>
                            <td class="table_dark_bg" style="width: 20%;">Time left</td>
                            <td class="table_dark_bg" style="width: 20%;">Offer</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#" class="text-dark">Envy</a></td>
                            <td>Roulette Netherlands</td>
                            <td>$125,523,523</td>
                            <td><p id="demo"></p></td>
                            <td>
                                <div class="form-inline">
                                    <input type="number" class="form-control" placeholder="Amount" id="offer" name="offer">
                                    <button type="submit" class="btn btn-default">Offer</button>
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
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Nov 15, 2018 15:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>

