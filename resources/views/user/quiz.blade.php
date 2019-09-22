@extends('layouts.user_master')

@section('head')
<!-- Quiz Id -->
<meta name="quiz-id" content="{{ $quiz->id }}">
@endsection

@section('content')
<div class="container">
    <section>
    <form method="post" id="ansForm">
        <div class="row">
            <div class="col-md-4 offset-md-4 rounded-div my-2">
                <h2 class="h1 text-center my-3">{{$quiz->title}}</h2>
                <h4 class="card bg-dark h3 text-center my-3 text-success" id="timer"></h4>
            </div>
        </div>
        <div class="row sticky-top">
            <div class="progress col-md-4 offset-md-4  border border-dark p-0" style="height: 25px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="h5" id="progress-stat" style="color:#ffc107">0:0</span>
                </div>
            </div>
        </div>
        <div class="row text-left my-3" >
            <div class="col-md-12" id="qs_container">
            </div>
        </div>
        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success d-none" id="btnSubmit">Submit</button>
            <button type="submit" class="btn btn-primary d-none" id="btnShowScore">My Score</button>            
            <a href="{{ url('/scoreboard/'.$quiz->id)}}" class="btn btn-secondary" id="btnShowScore">Score Board</a>
        </div>
    </form>
    </section>
    
</div>
@endsection

@section('scripts')
<script src="/js/quiz.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection