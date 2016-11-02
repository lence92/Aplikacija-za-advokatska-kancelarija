@extends('layouts.app')

@section('content')
    <style>
        .btn{
            background-color: #4EB1BA;
            color: #222930;
        }

    </style>
<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body" id="logoPozadina">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/createUser') }}" style="padding-top: 140px;">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label"><i class="glyphicon glyphicon-user"></i></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" style="border: 0;" placeholder="Име">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label"><i class="glyphicon glyphicon-envelope"></i></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="border: 0;" placeholder="Емаил">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-3 control-label"><i class="glyphicon glyphicon-pencil"></i></label>

                            <div class="col-md-6">
                                <select name="role" value="{{ old('role') }}" id="role" class="form-control">
                                    <option value="">Избери работна улога:</option>
                                    <option value="partner">Партнер</option>
                                    <option value="lawyer">Адвокат</option>
                                    <option value="paralegal">Правник</option>
                                </select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                            <label for="employee_id" class="col-md-3 control-label"><i class="glyphicon glyphicon-duplicate"></i></label>

                            <div class="col-md-6">
                                <input type="text" value="{{ old('employee_id') }}" class="form-control" name="employee_id" style="border: 0;" placeholder="ID на вработен">

                                @if ($errors->has('employee_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('employee_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('office') ? ' has-error' : '' }}">
                            <label for="office" class="col-md-3 control-label"><i class="glyphicon glyphicon-briefcase"></i></label>

                            <div class="col-md-6">
                                <select name="office" value="{{ old('office') }}" id="office" class="form-control">
                                    <option value="">Избери канцеларија: </option>
                                    <option value="office1">Канцеларија Карпош</option>
                                    <option value="office2">Канцеларија Центар</option>
                                </select>

                                @if ($errors->has('office'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('office') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hire_date') ? ' has-error' : '' }}">
                            <label for="hire_date" class="col-md-3 control-label"><i class="glyphicon glyphicon-calendar"></i><br/><span style="font-size: 10px">Датум на враб.</span></label>

                            <div class="col-md-6">
                                <input type="date" value="{{ old('hire_date') }}" class="form-control" name="hire_date" style="border: 0;">

                                @if ($errors->has('hire_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hire_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label"><i class="glyphicon glyphicon-lock"></i></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" style="border: 0;" placeholder="Лозинка">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-3 control-label"><i class="glyphicon glyphicon-lock"></i></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" style="border: 0;" placeholder="Потврди лозинка">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" value="image/anonymous-profile.png" name="image">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn" style="width: 150px">
                                     Додади корисник
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
