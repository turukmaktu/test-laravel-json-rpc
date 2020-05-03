@if($error)
<div class="alert alert-danger">{{ $errorMessage }}</div>
@else

    <form method="get">
        <h1>DATA {{$data['PAGE_UID']}}</h1>
        @csrf
        <input type="hidden" name="page_uid" value="{{$data['PAGE_UID']}}">
        @foreach($data['FIELDS'] as $fieldData)
            <div class="form-group">
                <label for="{{$fieldData['CODE']}}">{{$fieldData['CODE']}}</label>
                <input type="text" class="form-control" id="{{$fieldData['CODE']}}" value="{{$fieldData['VALUE']}}" name="{{$fieldData['CODE']}}" placeholder="Enter {{$fieldData['CODE']}}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endif
