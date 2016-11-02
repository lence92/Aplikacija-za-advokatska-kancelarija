<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/5/2016
 * Time: 5:21 PM
 */?>
@extends('layouts.app')

@section('content')
    <style>
        table {
            border-collapse: separate;
            border-spacing: 10px 15px;
        }
    </style>
    <div class="col-md-11">
        <div class="panel panel-default">
            <div class="panel-body" id="pozadina2">
                <form action="{{ url('/setEmployee/'. $user->id) }}" method="post" style="margin: 0 80px" class="form-horizontal">
                    {{ csrf_field() }}

                    <h2>
                        Ажурирај профил на вработен
                    </h2>
                    <br/>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3" style="margin-left: -45px; margin-top: -20px">
                                <table>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-11-envelope.png') }}"/><br/>Емаил:</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="email" value="{{ $user->email }}" class="form-control" name="email">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-353-nameplate.png') }}"/><br/>ID на вработен</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                                            <input type="text" name="employee_id" class="form-control" value="{{ $user->employee_id }}">

                                            @if ($errors->has('employee_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-342-briefcase.png') }}"/><br/>Канцеларија:</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('office') ? ' has-error' : '' }}">
                                            <select name="office" class="form-control">
                                                @if($user->office == "office1")
                                                <option value="office1" selected>Канцеларија 1</option>
                                                <option value="office2">Канцеларија 2</option>
                                                @else
                                                    <option value="office1">Канцеларија 1</option>
                                                    <option value="office2" selected>Канцеларија 2</option>
                                                @endif
                                            </select>

                                            @if ($errors->has('office'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('office') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3" style="margin-top: -20px">
                                <table>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-46-calendar.png') }}"/><br/>Датум на вработување</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('hire_date') ? ' has-error' : '' }}">
                                            <input type="date"  name="hire_date" class="form-control" value="{{ $user->hire_date }}">

                                            @if ($errors->has('hire_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hire_date') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="glyphicon glyphicon-pencil"></i><br/>Улога:</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                            <select name="role" class="form-control">
                                                @if($user->role == "lawyer")
                                                    <option value="partner">Партнер</option>
                                                    <option value="lawyer" selected>Адвокат</option>
                                                    <option value="paralegal">Правник</option>
                                                @elseif($user->role == 'paralegal')
                                                    <option value="partner">Партнер</option>
                                                    <option value="lawyer">Адвокат</option>
                                                    <option value="paralegal" selected>Правник</option>
                                                @else
                                                    <option value="partner" selected>Партнер</option>
                                                    <option value="lawyer">Адвокат</option>
                                                    <option value="paralegal">Правник</option>
                                                @endif
                                            </select>

                                            @if ($errors->has('role'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-3">
                                <br/>
                                <input type="submit" name="submit" value="Save Changes" class="btn btn-info">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
