<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 7-11-2017
 * Time: 15:50
 */
?>
@if(Session::get('success'))
    <div id="succes" class="alert alert-success" align="center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
@if(Session::get('fail'))
    <div id="fail" class="alert alert-danger" align="center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('fail') }}</strong>
    </div>
@endif
@if(Session::get('neutral'))
    <div id="neutral" class="alert alert-info" align="center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ Session::get('neutral') }}</strong>
    </div>
@endif
@if(Session::get('roulette-result'))
    <div class="alert alert-info" align="center">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @if (Session::get('roulette-profit') > 0)
            <strong>The roulette wheel stops spinning at <strong style="background-color:{{ Session::get('roulette-color') }}; color:white">{{ Session::get('roulette-result')-1 }}</strong>, you made a profit of ${{ number_format(Session::get('roulette-profit')) }}</strong>
        @elseif (Session::get('roulette-profit') < 0)
            <strong>The roulette wheel stops spinning at <strong style="background-color:{{ Session::get('roulette-color') }}; color:white">{{ Session::get('roulette-result')-1 }}</strong>, you lost ${{ number_format((Session::get('roulette-profit')*-1)) }}</strong>
        @else
            <strong>The roulette wheel stops spinning at <strong style="background-color:{{ Session::get('roulette-color') }}; color:white">{{ Session::get('roulette-result')-1 }}</strong>, you broke even.</strong>
        @endif
    </div>
@endif
