@extends('layouts.quiz_master')
@section('title', $quiz->title)

@section('dashboard-content')


<div class="fb-comments" data-href="https://quizqon.com/quiz/description/{{$quiz->id}}" data-width="" data-numposts="5"></div>
@endsection

@section('link-act-description')
active
@endsection

@push('scripts')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v5.0&appId=548523849331926"></script>
@endpush