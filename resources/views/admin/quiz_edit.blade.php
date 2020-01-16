@extends('layouts.admin')
@section('title', 'Edit Quiz')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
        </div>
        <div class="card card-success card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                <a class="nav-link {{$tab=='first'?'active':''}}" id="custom-tab-one" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">1. Initiate</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$tab=='second'?'active':''}}" id="custom-tab-two" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">2. Set Question</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$tab=='third'?'active':''}}" id="custom-tab-three" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">3. Upload Question</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$tab=='fourth'?'active':''}}" id="custom-tab-four" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="true">4. Settings</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade {{$tab=='first'?'active show':''}}" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tab-one">
                    {{ Form::open(array('route' => ['admin.quiz.update',$quiz->id],'method'=>'PUT')) }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control w-50" name="qz_title" placeholder="title" value="{{ $quiz->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Start Time</label>
                        <input type="datetime-local" class="form-control w-50" name="qz_start_on"  value="{{ date('Y-m-d\TH:i',strtotime(\Carbon\Carbon::parse($quiz->start_on)->setTimezone('Asia/Dhaka'))) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Duration(in Min)</label>
                        <input type="number" class="form-control w-50" name="qz_duration" placeholder="duration in minute" value="{{ $quiz->duration }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control w-50" name="qz_desc" placeholder="description.." id="description-textarea">                            
                        {{ $quiz->desc }}
                        </textarea>
                    </div>
                    {{--
                    <input type="number" class="form-control w-50" min="1" max="25" name="qz_nQs" placeholder="number of qestion">
                    --}}

                    <button type="submit" href="#!" class="btn btn-success">Update</button type="submit">
                    
                    {{ Form::close() }}
                </div>
                <div class="tab-pane fade {{$tab=='second'?'active show':''}}" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tab-two">
                   Mauris
                </div>
                <div class="tab-pane fade {{$tab=='third'?'active show':''}}" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tab-three">
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
                              <input type="number" name="quiz_id"  value="{{$quiz->id}}" hidden>
                          </div>
                          <div class="form-group">
                              <input type="number" class="form-control" min="1" max="25" name="qz_nQs" placeholder="number of qestion" value="{{ old('qz_nQs') }}" required>
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
                </div>
                <div class="tab-pane fade {{$tab=='fourth'?'active show':''}}" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tab-four">
                   Pellentesque 
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
    </div>
</div>
            
            
@endsection

@push('head')
<!-- summernote -->
<link rel="stylesheet" href="/bower_components/admin-lte/plugins/summernote/summernote-bs4.css">
@endpush

@push('scripts')
<script src="/bower_components/admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(function () {
    //summernote.org/deep-dive/
    $('#description-textarea').summernote({
      height: 150,   //set editable area's height
      codemirror: { // codemirror options
        theme: 'monokai'
      }
    });

});
</script>  
@endpush