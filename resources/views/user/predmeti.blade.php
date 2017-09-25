<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/9/2016
 * Time: 11:30 PM
 */?>
@extends('layouts.app')

@section('content')

    <style>
        /* Style the list */
        ul.tab {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Float the list items side by side */
        ul.tab li {
            float: left;

        }

        /* Style the links inside the list items */
        ul.tab li a {
            display: inline-block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: 0.3s;
            font-size: 17px;
            background-color: #dfdfdf;
        }

        #tab2{
            border-left: solid 1px #c2c2c2;
        }

        /* Change background color of links on hover */
        ul.tab li a:hover {background-color: #ddd;}

        /* Create an active/current tablink class */
        ul.tab li a:focus, .active {
            background-color: #cdcdcd;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px;
            border-top: none;

            -webkit-animation: fadeEffect 1.5s;
            animation: fadeEffect 1.5s; /* Fading effect takes 1 second */
        }


        @-webkit-keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        table {
            border-collapse: separate;
            border-spacing: 15px 30px;
        }

        @if(empty(Session::get('pred')))
        #part_lawy{
            border: 1px solid #ccc;
            border-top: none;
            padding: 10px 50px 50px 50px;
            height: 550px;
            background: #ffffff;
            margin-right: 60px;
        }

        #moi_predmeti{
            background-color: white;
            padding: 20px 50px 50px 50px;
            height: 550px;
            background: #ffffff;
            margin-right: 60px;
        }
        @else
        #part_lawy{
            border: 1px solid #ccc;
            border-top: none;
            padding: 10px 50px 50px 50px;
            height: auto;
            background: #ffffff;
            margin-right: 60px;
        }

        #moi_predmeti{
            background-color: white;
            padding: 20px 50px 50px 50px;
            height: auto;
            background: #ffffff;
            margin-right: 60px;
        }
        @endif

        @if(empty(Session::get('allCases')))
        #site_predmeti{
            height: 550px;
            background-color: white;
            margin-right: 60px;
        }

        #paralegal_predmeti{
            height: 550px;
            margin-top: -19px;
            background-color: white;
            margin-right: 60px;
        }
        @else
            #site_predmeti{
            height: auto;
            background-color: white;
            margin-right: 60px;
        }

        #paralegal_predmeti{
            height: auto;
            margin-top: -19px;
            background-color: white;
            margin-right: 60px;
        }
        @endif

        h2{
            text-align: center;
        }

    </style>

    @if(Auth::user()->is_admin())
        <ul class="tab">
            <li><a href="#" class="tablinks" onclick="openTab(event, 'moi_predmeti')">Мои предмети</a></li>
            <li><a href="#" class="tablinks" id="tab2" onclick="openTab(event, 'site_predmeti')">Сите предмети</a></li>
        </ul>

        <div id="moi_predmeti" class="tabcontent">
            <h2 style="padding-top: 10px;"><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-412-package.png') }}"/> Избери број на предмет</h2>
            <div style="padding-top: 40px; font-family: Cursive;">
                <form action="{{ url('/getCase') }}" method="post" class="pull-right">
                    {{ csrf_field() }}
                    <i class="glyphicon glyphicon-file"></i>
                <select style="padding: 10px 42px 10px 10px;" name="mySelect">
                    <option value="0">Број на предмет: </option>
                    @foreach($cases as $case)
                        @foreach($permissions as $perm)
                            @if($perm->user_id == Auth::user()->id && $perm->broj_na_predmet == $case->broj_na_predmet)
                                <option value="{{ $case->broj_na_predmet }}">Број на предмет: {{ $case->broj_na_predmet }}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>

                    <span style="padding-left: 20px"><input type="submit" name="submit" value="Отвори" style="border: none; padding: 10px"/></span>
                </form>

                <div id="demo">
                    @if(!empty(Session::get('pred')))
                        <?php $pred = Session::get('pred'); ?>
                        <h3 style="padding-top: 35px; padding-left: 30px">Број на предмет: {{ $pred->broj_na_predmet }}</h3>
                        <table class="table">
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Тужител</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->tuzitel }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Тужен</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->tuzen }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-539-invoice.png') }}"/><br/>Основ</td>
                                <td style="padding-top: 20px; padding-left: 15px"><p>{{ $pred->osnov }}</p></td>
                            </tr>
                            <tr>
                                <td><i class="glyphicon glyphicon-euro"></i><br/>Вредност</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->vrednost }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-643-judiciary.png') }}"/><br/>Судија</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->sudija }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-622-businessman.png') }}"/><br/>Адвокат од другата страна</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->advokat_dr_strana }}</td>
                            </tr>
                            <tr>
                                <td>Документи:</td>
                                <td style="padding-top: 20px; padding-left: 15px">
                                    @include('features/VidiDokumenti')
                                </td>
                            </tr>
                        </table>
                        <a href="{{ url('/editPredmet/'.$pred->id) }}" style="background-color: #c1c1c1; padding: 10px; color: black"><i class="glyphicon glyphicon-open-file"></i>Ажурирај</a>
                            <!-- Button trigger modal -->
                            <button type="button" style="background-color: #c1c1c1; padding: 10px; color: black; border: none" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-trash"></i> Избриши
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                        </div>
                                        <div class="modal-body">
                                            Дали сте сигурни дека сакате да го избришете предметот?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/deletePredmet/'.$pred->id) }}'">Избриши</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>

        <div id="site_predmeti" class="tabcontent">
            <h2 style="padding-top: 30px;"><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-642-law-justice.png') }}"/> Сите предмети по адвокати</h2>
            <div style="padding-top: 40px; font-family: Cursive;">
                <form method="post" action="{{ url('/selectLawyer') }}" class="pull-right" style="padding-right: 40px">
                    {{ csrf_field() }}
                    <i class="glyphicon glyphicon-user"></i>
                    <select style="padding: 10px 42px 10px 10px;" name="selectLawyer">
                        <option value="0">Избери адвокат:</option>
                        @foreach($users as $user)
                            @if($user->role == 'partner' || $user->role == 'lawyer')
                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <span style="padding-left: 20px"><input type="submit" name="submit" value="Отвори" style="border: none; padding: 10px"/></span>
                </form>

                <div id="demo">

                    @if(!empty(Session::get('allCases')) && !empty(Session::get('permiss')) && !empty(Session::get('lawyer')))
                        <?php $all = Session::get('allCases'); $permiss = Session::get('permiss');?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ Session::get('lawyer') }}:</th>
                                </tr>
                                </thead>
                                <?php $i=1; ?>
                                <tbody>
                                @foreach($all as $case)
                                    @foreach($permiss as $permi)
                                        @if($permi->broj_na_predmet == $case->broj_na_predmet)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    <a href="{{ url('/predmet/'.$case->id) }}">Број на предмет: {{ $case->broj_na_predmet }}</a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endif
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                    @endif
                </div>
            </div>
        </div>

    @elseif(Auth::user()->is_lawyer())
        <ul class="tab">
            <li><a href="#">Мои предмети</a></li>
        </ul>
        <div id="part_lawy">
            <h2 style="padding-top: 10px;"><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-412-package.png') }}"/> Избери број на предмет</h2><br/>
            <div style="padding-top: 40px; font-family: Cursive;">
                <form action="{{ url('/getCase') }}" method="post" class="pull-right">
                    {{ csrf_field() }}
                    <i class="glyphicon glyphicon-file"></i>
                    <select style="padding: 10px 42px 10px 10px;" name="mySelect">
                        <option value="0">Број на предмет: </option>
                        @foreach($cases as $case)
                            @foreach($permissions as $perm)
                                @if($perm->user_id == Auth::user()->id && $perm->broj_na_predmet == $case->broj_na_predmet)
                                    <option value="{{ $case->broj_na_predmet }}">Број на предмет: {{ $case->broj_na_predmet }}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>

                    <span style="padding-left: 20px"><input type="submit" name="submit" value="Отвори" style="border: none; padding: 10px"/></span>
                </form>

                <div id="demo">
                    @if(!empty(Session::get('pred')))
                        <?php $pred = Session::get('pred'); ?>
                        <h3 style="padding-top: 35px; padding-left: 30px">Број на предмет: {{ $pred->broj_na_predmet }}</h3>
                        <table class="table">
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Тужител</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->tuzitel }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-4-user.png') }}"/><br/>Тужен</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->tuzen }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-539-invoice.png') }}"/><br/>Основ</td>
                                <td style="padding-top: 20px; padding-left: 15px"><p>{{ $pred->osnov }}</p></td>
                            </tr>
                            <tr>
                                <td><i class="glyphicon glyphicon-euro"></i><br/>Вредност</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->vrednost }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-643-judiciary.png') }}"/><br/>Судија</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->sudija }}</td>
                            </tr>
                            <tr>
                                <td><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-622-businessman.png') }}"/><br/>Адвокат од другата страна</td>
                                <td style="padding-top: 20px; padding-left: 15px">{{ $pred->advokat_dr_strana }}</td>
                            </tr>
                            <tr>
                                <td>Документи:</td>
                                <td style="padding-top: 20px; padding-left: 15px">
                                    @include('features/VidiDokumenti')
                                </td>
                            </tr>
                        </table>
                            <a href="{{ url('/editPredmet/'.$pred->id) }}" style="background-color: #c1c1c1; padding: 10px; color: black"><i class="glyphicon glyphicon-open-file"></i>Ажурирај</a>
                            <!-- Button trigger modal -->
                            <button type="button" style="background-color: #c1c1c1; padding: 10px; color: black; border: none" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-trash"></i> Избриши
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                        </div>
                                        <div class="modal-body">
                                            Дали сте сигурни дека сакате да го избришете предметот?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/deletePredmet/'.$pred->id) }}'">Избриши</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif(Auth::user()->role == 'paralegal')
        <ul class="tab">
            <li><a href="#">Сите предмети</a></li>
        </ul>
        <div id="paralegal_predmeti">
            <h2 style="padding-top: 40px;"><img src="{{ url('glyphicons_free/glyphicons/png/glyphicons-642-law-justice.png') }}"/> Сите предмети по адвокати</h2>
            <div style="padding-top: 40px; font-family: Cursive;">
                <form method="post" action="{{ url('/selectLawyer') }}" class="pull-right" style="padding-right: 50px">
                    {{ csrf_field() }}
                    <i class="glyphicon glyphicon-user"></i>
                    <select style="padding: 10px 42px 10px 10px;" name="selectLawyer">
                        <option value="0">Избери адвокат:</option>
                        @foreach($users as $user)
                            @if($user->role != 'paralegal')
                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <span  style="padding-left: 20px"><input type="submit" name="submit" value="Отвори" style="border: none; padding: 10px"/></span>
                </form>

                <div id="demo">

                    @if(!empty(Session::get('allCases')) && !empty(Session::get('permiss')) && !empty(Session::get('lawyer')))
                        <?php $all = Session::get('allCases'); $permiss = Session::get('permiss');?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ Session::get('lawyer') }}:</th>
                            </tr>
                            </thead>
                            <?php $i=1; ?>
                            <tbody>
                            @foreach($all as $case)
                                @foreach($permiss as $permi)
                                    @if($permi->broj_na_predmet == $case->broj_na_predmet)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <a href="{{ url('/predmet/'.$case->id) }}">Број на предмет: {{ $case->broj_na_predmet }}</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    @endif

<script>

    @if(!empty(Session::get('allCases')))
            $(window).load(
            openTab(event, 'site_predmeti'));
    @elseif(!empty(Session::get('pred')) || (empty(Session::get('pred')) && empty(Session::get('allCases'))))
            $(window).load(
            openTab(event, 'moi_predmeti'));
    @endif

    function openTab(evt, tabName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the link that opened the tab
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

</script>
@endsection
