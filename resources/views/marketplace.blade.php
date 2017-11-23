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
    <script>
        @foreach($auctions as $a)
        // Set the date we're counting down to
        var countDownDate{{$loop->iteration}} = {{$a->end}};

        // Update the count down every 1 second
        var x{{$loop->iteration}} = setInterval(function() {

            // Get todays date and time
            var now = Math.round((new Date()).getTime() / 1000);

            // Find the distance between now an the count down date
            var distance{{$loop->iteration}} = countDownDate{{$loop->iteration}} - now;

            // Time calculations for days, hours, minutes and seconds
            var hours{{$loop->iteration}} = Math.floor((distance{{$loop->iteration}} % (60 * 60 * 24)) / (60 * 60));
            var minutes{{$loop->iteration}} = Math.floor((distance{{$loop->iteration}} % (60 * 60)) / (60));
            var seconds{{$loop->iteration}} = Math.floor((distance{{$loop->iteration}} % (60)));

            // Output the result in an element with id="demo"
            document.getElementById("demo{{$loop->iteration}}").innerHTML = hours{{$loop->iteration}} + "h "
                + minutes{{$loop->iteration}} + "m " + seconds{{$loop->iteration}} + "s ";

            // If the count down is over, write some text
            if (distance{{$loop->iteration}} < 0) {
                clearInterval(x{{$loop->iteration}});
                document.getElementById("demo{{$loop->iteration}}").innerHTML = "EXPIRED";
            }
        }, 100);
        @endforeach
    </script>
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
                <p><br>If an object is up for auction, it will be shown here.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Auction</td>
                            <td class="table_dark_bg" style="width: 10%;">Auctioneer</td>
                            <td class="table_dark_bg" style="width: 20%;">Type</td>
                            <td class="table_dark_bg" style="width: 20%;">Minimum price</td>
                            <td class="table_dark_bg" style="width: 20%;">Highest bid</td>
                            <td class="table_dark_bg" style="width: 20%;">Time left</td>
                            <td class="table_dark_bg" style="width: 20%;">Bid</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auctions as $a)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{url("/profile/".$auctioneers[$a->id])}}" class="text-dark">{{$auctioneers[$a->id]}}</a></td>
                            <td>{{$types[$a->id]}}</td>
                            <td>${{number_format($a->minprice)}}</td>
                            <td>${{number_format($a->bid)}}</td>
                            <td><p id="demo{{$loop->iteration}}"></p></td>
                            <td>
                                {!! Form::open(['route' => ['auction.bid'], 'method' => 'post', 'class' => 'form-inline']) !!}
                                {!! Form::hidden("id", $a->id) !!}
                                    <input type="number" class="form-control" placeholder="Amount" id="offer" name="amount">
                                    <button type="submit" class="btn btn-default">Bid</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

