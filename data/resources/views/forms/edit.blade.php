@extends('layouts.master')

@section('title', $title)

@section('content')
    <form method="post" action="{{ $action }}">
        @csrf
        @isset($method)
            @method($method)
        @endisset

        @isset ($model)
            <input type="hidden" name="id" value="{{$model->id}}}">
        @endisset
        <div class="form-group">
            <label for="page_uid">page_uid:</label>
            <input type="text" class="form-control @error('page_uid') is-invalid @enderror" name="page_uid"  @isset ($model)value="{{$model->page_uid}}"@endisset/>
            @error('page_uid')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">@isset($model) Update form @else Add form @endif</button>
    </form>
@stop
