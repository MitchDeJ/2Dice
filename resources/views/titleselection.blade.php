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
                        <?php $unlockedtitles = unserialize($user->unlockedtitles);?>
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
                                    {!! Form::open(['route' => ['title.clear'], 'method' => 'post']) !!}
                                    <button type="submit" class="btn btn-secondary">Clear</button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @for($i = 0; $i < $titlecount; $i++)
                        <tr>
                            <td>
                                <strong style="color:{{Titles::getTitleColor($i)}}">{{Titles::getTitle($i)}}</strong>
                            </td>
                            <td>
                                {{Titles::getTitleDesc($i)}}
                            </td>
                            <td>
                                <div class="form-inline">
                                    @if ($unlockedtitles[$i] == 0)
                                        {!! Form::open(['route' => ['title.unlock'], 'method' => 'post']) !!}
                                        {!! Form::hidden("i", $i) !!}
                                    <button type="submit" class="btn btn-default">Unlock</button>
                                        @else
                                        {!! Form::open(['route' => ['title.set'], 'method' => 'post']) !!}
                                        {!! Form::hidden("i", $i) !!}
                                        <button type="submit" class="btn btn-default">Activate</button>
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            </td>
                        </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


