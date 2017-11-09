<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 9-11-2017
 * Time: 16:21
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i style="color: #f39c12;" class="fa fa-user"></i> Title selection | <a
                        class="text-dark" href="{{ url('/editprofile') }}"> Back
                </a></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Title</td>
                            <td class="table_dark_bg" style="width: 12%;">Description</td>
                            <td class="table_dark_bg" style="width: 1%;">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                Clear title
                            </td>
                            <td>
                                Removes your current title.
                            </td>
                            <td>
                                <div class="form-inline">
                                    <button type="submit" class="btn btn-secondary">Clear</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="form-inline">
                                    <button type="submit" class="btn btn-default">Unlock</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="form-inline">
                                    <button type="submit" class="btn btn-dark">Active</button>
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


