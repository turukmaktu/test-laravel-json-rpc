@extends('layouts.master')

@section('title', $title)

@section('content')
    <form method="post" action="{{ $action }}">
        @csrf

        @isset ($model)
            <input type="hidden" name="id" value="{{$model->id}}">
        @endisset

        <input type="hidden" name="form_id" value="{{$form->id}}">

        <div class="form-group">
            <label for="code">code:</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"  @isset ($model)value="{{$model->code}}"@endisset/>
            @error('code')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">@isset($model) Update field @else Add field @endif</button>
    </form>
@stop
