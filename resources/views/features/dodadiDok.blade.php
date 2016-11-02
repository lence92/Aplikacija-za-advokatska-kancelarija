<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/29/2016
 * Time: 1:39 PM
 */?>
@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-body" style="font-family: Cursive;">
                        <h2 style="text-align: center; padding-bottom: 30px">Додади документ</h2>
                        <form action="{{ url('/zacuvajDokument') }}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                            {{ csrf_field() }}


                            <br/>
                            <div class="form-group{{ $errors->has('predmet') ? ' has-error' : '' }}">
                                <label for="predmet" class="col-md-3 control-label"><img src="{{ url('image/Iconsmind-Outline-ID-3.ico') }}" width="25" height="25"></label>

                                <div class="col-md-6">
                                    <select name="predmet" value="{{ old('predmet') }}" id="predmet" class="form-control">
                                        <option value="">Избери бр. на предмет: </option>
                                        @foreach($cases as $case)
                                            @if(Auth::user()->role == 'paralegal')
                                                <option value="{{ $case->broj_na_predmet }}">{{ $case->broj_na_predmet }}</option>
                                            @else
                                                @if($case->user_id == Auth::user()->id)
                                                    <option value="{{ $case->broj_na_predmet }}">{{ $case->broj_na_predmet }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('predmet'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('predmet') }}</strong>
                                    </span>
                                    @endif
                                    @if(Session::get('porakaPredmet'))
                                        <span class="text-danger">
                                            <strong>{{ Session::get('porakaPredmet') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <br/>
                            <br/>

                            <div class="form-group{{ $errors->has('fileToUpload') ? ' has-error' : '' }}">
                                <label for="predmet" class="col-md-3 control-label"><img src="{{ url('image/paperclip.png') }}" width="25" height="25"></label>
                                
                                <div class="col-md-6">
                                    Select file to upload:
                                    <input type="file" name="fileToUpload" id="fileToUpload" class=form-control">

                                    @if ($errors->has('fileToUpload'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fileToUpload') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <br/>
                            <br/>
                            <br/>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" name="submit">
                                        <i class="glyphicon glyphicon-floppy-save"></i> Upload File
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
