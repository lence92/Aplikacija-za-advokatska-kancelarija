<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/29/2016
 * Time: 4:42 PM
 */?>
@extends('layouts.app')

@section('content')
    <style>
        input[type="text"], input[type="number"]{
            color: #707487;
        }

        #osnov{
            color: #707487;
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
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="padding-top: 120px; padding-bottom: 5%; padding-left: 5%">
                            <h3 style="text-align: center"><img src="{{ url('image/case_update.png') }}" width="80" height="90"></h3>
                            <h2 style="font-family:Palatino Linotype; color: #707487; text-align: center; padding-bottom: 30px">Ажурирај предмет</h2>
                            <form class="form-horizontal" role="form" method="post" action="{{ url('/updateCase/'.$case->id) }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('br_predmet') ? ' has-error' : '' }}">
                                    <label for="br_predmet" class="col-md-3 control-label"><i class="glyphicon glyphicon-file"></i><br/>Бр. предмет</label>

                                    <div class="col-md-6">
                                        <input id="br_predmet" type="text" class="form-control" name="br_predmet" value="{{ $case->broj_na_predmet }}" style="border: 0;">

                                        @if ($errors->has('br_predmet'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('br_predmet') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('tuzitel') ? ' has-error' : '' }}">
                                    <label for="tuzitel" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i><br/>Тужител</label>

                                    <div class="col-md-6">
                                        <input id="tuzitel" type="text" class="form-control" name="tuzitel" value="{{ $case->tuzitel }}" style="border: 0;">

                                        @if ($errors->has('tuzitel'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('tuzitel') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('tuzen') ? ' has-error' : '' }}">
                                    <label for="tuzen" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i><br/>Тужен</label>

                                    <div class="col-md-6">
                                        <input id="tuzen" type="text" class="form-control" name="tuzen" value="{{ $case->tuzen }}" style="border: 0;">

                                        @if ($errors->has('tuzen'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('tuzen') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('osnov') ? ' has-error' : '' }}">
                                    <label for="osnov" class="col-md-3 control-label"><i class="glyphicon glyphicon-folder-open"></i><br/>Основ</label>

                                    <div class="col-md-6">
                                        <textarea style="border: 0;" rows="8" class="form-control" name="osnov" id="osnov">{{ $case->osnov }}</textarea>

                                        @if ($errors->has('osnov'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('osnov') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('vrednost') ? ' has-error' : '' }}">
                                    <label for="vrednost" class="col-md-3 control-label"><i class="glyphicon glyphicon-euro"></i><br/>Вредност</label>

                                    <div class="col-md-6">
                                        <input id="vrednost" type="number" class="form-control" name="vrednost" value="{{ $case->vrednost }}" style="border: 0;">

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
                                        <input id="sudija" type="text" class="form-control" name="sudija" value="{{ $case->sudija }}" style="border: 0;">

                                        @if ($errors->has('sudija'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('sudija') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('protivnik') ? ' has-error' : '' }}">
                                    <label for="protivnik" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i><br/>Адвокат<br/>од др. страна</label>

                                    <div class="col-md-6">
                                        <input id="protivnik" type="text" class="form-control" name="protivnik" value="{{ $case->advokat_dr_strana }}" style="border: 0;">

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
                                                @if($user->role == 'partner' || $user->role == 'lawyer' || $user->role == 'admin')
                                                    <?php $u = 0;?>
                                                    @foreach($permiss as $perm)
                                                        @if($perm->user_id == $user->id)
                                                            <input type="checkbox" name="permissions[]" value="{{ $user->name }}" checked>{{ $user->name }}<br/>
                                                            <?php $u = 1; ?>
                                                        @endif
                                                    @endforeach
                                                    @if($u == 0)
                                                       <input type="checkbox" name="permissions[]" value="{{ $user->name }}">{{ $user->name }}<br/>
                                                    @endif
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
                                    <div class="col-md-6 col-md-offset-4" style="padding-top: 55px">
                                        <button type="submit" class="btn" style="width: 150px">
                                            Зачувај промени
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
