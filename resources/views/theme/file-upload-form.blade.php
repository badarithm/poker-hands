@extends('theme.main')

@section('content')
    <form action="{{route('result-upload-action')}}" method="POST">
        <div class="form-group">
            <label for="file-upload-button">Please select file</label>
            <input type="file" class="form-control-file" id="file-upload-button">
        </div>
        <button type="submit" class="btn btn-primary">Start Upload</button>
    </form>
@endsection