<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 10/4/2016
 * Time: 8:39 PM
 */?>
@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 style="font-family: Cursive; text-align: center; padding-top: 40px; padding-bottom: 40px"><img src="{{ url('image/Add_Tasks.png') }}" width="60" height="60"><br/>Додади задача</h3>
                        <form class="form-horizontal" role="form" method="post" action="{{ url('/storeTask') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('br_predmet') ? ' has-error' : '' }}">
                                <label for="br_predmet" class="col-md-3 control-label"><i class="glyphicon glyphicon-briefcase"></i></label>

                                <div class="col-md-6">
                                    <select name="br_predmet" value="{{ old('br_predmet') }}" id="br_predmet" class="form-control">
                                        <option value="">Избери број на предмет:</option>
                                        @foreach($cases as $case)
                                            @foreach($permiss as $perm)
                                                @if($case->broj_na_predmet == $perm->broj_na_predmet)
                                                    <option value="{{ $case->broj_na_predmet }}">{{ $case->broj_na_predmet }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>

                                    @if ($errors->has('br_predmet'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('br_predmet') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('den') ? ' has-error' : '' }}">
                                <label for="den" class="col-md-3 control-label"><i class="glyphicon glyphicon-calendar"></i><br/>Ден:</label>

                                <div class="col-md-6">
                                    <input type="date" value="{{ old('den') }}" class="form-control" name="den" style="border: 0;">

                                    @if ($errors->has('den'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('den') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('kade') ? ' has-error' : '' }}">
                                <label for="kade" class="col-md-3 control-label"><i class="glyphicon glyphicon-th-large"></i><br/>Каде:</label>

                                <div class="col-md-6">
                                    <input type="text" value="{{ old('kade') }}" class="form-control" name="kade" style="border: 0;" placeholder="пр. Пошта.">

                                    @if ($errors->has('kade'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kade') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('sto') ? ' has-error' : '' }}">
                                <label for="sto" class="col-md-3 control-label"><i class="glyphicon glyphicon-list-alt"></i><br/>Што:</label>

                                <div class="col-md-6">
                                    <input type="text" value="{{ old('sto') }}" class="form-control" name="sto" style="border: 0;" placeholder="пр. Да ја испратам поштата!">

                                    @if ($errors->has('sto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4" style="padding-top: 40px">
                                    <button type="submit" class="btn" style="width: 150px;">
                                        Додади задача
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
