@extends('theme.main')

@section('content')
    <div class="col-sm-8 col-md-6 offset-sm-2 offset-md-3">
        <div class="col-xs-12" style="height:150px;"></div>
            <div class="card">
                <div class="card-body">
                <form action="{{route('result-upload-action')}}" method="POST" enctype="multipart/form-data">
                    {{@csrf_field()}}
                    <div class="form-group">
                        <label for="file-upload-button">Please select file</label>
                        <input name="result_file" type="file" class="form-control-file" id="file-upload-button" aria-describedby="file-upload-help-block">
                        <small id="file-upload-help-block" class="form-text text-muted text-danger">
                            @if($errors->has('result_file'))
                                {{implode(' ', $errors->get('result_file'))}}
                            @endif
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">Start Upload</button>
                </form>
            </div>
        </div>
    </div>

@endsection