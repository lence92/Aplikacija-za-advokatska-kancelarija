@extends('layouts.app')

@section('content')

    <style type="text/css">
        table {
            border-collapse: separate;
            border-spacing: 15px 30px;
        }
    </style>
    <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-body" id="pozadina">
                    <h2 style="padding-left: 85px;">
                        Профил
                    </h2>
                    <br/>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3" style="padding-left: 85px;">
                                <img src="{{ url($user->image) }}" style="width:150px; height:190px;" id="profile-image" class="img-thumbnail">
                            </div>
                            <div class="col-md-6" style="margin-bottom: 30px">
                                <h2>
                                    {{ $user->name }}
                                    @if($user->role == 'admin' || $user->role == 'partner')
                                        <small>партнер</small>
                                    @elseif($user->role == 'lawyer')
                                        <small>адвокат</small>
                                    @elseif($user->role == 'paralegal')
                                        <small>правник</small>
                                    @endif
                                </h2>

                                <i>{{ $user->email }}</i>
                                <br/>
                                <div style="padding-top: 15px; font-size: 16px; margin-left: -10px">
                                    <table>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-353-nameplate.png') }}"/> ID на вработен:</td>
                                            <td>{{ $user->employee_id }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-342-briefcase.png') }}"/> Канцеларија:</td>
                                            @if($user->office == "office1")
                                                <td>Канцеларија 1</td>
                                            @else
                                                <td>Канцеларија 2</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-46-calendar.png') }}"/> Датум на вработување:</td>
                                            <td>{{ $user->hire_date }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-46-calendar.png') }}"/> Датѕм на раѓање:</td>
                                            <td>{{ $user->birth_date }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-443-earphone.png') }}"/> Телефонски број:</td>
                                            <td>{{ substr($user->phone_number, 0,2)."/".substr($user->phone_number,2,3)."-".substr($user->phone_number, 5, 3) }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-89-address-book.png') }}"/> Адреса:</td>
                                            <td>{{ $user->adress }}</td>
                                        </tr>

                                    </table>
                                </div>
                                <br/>
                                @if(Auth::user()->id == $user->id)
                                <a href="{{ url('/editProfile') }}" style="background-color: #bbbbbb; padding: 10px; border-radius: 4px">Ажурирај профил</a>
                                @endif
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>

@endsection