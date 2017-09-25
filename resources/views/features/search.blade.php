<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 11/3/2016
 * Time: 13:05
 */?>
<!-- Modal -->
<style>
    #modelSearch{
        overflow-y: initial !important;
        width: 900px;
    }
    #modelBodySearch{
        height: 450px;
        overflow-y: auto;
    }
</style>
<div class="modal fade" role="dialog" id="myModal">
    <div class="modal-dialog" id="modelSearch">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="margin-left: 50px">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Резултати од пребарувањето за „{{ Session::get('search') }}“</h3>
                <div class="modal-body" id="modelBodySearch">

                    @if(!empty(Session::get('data')))
                        <?php $data = Session::get('data');?>
                            @if(count($data['vraboteni']) > 0 || count($data['dokumenti']) > 0 || count($data['predmeti']) > 0)
                                <h4>Вработени:</h4>
                                @foreach($data['vraboteni'] as $vrab)
                                    <img src="{{ url($vrab->image) }}" width="40" height="40">
                                    <span style="font-size: 16px"><a href="{{ url('/profile/'.$vrab->id) }}">{{ $vrab->name }}</a></span>
                                    <div>Креирано на: {{ date_format($vrab->created_at, "m/d/Y H:i") }} &nbsp; &nbsp; Ажурирано на: {{ date_format($vrab->updated_at, "m/d/Y H:i") }}</div>
                                    <br/>
                                    <br/>
                                @endforeach
                            <hr>
                            <div>
                                <h4>Документи:</h4>
                                @foreach($data['dokumenti'] as $doc)

                                    @if(strstr($doc->file, '.png') != FALSE || strstr($doc->file, '.jpg') != FALSE)
                                        <img border="0" src="{{ url($doc->file) }}" title="{{ ltrim($doc->file, 'image/') }}" width="130" height="100" data-toggle="modal" data-target="#{{$doc->id}}search">
                                        <div>Креирано на: {{ date_format($doc->created_at, "m/d/Y H:i") }} &nbsp; &nbsp; Ажурирано на: {{ date_format($doc->updated_at, "m/d/Y H:i") }}</div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="{{$doc->id}}search" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" onclick="closePic({{$doc->id}}+'search')">&times;</button>
                                                        <h6 class="modal-title">{{ ltrim($doc->file, 'image/') }}</h6>
                                                        <div class="modal-body">
                                                            <?php list($width, $height, $type, $attr) = getimagesize($doc->file);?>
                                                            @if($width > 750)
                                                                <img border="0" src="{{ url($doc->file) }}" title="{{ ltrim($doc->file, 'image/') }}" height="350" width="500">
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
                                        <div>Креирано на: {{ date_format($doc->created_at, "m/d/Y H:i") }} &nbsp; &nbsp; Ажурирано на: {{ date_format($doc->updated_at, "m/d/Y H:i") }}</div>
                                    @endif
                                    <br/>
                                @endforeach
                            </div>

                            <hr>
                            <h4>Предмети:</h4>
                            @foreach($data['predmeti'] as $pred)
                                <a href="{{ url('/predmet/'.$pred->id) }}">Број на предмет: {{ $pred->broj_na_predmet }}</a>
                                <div>Креирано на: {{ date_format($pred->created_at, "m/d/Y H:i") }} &nbsp; &nbsp; Ажурирано на: {{ date_format($pred->updated_at, "m/d/Y H:i") }}</div>
                                <br/>
                            @endforeach
                        @else
                            Не се најдени разултати за {{ Session::get('search') }}!
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


@if(!empty(Session::get('search')))
    <script type="text/javascript">
        $(window).load(function(){
            $('#myModal').modal('show');
        });
    </script>
@endif
<script type="text/javascript">
    function closePic(model) {
        $("#"+model).modal("hide")
    }
</script>