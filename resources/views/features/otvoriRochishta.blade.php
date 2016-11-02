<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 10/28/2016
 * Time: 4:55 PM
 */
?>
@extends('layouts.app')
@section('content')
    <style>

        .form-horizontal{
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 10px;
            padding-top: 35px;
            text-align: center;
            background-color: #e2e2e2;
            border: 1px solid #ccc;
            margin-top: 30px;
        }

        .ima-greshka{
            color: #d9534f;
            margin-left: 50px;
        }
    </style>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-xs-9 col-sm-10 col-md-11 col-lg-11">

                <h2 style="text-align: center"><img src="{{ url('image/judge-512.png') }}" width="50" height="50"><strong>Рочишта</strong></h2>
                <form role="form" class="form-horizontal" method="post" action="{{ url('/saveHearing') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="broj_predmet">Број на предмет:</label>
                        <select name="broj_na_predmet" id="broj_predmet" value="{{ old(('broj_na_predmet')) }}">
                            <option value="">Избери број на предмет:</option>
                            @foreach($br_predmeti as $br_pred)
                                @foreach($permiss as $perm)
                                    @if($perm->broj_na_predmet == $br_pred->broj_na_predmet)
                                        <option value="{{ $br_pred->broj_na_predmet }}">{{ $br_pred->broj_na_predmet }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>

                        <label for="datum">Датум:</label>
                        <input type="date" name="datum" id="datum" value="{{ old('datum') }}">

                        <label for="od">Од:</label>
                        <input type="time" name="od" id="od" value="{{ old('od') }}">

                        <label for="do">До:</label>
                        <input type="time" name="do" id="do" value="{{ old('do') }}">

                        <label for="sudnica">Судница:</label>
                        <input type="text" name="sudnica" id="sudnica" value="{{ old('sudnica') }}">

                        <input type="submit" value="Зачувај">
                        <br/>

                        @if ($errors->has('broj_na_predmet'))
                            <span class="ima-greshka">
                                <strong><small>{{ $errors->first('broj_na_predmet') }}</small></strong>
                            </span>
                        @endif
                        @if ($errors->has('od'))
                            <span class="ima-greshka">
                                <strong><small>{{ $errors->first('od') }}</small></strong>
                            </span>
                        @endif
                        @if ($errors->has('do'))
                            <span class="ima-greshka">
                                <strong><small>{{ $errors->first('do') }}</small></strong>
                            </span>
                        @endif
                        @if ($errors->has('sudnica'))
                            <span class="ima-greshka">
                                <strong><small>{{ $errors->first('sudnica') }}</small></strong>
                            </span>
                        @endif

                    </div>

                </form>

                <div style="margin-top: 50px;">
                    @if(!empty($hearings))
                        <table class="table">
                            <tr>
                                <th>Број на предмет:</th>
                                <th>Датум на рочиште:</th>
                                <th>Од час:</th>
                                <th>До час:</th>
                                <th>Во судница:</th>
                            </tr>
                            @foreach($hearings as $hearing)
                                @foreach($permiss as $perm)
                                    @if($hearing->broj_na_predmet == $perm->broj_na_predmet)
                                        <tr>
                                            <td>{{ $hearing->broj_na_predmet }}</td>
                                            <?php $date=date_create($hearing->datum); ?>
                                            <td>{{ date_format($date, "m/d/Y") }}</td>
                                            <td>{{ $hearing->od }}</td>
                                            <td>{{ $hearing->do }}</td>
                                            <td>{{ $hearing->sudnica }}
                                                @if($hearing->user_id == Auth::user()->id)
                                                    <a href="{{ url('/deleteHearing/'.$hearing->id) }}" style="padding-left: 40px;"><img src="{{ url('image/trash-icon.png') }}" width="20" height="20" title="Избриши"></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

