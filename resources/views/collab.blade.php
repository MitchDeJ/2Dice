<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 4-11-2017
 * Time: 20:03
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Collaboration</div>
            <div class="card-body">
                <button type="submit" class="btn btn-default">Start a new collab</button>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Host</td>
                            <td class="table_dark_bg" style="width: 10%;">Players</td>
                            <td class="table_dark_bg" style="width: 1%;">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                Host name
                            </td>
                            <td>
                                Joined player(s)
                            </td>
                            <td>
                                <button type="submit" class="btn btn-default">Join</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-default">Cancel collaboration</button>
                <button type="submit" class="btn btn-default">Leave collaboration</button>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Players</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                {{Auth::user()->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Waiting for player
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Waiting for player
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <p>There are currently no collab groups available.</p>

            </div>
        </div>
    </div>
@endsection
