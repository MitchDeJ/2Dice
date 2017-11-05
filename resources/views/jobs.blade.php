<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 5-11-2017
 * Time: 19:36
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-suitcase i_button_background"></i> Jobs</div>
                <div class="card-body">
                    <div class="form-group">
                        <p style="color: red;">You are currently unavailable to do a job. Try again in 69 seconds.</p>
                        <p>You are currently available to do a job.</p>
                        <label for="job1">Choose a job:</label>
                        <select class="form-check-inline" id="job1">
                            <option>Give a business proposal (earn more cash)</option>
                            <option>Give personal financial advice (earn more xp)</option>
                        </select>
                    <button type="submit" class="btn btn-default">Start job</button>
                        <p style="color: green;">You gained $100 and 100xp.</p>
                    </div>
                    <hr />

                    <div class="form-group">
                        <p style="color: red;">You are currently unavailable to do a job. Try again in 69 seconds.</p>
                        <p>You are currently available to do a job.</p>
                        <label for="job1">Choose a job:</label>
                        <select class="form-check-inline" id="job1">
                            <option>Give a business proposal (earn more cash)</option>
                            <option>Give personal financial advice (earn more xp)</option>
                        </select>
                        <button type="submit" class="btn btn-default">Start job</button>
                        <p style="color: green;">You gained $100 and 100xp.</p>
                    </div>
                    <hr />

                    <div class="form-group">
                        <p style="color: red;">You are currently unavailable to do a job. Try again in 69 seconds.</p>
                        <p>You are currently available to do a job.</p>
                        <label for="job1">Choose a job:</label>
                        <select class="form-check-inline" id="job1">
                            <option>Give a business proposal (earn more cash)</option>
                            <option>Give personal financial advice (earn more xp)</option>
                        </select>
                        <button type="submit" class="btn btn-default">Start job</button>
                        <p style="color: green;">You gained $100 and 100xp.</p>
                    </div>
                </div>
            </div>
        </div>
@endsection

