@extends('layouts.quiz_master')
@section('title', $quiz->title)

@section('dashboard-content')
<div class="row">
    <div class="col-md-8 col-sm-12 offset-md-1">
        <p class="card-text p-1">    
            <b>Starts On: </b> 
            {{ \Carbon\Carbon::parse($quiz->start_on)->format('h:i A - F j, Y (l)') }}
            <br><b>Duration:</b> {{ $quiz->duration }} minutes
        </p>

        {!!$quiz->desc!!}
        <br>
        <a href="{{ route('quiz.arena',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" class="btn btn-success btn-sm my-2">Start Now</a>
        <hr class="my-5">
    </div>
</div>
<div class="row">
    <div class="col-md-8 offset-md-1">
        <div>
            <h4 class="font-weight-bold">Comments</h4>
        </div>
        <div class="fb-comments" data-href="https://quizqon.com/quiz/description/{{$quiz->id}}" 
            data-width="" data-numposts="5">
        </div>
    </div>
</div>

@endsection

@section('link-act-description','active')

@push('scripts')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v5.0&appId=548523849331926"></script>
@endpush