@extends('layouts.app')

@section('content')
<div class="container">    
{{ Form::open( ["action" => "QuizImportController@store","enctype"=>"multipart/form-data"] ) }}
    <div class="card col-md-6 offset-md-3">
        <div class="card-header">
            <h3 class="card-title">Quiz Upload (from Excel)</h3>
        </div>
        <div class="card-body">
        
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

           
            <div class="form-group">
                <input type="text" class="form-control" name="qz_title" placeholder="title" value="{{ old('qz_title') }}" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="qz_desc" placeholder="description.."  required>{{ old('qz_desc') }}</textarea>
            </div>
            <div class="form-group">
                <input type="datetime-local" class="form-control w-50" name="qz_start_on"  value="{{ old('qz_start_on') }}" required>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="qz_duration" placeholder="duration in minute" value="{{ old('qz_duration') }}" required>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" min="1" max="25" name="qz_nQs" placeholder="number of qestion" value="{{ old('qz_nQs') }}" required>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" min="0" max="1" name="qz_neg" placeholder="Negative marking (0.0 to 1.0)" value="{{ old('qz_neg') }}" required>
            </div>
            
            <div class="custom-file mb-2">
                <input type="file" name="quiz_file" class="custom-file-input" id="customFile" accept=".xls,.xlsx" required>
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
    </div>
{{ Form::close() }}

{{ Form::open( ["action" => "QuizImportController@store","enctype"=>"multipart/form-data"] ) }}
<div class="card  offset-md-3 col-md-6 mt-5">
    <div class="card-body">
        <div class="custom-file my-2">
            <input type="file" name="quiz_file" class="custom-file-input" id="customFile" accept=".pdf" required>
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </div>
</div>

{{ Form::close() }}
</div>
@endsection