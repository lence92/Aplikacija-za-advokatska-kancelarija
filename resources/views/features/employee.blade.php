<?php
/**
 * Created by PhpStorm.
 * User: Lenche
 * Date: 9/4/2016
 * Time: 4:11 PM
 */?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br/>
        <table class="table" style="margin-bottom: 60px">
            <tr class="active">
                <th>Сите вработени:</th>
                <th>
                    @if(Auth::user()->role == 'admin')
                        Ажурирај
                    @endif
                </th>
                <th>
                    @if(Auth::user()->role == 'admin')
                        Избриши
                    @endif
                </th>
            </tr>
            @foreach($all as $emp)
                <tr>
                    <td><img src="{{ url($emp->image) }}" width="30" height="30"> <a href="{{ url('/profile/'.$emp->id) }}">{{ $emp->name }}</a></td>
                    <td>
                        @if(Auth::user()->is_admin() && ($emp->role != 'admin'))
                            <a href="{{ url('/editEmployee/'.$emp->id) }}"><img src="{{ url('image/update_file-512.png') }}" title="Ажурирај" width="35" height="35"></a>
                        @endif
                    </td>
                    <td>
                        @if(Auth::user()->is_admin() && ($emp->role != 'admin'))
                            <a href="{{ url('/deleteEmployee/'.$emp->id) }}" style="border: none; background-color: transparent;"><img src="{{ url('image/trash-icon.png') }}" title="Избриши" width="35" height="35"></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
