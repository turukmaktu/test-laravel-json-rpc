@extends('layouts.master')

@section('title', $title)

@section('content')

    <div class="row">
        <table class="table">
            <tr>
                <th>field code</th>
                <th>field value</th>
            </tr>
            @foreach ($filelds as $fileld)
                <tr>
                    <td>{{$fileld->code}}</td>
                    <td>@if($fileld->result){{$fileld->result->value}}@else NOT SET @endif</td>
                </tr>
            @endforeach
    </div>

@stop
