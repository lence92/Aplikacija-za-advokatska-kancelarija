<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/29/2016
 * Time: 12:41 PM
 */?>
@extends('layouts.app')

@section('content')

    <style>
        #dodadi{
            border: none;
            padding-right: 10px;
            padding-left: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: #cdcdcd;
        }
        #dodadi:hover{
            background-color: #bbbbbb;
        }
        body .modal{
            margin-top: 70px;
        }
        body .modal-dialog{
            width: 800px;
            text-align: center;
        }

        #privilegii{
            background-color: #333b44;
            color:aliceblue;
            width: 150px;
            padding: 5px;
            border-radius: 4px;
            box-shadow:inset 0 0 10px #000000;
        }
    </style>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-md-11">
                <div>
                    <div  style="font-family: Cursive; margin-bottom: 60px;">
                        <h2 style="text-align: left; padding-top: 35px; padding-left: 30px; padding-bottom: 25px;"><img src="{{ url('image/datoteka.png') }}" width="50" height="50">Документи:</h2>
                        <h5 style="text-align: right;"><button id="dodadi"  onclick="location.href='{{ url('/dodadiDokument') }}'"><img src="{{ url('image/app_doc.png') }}" width="17" height="17"> Додади документ</button></h5>
                        <table class="table">
                            <tr>
                                <th>Број на предмет:</th>
                                <th>Документ:</th>
                                {{--<th>Привилегии за бришење:</th>--}}
                            </tr>
                        @foreach($docs as $doc)
                            @foreach($cases as $case)
                                @if($doc->case_id == $case->id)
                                        <tr>
                                            <td>{{ $case->broj_na_predmet }}</td>
                                            <td>
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
                                                <a href="{{ url($doc->file) }}">
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


                                                <a href="{{ url('/izbrisi_dokument/'.$doc->id) }}" style="padding-left: 40px;"><img src="{{ url('image/trash-icon.png') }}" width="20" height="20" title="Избриши"></a>
                                            </td>

                                @endif
                            @endforeach
                                            {{--<td>--}}
                                                {{--<div id="privilegii">--}}
                                                    {{--@foreach($users as $user)--}}
                                                        {{--@if($permiss->count() > 0)--}}
                                                            {{--@foreach($permiss as $perm)--}}
                                                                {{--@if($perm->doc_id == $doc->id && $perm->user_id == $user->id)--}}
                                                                    {{--<input type="checkbox" id="{{ $user->id . $doc->id }}" checked onchange="privilegii('{{ $user->id }}', '{{ $doc->id }}')">--}}
                                                                    {{--<label for="{{ $user->id . $doc->id }}">{{ $user->name }}</label>--}}
                                                                    {{--<br/>--}}
                                                                {{--@else--}}
                                                                    {{--<input type="checkbox" id="{{ $user->id . $doc->id }}" onchange="privilegii('{{ $user->id }}', '{{ $doc->id }}')">--}}
                                                                    {{--<label for="{{ $user->id . $doc->id }}">{{ $user->name }}</label>--}}
                                                                    {{--<br/>--}}
                                                                {{--@endif--}}
                                                            {{--@endforeach--}}
                                                        {{--@else--}}
                                                            {{--<input type="checkbox" id="{{ $user->id . $doc->id }}" onchange="privilegii('{{ $user->id }}', '{{ $doc->id }}')">--}}
                                                            {{--<label for="{{ $user->id . $doc->id }}">{{ $user->name }}</label>--}}
                                                            {{--<br/>--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                        </tr>
                        @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function privilegii(id, $doc) {
            document.location.href="http://localhost/PhpstormProjects/webAppDip/public/privilegii/"+id+"/"+$doc;
        }
    </script>
@endsection
