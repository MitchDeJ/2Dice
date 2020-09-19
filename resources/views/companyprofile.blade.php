<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 10-11-2017
 * Time: 16:53
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-building i_button_background"></i> {{$company->name}}@if($mycompany == $company->id) | <a
                        class="text-dark" href="{{url("/editcompanyprofile")}}">Edit profile</a>@endif</div>
            <div class="card-body">
                <img src="{!! url("/companyimg/".$company->avatar) !!}" width="200px" height="200px" class="img-thumbnail"
                     style="display: block; margin: auto; margin-bottom: 1%">
                <h4 class="text-center">{{$company->name}}</h4>

                @if($mycompany == -1 && $pending == false)
                    {!! Form::open(['route' => ['company.joinrequest'], 'method' => 'post']) !!}
                    {!! Form::hidden("id", $company->id) !!}
                    <br>
                    <button style="display: block;margin: auto;" class="btn btn-success">Send join request</button>
                    {!! Form::close() !!}
                    @elseif ($mycompany == -1 && $pending == true)
                    <br>
                    <p class="text-center">Join request pending...</p>
                @endif
                @if ($mycompany == $company->id && $company->owner != $user->name)
                    <p class="text-center">If you want to leave this company, you can press the 'Leave' button below to do so.</p>
                    <form class="text-center" action="{{ route('company.leave') }}" method="post">
                        {{csrf_field()}}
                        <button  type="submit" class="btn btn-danger">Leave</button>
                    </form>
                @endif

                <div class="form-group">
                    <br>
                    <textarea class="form-control text-center" id="about_area" rows="6"
                              disabled>{{$company->desc}}</textarea>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">Company status</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i class="fa fa-trophy i_button_background"></i>
                                        Position
                                    </td>
                                    <td>
                                        #{{$rank}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-star i_button_background"></i>
                                        Level
                                    </td>
                                    <td>
                                        {{$company->level}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-rocket i_button_background"></i>
                                        Total power
                                    </td>
                                    <td>
                                        {{number_format($totalpower)}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="table_dark_bg" style="width: 50%;">Company information</td>
                                    <td class="table_dark_bg" style="width: 50%;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i class="fa fa-suitcase i_button_background"></i>
                                        Owner
                                    </td>
                                    <td>
                                        <a href="{{url("/profile/".$company->owner)}}" class="text-dark">{{$company->owner}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-calendar-check-o i_button_background"></i>
                                        Created
                                    </td>
                                    <td>
                                        {{$company->createdat}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-plane i_button_background"></i>
                                        Location
                                    </td>
                                    <td>
                                        {{$location}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 10%;">Position</td>
                            <td class="table_dark_bg" style="width: 30%;">Members</td>
                            <td class="table_dark_bg" style="width: 30%;">Role</td>
                            <td class="table_dark_bg" style="width: 30%;">Power</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>#{{$ranks[$member->id]}}</td>
                            <td><a href="{{url("/profile/".$member->name)}}" class="text-dark">{{$member->name}}</a></td>
                            <td>{{ComAff::getRole($roles[$member->id])}}</td>
                            <td>{{number_format($member->power)}}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="table_dark_bg" style="width: 50%;">Factory</td>
                            <td class="table_dark_bg" style="width: 50%;">Level</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($factories as $factory)
                            <tr>
                                <td>{{$names[$factory->type]}}</td>
                                <td>{{$factory->level}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

