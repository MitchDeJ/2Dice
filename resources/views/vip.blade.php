<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 8-11-2017
 * Time: 22:33
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-diamond i_button_background"></i> VIP</div>
            <div class="card-body">
                <p>You are currently
                    @if($user->vip == true)
                        a
                    @else
                        <b>not</b> a
                    @endif VIP. If you would like to donate to become a VIP, please click <a href="#" class="text-dark">here</a>.</p>

                <p>VIP will offer you the following:</p>
                <ul>
                    <li>
                        Orange color in the leaderboards.
                    </li>
                    <li>
                        Exclusive title in the title selection screen.
                    </li>
                    <li>
                        3 extra marketplace slots.
                    </li>
                    <li>
                        10 minute flight cooldown.
                    </li>
                    <li>
                        2 extra stock market companies.
                    </li>
                    <li>
                        2 extra VIP jobs.
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

