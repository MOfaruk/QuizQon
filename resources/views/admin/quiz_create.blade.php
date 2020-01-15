@extends('layouts.admin')
@section('title', 'Create new quiz')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
        </div>
        <div class="card card-success card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tab-one" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">1. Initiate</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tab-two" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">2. Set Question</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tab-three" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">3. Upload Question</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tab-four" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="true">4. Settings</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade  active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tab-one">
                    {{ Form::open(array('action' => 'QuizController@store')) }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control w-50" name="qz_title" placeholder="title" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Start Time</label>
                        <input type="datetime-local" class="form-control w-50" name="qz_start_on"  required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Duration(in Min)</label>
                        <input type="number" class="form-control w-50" name="qz_duration" placeholder="duration in minute" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control w-50" name="qz_desc" placeholder="description.." id="description-textarea">                            
                        </textarea>
                    </div>
                    {{--
                    <input type="number" class="form-control w-50" min="1" max="25" name="qz_nQs" placeholder="number of qestion">
                    --}}

                    <button type="submit" href="{{route('admin.quiz.store')}}" class="btn btn-success"> set question >></button type="submit">
                    
                    {{ Form::close() }}
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tab-two">
                   Mauris
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tab-three">
                   Morbi
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tab-four">
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
    // Summernote
    $('#description-textarea').summernote({
    height: 150,   //set editable area's height
    codemirror: { // codemirror options
      theme: 'monokai'
    }
  })
});
</script>  
@endpush