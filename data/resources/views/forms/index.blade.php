@extends('layouts.master')

@section('title', 'Список форм')

@section('content')

    <div class="col-sm-12">

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

    <div class="row">
        <a class="btn btn-primary" href="{{action('FormsController@create')}}">Add Form</a>
    </div>

    <div class="row">
        @if ($forms->count() > 0)
            <table class="table">
                <tr>
                    <th>page uid</th>
                    <th>count fields</th>
                    <th colspan="3">count result</th>
                </tr>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{$form->page_uid}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('show_fields',$form)}}">Edit Fields({{$form->formFields->count()}})</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('show_result',$form)}}">Show Result</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('forms.edit',$form)}}">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('forms.destroy', $form)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div>NOT ENY FORM</div>
        @endif

    </div>



@stop
