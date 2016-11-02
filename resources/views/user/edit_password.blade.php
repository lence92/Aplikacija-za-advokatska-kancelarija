<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/4/2016
 * Time: 1:14 PM
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
            <form action="{{ url('/setPassword') }}" method="post" style="margin: 0 80px">
                {{ csrf_field() }}

                <h2>
                    Ажурирај лозинка
                </h2>
                <br/>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <table>
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-204-lock.png') }}"/><br/>Стара лозинка:</td>
                                    <td>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input type="password" name="password" class="form-control">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            @if(Session::get('greshka'))
                                                <span class="text-danger">
                                                    <strong>{{ Session::get('greshka') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-204-lock.png') }}"/><br/>Нова лозинка:</td>
                                    <td>
                                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                            <input type="password" name="new_password" class="form-control">

                                            @if ($errors->has('new_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-204-lock.png') }}"/><br/>Потврди лозинка:</td>
                                    <td>
                                        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                            <input type="password" name="confirm_password" class="form-control">

                                            @if ($errors->has('confirm_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('confirm_password') }}</strong>
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
                            <input type="submit" name="submit" value="Зачувај лозинка" class="btn" style="background-color: #bbbbbb; color: #327dfc;">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection