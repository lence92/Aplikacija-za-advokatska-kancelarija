<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/8/2016
 * Time: 7:17 PM
 */?>
@extends('layouts.app')

@section('content')
    <style>
        .btn{
            background-color: #707487;
            color: #f5b464;
        }

        .selectMulti{
            border: solid 1px #bbbbbb;
            overflow-y: scroll;
            height: 80px;
            width: 300px;
            background-color: white;
        }
    </style>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="padding-top: 120px; padding-bottom: 10%; padding-left: 35%">
                            <img src="{{ url('image/Logomakr_0B9UQA.png') }}" width="60" height="70" style="margin-left: 90px">
                            <h2 style="font-family:Palatino Linotype; color: #707487">Додади предмет</h2>
                        </div>
                        <form class="form-horizontal" role="form" method="post" action="{{ url('/storeCase') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('broj_na_predmet') ? ' has-error' : '' }}">
                                <label for="broj_na_predmet" class="col-md-3 control-label"><i class="glyphicon glyphicon-file"></i></label>

                                <div class="col-md-6">
                                    <input id="broj_na_predmet" type="text" class="form-control" name="broj_na_predmet" value="{{ old('broj_na_predmet') }}" style="border: 0;" placeholder="Број на предмет">

                                    @if ($errors->has('broj_na_predmet'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('broj_na_predmet') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tuzitel') ? ' has-error' : '' }}">
                                <label for="tuzitel" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i></label>

                                <div class="col-md-6">
                                    <input id="tuzitel" type="text" class="form-control" name="tuzitel" value="{{ old('tuzitel') }}" style="border: 0;" placeholder="Тужител">

                                    @if ($errors->has('tuzitel'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tuzitel') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tuzen') ? ' has-error' : '' }}">
                                <label for="tuzen" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i></label>

                                <div class="col-md-6">
                                    <input id="tuzen" type="text" class="form-control" name="tuzen" value="{{ old('tuzen') }}" style="border: 0;" placeholder="Тужен">

                                    @if ($errors->has('tuzen'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tuzen') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('osnov') ? ' has-error' : '' }}">
                                <label for="osnov" class="col-md-3 control-label"><i class="glyphicon glyphicon-folder-open"></i></label>

                                <div class="col-md-6">
                                    <textarea placeholder="Основ..." style="border: 0;" rows="8" class="form-control" name="osnov" id="osnov">{{ old('osnov') }}</textarea>

                                    @if ($errors->has('osnov'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('osnov') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('vrednost') ? ' has-error' : '' }}">
                                <label for="vrednost" class="col-md-3 control-label"><i class="glyphicon glyphicon-euro"></i></label>

                                <div class="col-md-6">
                                    <input id="vrednost" type="number" class="form-control" name="vrednost" value="{{ old('vrednost') }}" style="border: 0;" placeholder="Вредност">

                                    @if ($errors->has('vrednost'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('vrednost') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('sudija') ? ' has-error' : '' }}">
                                <label for="sudija" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i></label>

                                <div class="col-md-6">
                                    <input id="sudija" type="text" class="form-control" name="sudija" value="{{ old('sudija') }}" style="border: 0;" placeholder="Судија">

                                    @if ($errors->has('sudija'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sudija') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('protivnik') ? ' has-error' : '' }}">
                                <label for="protivnik" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i></label>

                                <div class="col-md-6">
                                    <input id="protivnik" type="text" class="form-control" name="protivnik" value="{{ old('protivnik') }}" style="border: 0;" placeholder="Адвокат од другата страна?">

                                    @if ($errors->has('protivnik'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('protivnik') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                                <label for="permissions" class="col-md-3 control-label"><img src="{{ url('image/family-silhouette.png') }}"/><br/><span style="font-size: 10px">Кој може да го<br/>гледа предметот?</span></label>

                                <div class="col-md-6">
                                    <div class="selectMulti">
                                        @foreach($users as $user)
                                            @if($user->name != Auth::user()->name && ($user->role == 'partner' || $user->role == 'lawyer' || $user->role == 'admin'))
                                            <input type="checkbox" name="permissions[]" value="{{ $user->name }}">{{ $user->name }}<br/>
                                            @endif
                                        @endforeach
                                    </div>

                                    @if ($errors->has('permissions'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('permissions') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn" style="width: 150px">
                                        Додади предмет
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
