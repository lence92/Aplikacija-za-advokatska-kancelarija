<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/27/2016
 * Time: 1:07 PM
 */?>
@extends('layouts.app')

@section('content')
    <style>
        body .modal{
            margin-top: 70px;
        }
        body .modal-dialog{
            width: 800px;
            text-align: center;
        }
    </style>
    <div class="container-fluid" style="padding-top: 20px">
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-body" style="font-family: Cursive;">
                        @if(!empty(Session::get('permiss')) || (empty(Session::get('permiss')) && (Auth::user()->role =='admin' || Auth::user()->role=='paralegal')))
                        <h2 style="padding-top: 35px; padding-left: 30px; padding-bottom: 25px; text-align: center">Број на предмет: {{ $case->broj_na_predmet }}</h2>
                        <div style="margin-left: 60px; margin-right: 60px">
                            <table class="table">
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Тужител</td>
                                    <td>{{ $case->tuzitel }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Тужен</td>
                                    <td>{{ $case->tuzen }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-539-invoice.png') }}"/><br/>Основ</td>
                                    <td><p>{{ $case->osnov }}</p></td>
                                </tr>
                                <tr>
                                    <td><i class="glyphicon glyphicon-euro"></i><br/>Вредност</td>
                                    <td>{{ $case->vrednost }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-643-judiciary.png') }}"/><br/>Судија</td>
                                    <td>{{ $case->sudija }}</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-622-businessman.png') }}"/><br/>Адвокат од другата страна</td>
                                    <td>{{ $case->advokat_dr_strana }}</td>
                                </tr>
                                <tr>
                                    <td>Документи:</td>
                                    <td style="padding-top: 20px; padding-left: 15px">
                                        @if(!empty($docs))
                                            @foreach($docs as $doc)

                                                @if(strstr($doc->file, '.png') != FALSE || strstr($doc->file, '.jpg') != FALSE)
                                                    <img border="0" src="{{ url($doc->file) }}" title="{{ ltrim($doc->file, 'image/') }}" width="130" height="100" data-toggle="modal" data-target="#{{$doc->id}}">

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="{{$doc->id}}" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h6 class="modal-title">{{ ltrim($doc->file, 'image/') }}</h6>
                                                                    <div class="modal-body">
                                                                        <?php list($width, $height, $type, $attr) = getimagesize($doc->file);?>
                                                                        @if($width > 750)
                                                                            <img border="0" src="{{ url($doc->file) }}" title="{{ ltrim($doc->file, 'image/') }}" height="350" width="750">
                                                                        @else
                                                                            <img border="0" src="{{ url($doc->file) }}" title="{{ ltrim($doc->file, 'image/') }}" height="350">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @else

                                                <a href="{{ url($doc->file) }}" download>
                                                    @if(strstr($doc->file, '.pdf') != FALSE)
                                                        <img border="0" src="{{ url('image/pdf_icon.png') }}" title="PDF" width="30" height="30">
                                                        {{ ltrim($doc->file, 'image/') }}
                                                    @elseif(strstr($doc->file, '.xls') != FALSE)
                                                        <img border="0" src="{{ url('image/Excel-Icon.png') }}" title="Excel" width="30" height="30">
                                                        {{ ltrim($doc->file, 'image/') }}
                                                    @elseif(strstr($doc->file, '.doc') != FALSE)
                                                        <img border="0" src="{{ url('image/word-file-icon-8.png') }}" title="Word" width="30" height="30">
                                                        {{ ltrim($doc->file, 'image/') }}
                                                    @else
                                                        <img border="0" src="{{ url('image/file-empty-256.png') }}" title="Непознато" width="30" height="30">
                                                        {{ ltrim($doc->file, 'image/') }}
                                                    @endif

                                                </a>
                                                @endif

                                                    @if($doc->user_id == Auth::user()->id || Auth::user()->is_admin())
                                                        <a href="{{ url('/izbrisi_dokument/'.$doc->id) }}" style="padding-left: 40px;"><img src="{{ url('image/trash-icon.png') }}" width="20" height="20" title="Избриши"></a>
                                                    @endif

                                                <br/><br/>
                                            @endforeach
                                        @endif
                                        <form action="{{ url('/uploadFile') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            Select image to upload:
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                            <input type="hidden" name="case_id" value="{{ $case->id }}">
                                            <input type="submit" value="Upload File" name="submit">
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
