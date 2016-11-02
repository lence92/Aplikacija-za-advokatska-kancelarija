<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 10/18/2016
 * Time: 6:07 PM
 */?>
<style>
    body .modal{
        margin-top: 70px;
    }
    body .modal-dialog{
        width: 800px;
        text-align: center;
    }
</style>
@if(!empty(Session::get('docs')))
    <?php $docs = Session::get('docs'); ?>
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

        @if($doc->user_id == Auth::user()->id ||  Auth::user()->is_admin())
            <a href="{{ url('/izbrisi_dokument/'.$doc->id) }}" style="padding-left: 40px;"><img src="{{ url('image/trash-icon.png') }}" width="20" height="20" title="Избриши"></a>
        @endif



        <br/><br/>
    @endforeach
@endif
<form action="{{ url('/uploadFile') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="case_id" value="{{ $pred->id }}">
    <input type="submit" value="Upload File" name="submit">
</form>
