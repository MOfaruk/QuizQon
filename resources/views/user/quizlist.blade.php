@extends('layouts.user_master')

@section('title','Quizzes')

@section('content')

<section>
    <div class="container mb-5">
        <div class="col-md-4 offset-md-4 rounded-div">
            <h2 class="h1 text-center my-5">Quiz List</h2>
        </div>
        <div class="row text-left">
            <div class="{{ $quizzes->count()?'d-none':'' }} col-12">
                <h5 class=""> No quiz found! Search again...</h5>
                {{ Form::open(['route' => 'search', 'method'=>'GET','name'=>'myform']) }}

                    <div class="d-flex justify-content-center h-100">
                        <div class="searchbar col-sm-12 col-md-6" style="background:#ccc">
                          <input class="search_input" type="text" name="query" placeholder="Search again...">
                          <a type="submit" href="#" class="search_icon" onclick="myform.submit()"><i class="fa fa-search"></i></a>
                        </div>
                    </div>

                {{ Form::close() }}
            </div>
            
            @foreach($quizzes as $quiz)
            <!--Grid column-->
            <div class="col-lg-12 col-md-12 mb-2">
                <!--Card-->
                <div class="card flex-row flex-wrap">
                    <div class="view overlay border-0 col-md-2">
                        <img src="{{ asset('storage/quiz-thumbnails')."/".$quiz->thumbnail }}" class="card-img-top" alt="quiz thumbnail">
                        <a href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}">
                            <div class="mask rgba-white-sligh"></div>
                        </a>
                    </div>
                    <div class="card-block px-2 col-md-8 p-2">
                        <h4 class="card-title">
                            <a href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}">
                                {{ str_limit($quiz->title, 70) }}
                            </a>
                        </h4>
                        <p class="card-text">    
                            <b>Started on: </b> 
                            {{ \Carbon\Carbon::parse($quiz->start_on)->format('F j, Y') }}
                            <br><b>Duration:</b> {{ $quiz->duration }} minutes
                        </p>
                    </div>
                    <div class="col-md-2 text-center pb-2">
                        <a href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" 
                            class="btn btn-success btn-md btn-block my-2">
                            Enter
                        </a>
                        <a href="{{ route('quiz.scoreboard',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" class="btn btn-info btn-md btn-block">Score Board</a>
                    </div>
                </div>
                <!--/.Card-->                
            </div>
            <!--Grid column-->
            @endforeach
        </div>
        <div class="row">
            {{ $quizzes->links() }}
        </div>
    </div>
</section> 

@endsection
@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/searchbar.css')}}">
@endpush