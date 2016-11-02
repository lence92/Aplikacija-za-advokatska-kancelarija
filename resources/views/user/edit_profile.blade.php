<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 8/8/2016
 * Time: 9:03 PM
 */?>
@extends('layouts.app')

@section('content')

    <style>
        #profile-image:hover{
            cursor: pointer;
        }
        .image {
            position: relative;
        }
        .image span{
            position: absolute;
            top: 160px;
            left: 20px;
            width: 100%;
            display: none;
        }
        #profile-image:hover +  span
        {
            display: block;
        }


        table {
            border-collapse: separate;
            border-spacing: 10px 15px;
        }
    </style>
    <div class="col-md-11">
        <div class="panel panel-default">
            <div class="panel-body" id="pozadina2">
                <form action="{{ url('/setProfile') }}" method="post" class="form-horizontal" enctype="multipart/form-data" style="margin: 0 80px">
                    {{ csrf_field() }}

                    <h2>
                        Ажурирај профил
                    </h2>
                    <br/>
                    <input id="profile-image-upload" class="hidden" type="file" name="profile-image-upload" onchange="readURL(this);">
                    <div class="container">
                        <div class="row">
                            <div class="image col-md-3">
                                <img src="{{ $user->image }}" style="width:150px; height:190px;" id="profile-image" class="img-thumbnail">
                                <span style="color: #222930; width: 140px; background: rgba(204, 204, 204, 0.5);">Промени профил слика</span>
                            </div>
                            <div class="col-md-3" style="margin-left: -45px; margin-top: -20px">
                                @if(Auth::user()->is_admin())
                                    <table>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Име:</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <input type="text" value="{{ $user->name }}" name="name" class="form-control">

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-11-envelope.png') }}"/><br/>Емаил:</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <input type="email" value="{{ $user->email }}" name="email" class="form-control">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-204-lock.png') }}"/><br/>Лозинка:</td>
                                            <td><a href="{{ url('/editPassword') }}">Ажурирај лозинка</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-353-nameplate.png') }}"/><br/>ID на вработен</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                                                <input type="text" name="employee_id" value="{{ $user->employee_id }}" class="form-control">

                                                @if ($errors->has('employee_id'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-342-briefcase.png') }}"/><br/>Канцела-<br/>рија</td>
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
                                @else
                                    <table>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Име:</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <input type="text" value="{{ $user->name }}" name="name" class="form-control">

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-11-envelope.png') }}"/><br/>Емаил:</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <input type="email" value="{{ $user->email }}" name="email" class="form-control">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-46-calendar.png') }}"/><br/>Датум на раѓање</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                                                <input type="date" name="birth_date" value="{{ $user->birth_date }}" class="form-control">

                                                @if ($errors->has('birth_date'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-443-earphone.png') }}"/><br/>Телефонски број:</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                <input type="text" value="{{ $user->phone_number }}" name="phone_number" class="form-control">

                                                @if ($errors->has('phone_number'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-89-address-book.png') }}"/><br/>Адреса:</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}">
                                                <input type="text"  name="adress" value="{{ $user->adress }}" class="form-control">

                                                @if ($errors->has('adress'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('adress') }}</strong>
                                                </span>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                @endif

                            </div>
                            <div class="col-md-3" style="margin-top: -20px">
                                @if(Auth::user()->is_admin())
                                <table>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-443-earphone.png') }}"/><br/>Телефонски број:</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                            <input type="text" value="{{ $user->phone_number }}" name="phone_number" class="form-control">

                                            @if ($errors->has('phone_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-89-address-book.png') }}"/><br/>Адреса:</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}">
                                            <input type="text"  name="adress" value="{{ $user->adress }}" class="form-control">

                                            @if ($errors->has('adress'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('adress') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-46-calendar.png') }}"/><br/>Датум на вработување</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('hire_date') ? ' has-error' : '' }}">
                                            <input type="date"  name="hire_date" value="{{ $user->hire_date }}" class="form-control">

                                            @if ($errors->has('hire_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hire_date') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-46-calendar.png') }}"/><br/>Датум на раѓање</td>
                                        <td>
                                            <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                                            <input type="date" name="birth_date" value="{{ $user->birth_date }}" class="form-control">

                                            @if ($errors->has('birth_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                    <div style="margin-top: 45px; margin-left: 60px">
                                        <img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-204-lock.png') }}"/> Лозинка:
                                        <a href="{{ url('/editPassword') }}">Ажурирај лозинка</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 30px">
                            <div class="col-md-offset-4 col-md-3">
                                <br/>
                                <input type="submit" name="submit" value="Зачувај промени" class="btn" style="background-color: #bbbbbb; color: #327dfc;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#profile-image').on('click', function() {
            $('#profile-image-upload').click();
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-image')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

