@extends('layouts.master')

@section('title', $title)

@section('content')

    <div class="col-sm-12">

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

    <div class="row">
        <a class="btn btn-primary" href="{{route('create_field',$form)}}">Add Field</a>
    </div>

    <div class="row">
        @if ($filelds->count() > 0)
            <table class="table">
                <tr>
                    <th colspan="3">field code</th>
                </tr>
                @foreach ($filelds as $fileld)
                    <tr>
                        <td>{{$fileld->code}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('edit_field',[$form,$fileld])}}">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('destroy_field', [$form, $fileld])}}" method="post">
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div>NOT ENY FIELD</div>
        @endif

    </div>

@stop
