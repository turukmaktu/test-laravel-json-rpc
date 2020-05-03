@extends('master')

@section('title', 'first page')

@section('content')
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('first')}}">first</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('second')}}">second</a>
        </li>
    </ul>
    <div class="row">
        {{ Widget::run('Form',['page_uid' => 'uid_one']) }}
    </div>

@stop
