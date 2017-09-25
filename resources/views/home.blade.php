@extends('layouts.app')

@section('content')
    <style>
        .ui-datepicker{
            font-family:  Arial sans-serif;
            background: #333b44;
            color: #cdcdcd;
            height: auto;
        }
        .ui-widget-header{
            background: none;
            border: none;
            color: #cdcdcd;

        }

        .ui-datepicker .ui-datepicker-prev{
            background: #fff;

        }
        .ui-datepicker .ui-datepicker-next {
            background: #ffffff;

        }

        #calendar{
            padding-top: 180px;
            margin-left: 80px;
        }



        .close{
            width: 15px;
            height: 15px;
            margin-top: 5px;
            margin-right: 15px;
            margin-left: -15px;
        }

        #lista tr:nth-child(even){
            background-color: #cdcdcd;
        }
        #lista tr:nth-child(odd){
            background-color: #949494;
        }


         body .modal{
             margin-top: 70px;
         }
        body #modelHome{
            width: 800px;
            text-align: center;
        }

        #triDoc{
            background-color: #f4f4f4;
            border: 1px solid #cccccc;
            margin-top: 50px;
            margin-left: 75px;
        }

        #rocistaTabela{
            background-color: #e2e2e2;
            border: 1px solid #ccc;
            margin-top: 80px;
        }

    </style>
    <div class="container-fluid">
        <div class="row" >
            <div class="col-md-8" style="padding-left: 80px; padding-right: 50px;">
                <br/>
                <h1 style="font-family: Cursive; text-align: center; padding-top: 40px;">Листа на задачи по предмети</h1>
                <br/>
                <table class="table" id="lista">
                    <tr style="background-color: #333b44; color: #cdcdcd">
                        <th> </th>
                        <th>Број на предмет:</th>
                        <th>Ден:</th>
                        <th>Каде:</th>
                        <th>Што:</th>
                        <th> </th>
                    </tr>

                    @if(!empty($aktivnosti))
                        @foreach($aktivnosti as $aktiv)
                            <tr>
                                <td>
                                    @if($aktiv->shtiklirano == 1)
                                        <input type="checkbox" checked onchange="shtikliraj({{ $aktiv->id }})">
                                    @else
                                        <input type="checkbox" onchange="shtikliraj({{ $aktiv->id }})">
                                    @endif
                                </td>

                                @foreach($cases as $case)
                                    @if($aktiv->case_id == $case->id)
                                        @if($aktiv->shtiklirano == 1)
                                        <td style="text-decoration: line-through;">{{$case->broj_na_predmet}}</td>
                                        @else
                                            <td style="text-decoration: none;">{{$case->broj_na_predmet}}</td>
                                        @endif
                                    @endif
                                @endforeach
                                @if($aktiv->shtiklirano == 1)
                                    <td style="text-decoration: line-through;">{{ $aktiv->den }}</td>
                                    <td style="text-decoration: line-through;">{{ $aktiv->kade }}</td>
                                    <td style="text-decoration: line-through;">{{ $aktiv->sto }}</td>
                                @else
                                    <td style="text-decoration: none;">{{ $aktiv->den }}</td>
                                    <td style="text-decoration: none;">{{ $aktiv->kade }}</td>
                                    <td style="text-decoration: none;">{{ $aktiv->sto }}</td>
                                @endif
                                <td><a href="{{ url('/deleteShtiklirno/'.$aktiv->id) }}"><img src="{{ url('image/exit.png') }}" class="close"></a></td>
                            </tr>
                        @endforeach
                    @endif
                </table>

                <div id="rocistaTabela">
                    <h3><img src="{{ url('image/judge-512.png') }}" width="30" height="30">Закажани рочишта за денес</h3>
                    <table class="table" style="margin-top: 30px;">
                        @if(Auth::user()->role == 'paralegal')
                            @foreach($rocista_denes as $rociste)
                                <tr>
                                    <td>{{ $rociste->broj_na_predmet }}</td>
                                    <?php $date=date_create($rociste->datum); ?>
                                    <td>{{ date_format($date, "m/d/Y") }}</td>
                                    <td>{{ $rociste->od }}</td>
                                    <td>{{ $rociste->do }}</td>
                                    <td>{{ $rociste->sudnica }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($rocista_denes as $rociste)
                                @foreach($permiss as $perm)
                                    @if($rociste->broj_na_predmet == $perm->broj_na_predmet)
                                        <tr>
                                            <td>{{ $rociste->broj_na_predmet }}</td>
                                            <?php $date=date_create($rociste->datum); ?>
                                            <td>{{ date_format($date, "m/d/Y") }}</td>
                                            <td>{{ $rociste->od }}</td>
                                            <td>{{ $rociste->do }}</td>
                                            <td>{{ $rociste->sudnica }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <div id="calendar" onchange="funk()"></div>

                <div id="triDoc">
                    <h3 style="text-align: center">Последните објавени документи:</h3>
                    <div style="margin-top: 30px;">
                        <ol>
                            @foreach($tri_doc as $doc)
                                @if(strstr($doc->file, '.png') != FALSE || strstr($doc->file, '.jpg') != FALSE)
                                    <li><img border="0" src="{{ url($doc->file) }}" title="{{ ltrim($doc->file, 'image/') }}" width="90" height="70" data-toggle="modal" data-target="#{{$doc->id}}">
                                        <br/>
                                        <small>Објавено од:{{ $doc->name }}</small>
                                    </li>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{$doc->id}}" role="dialog">
                                        <div class="modal-dialog" id="modelHome">

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

                                    <li>
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
                                        <br/>
                                        <small>Објавено од:{{ $doc->name }}</small>
                                    </li>
                                @endif
                                <br/>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        jQuery_1_4('#calendar').datepicker({
            inline: true,
            showOtherMonths: true,
            minDate:0,
            dayNamesMin: ['Нед','Пон', 'Вто', 'Сре', 'Чет', 'Пет', 'Саб'],
            gotoCurrent: true,
            monthNames: ['Јануари', 'Фебруари', 'Март', 'Април', 'Мај', 'Јуни', 'Јули', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември']
        });
    </script>

    <script>
        function funk() {
            var selected = $("#calendar").val();
            var date = selected.split('/');
            var mydate = date[2]+ "-" +date[0]+ "-" +date[1];
            document.location.href="http://localhost/PhpstormProjects/webAppDip/public/home/"+mydate;
        }

        function shtikliraj(id) {
            document.location.href="http://localhost/PhpstormProjects/webAppDip/public/shtikliraj/"+id;
        }
    </script>


@endsection