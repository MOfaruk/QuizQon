@extends('layouts.user_master')

@section('title','Home')

@section('content')
<section>    
    <div class="container-fluid bg-green-light shadow-sm" style="background-image: linear-gradient(150deg, #4dcb44, #96da70,#5bce52)">
        <div class="row pb-5">
            <div class="col-md-6 offset-md-3" id="search-bar">
                <h3 class="h3 text-center mt-5 mb-3 text-white">Search for Quizzes</h3>
                <!-- <div class="rounded-div bg-white">
                    <input type="text" class="form-control" style="border-radius:2rem;width:100%; height:45px">
                </div> -->
                <div class="input-group mb-3 ">
                  <input type="text" class="form-control z-depth-2" placeholder="search ..." aria-describedby="basic-addon2" style="border-top-left-radius:1.5rem; border-bottom-left-radius:1.5rem; height:45px">
                  <div class="input-group-append" >
                    <span class="input-group-text bg-green-light z-depth-2" id="basic-addon2" style="border-top-right-radius:1.5rem; border-bottom-right-radius:1.5rem; height:45px;    background-color: #4dcb44;border: 3px solid #ffffff; color: #ffffff;cursor: pointer;">search</span>
                  </div>
                </div>
            </div>
        </div>
    </div>        
</section>

<section>
    <div class="container mb-5 {{ $recentQuiz->count()?'':'d-none' }}">
        <div class="col-md-4 offset-md-4 rounded-div">
            <h2 class="h1 text-center my-5">Recent Quizzes</h2>
        </div>
        <div class="row text-left">
            @foreach($recentQuiz as $quiz)
            <!--Grid column-->
            <div class="col-lg-12 col-md-12 mb-2">
                <!--Card-->
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0 col-md-2">
                        <img src="{{ asset('storage/quiz-thumbnails')."/".$quiz->thumbnail }}" class="img-fluid img-thumbnail mw-50" alt="">
                    </div>
                    <div class="card-block px-2 col-md-8 p-2">
                        <h4 class="card-title"><strong>{{ str_limit($quiz->title, 70) }} </strong></h4>
                        <p class="card-text">
                                {{ str_limit($quiz->desc, 200) }}  <br>                            
                            <b>Starts In: </b> 
                            {{ \Carbon\Carbon::parse($quiz->start_on)->format('h:i A, l, F j,Y') }}
                            <br><b>Duration:</b> {{ $quiz->duration }} minutes
                        </p>
                    </div>
                    <div class="col-md-2 text-center">
                        <a href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" 
                            class="btn btn-primary btn-md btn-block my-2">
                            Start
                        </a>
                        <a href="{{ route('quiz.scoreboard',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" class="btn btn-secondary btn-md btn-block">Score Board</a>
                    </div>
                </div>
                <!--/.Card-->                
            </div>
            <!--Grid column-->
            @endforeach
        </div>
        <div class="row">
            {{ $prevQuiz->links() }}
        </div>
    </div>
</section>

<section>
    <div class="container {{ $UpQuiz->count()?'':'d-none' }}">
        <div class="col-md-4 offset-md-4 rounded-div">
            <h2 class="h1 text-center my-5">Upcoming Quizzes</h2>
        </div>
        <div class="row text-left">
            @foreach($UpQuiz as $quiz)
            <!--Grid column-->
            <div class="col-lg-12 col-md-12 mb-2">
                <!--Card-->
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0 col-md-2">
                        <img src="{{ asset('storage/quiz-thumbnails')."/".$quiz->thumbnail }}" class="img-fluid img-thumbnail mw-50" alt="">
                    </div>
                    <div class="card-block px-2 col-md-8 p-2">
                        <h4 class="card-title"><strong>{{ str_limit($quiz->title, 70) }} </strong></h4>
                        <p class="card-text">
                            {{ str_limit($quiz->desc, 200) }} <br>                            
                            <b>Starts In: </b> 
                            {{ \Carbon\Carbon::parse($quiz->start_on)->format('h:i A, l, F j,Y') }}
                            <br><b>Duration:</b> {{ $quiz->duration }} minutes
                        </p>
                    </div>
                    <div class="col-md-2 text-center">
                        <a href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" class="btn btn-primary btn-md btn-block my-2">Start</a>
                    </div>
                </div>
                <!--/.Card-->                
            </div>
            <!--Grid column-->
            @endforeach
        </div>    
    </div>
</section>


<section>
    <div class="container mb-5 {{ $prevQuiz->count()?'':'d-none' }}">
        <div class="col-md-4 offset-md-4 rounded-div">
            <h2 class="h1 text-center my-5">Previous Quizzes</h2>
        </div>
        <div class="row text-left">
            @foreach($prevQuiz as $quiz)
            <!--Grid column-->
            <div class="col-lg-12 col-md-12 mb-2">
                <!--Card-->
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0 col-md-2">
                        <img src="{{ asset('storage/quiz-thumbnails')."/".$quiz->thumbnail }}" class="img-fluid img-thumbnail mw-50" alt="">
                    </div>
                    <div class="card-block px-2 col-md-8 p-2">
                        <h4 class="card-title"><strong>{{ str_limit($quiz->title, 70) }} </strong></h4>
                        <p class="card-text">
                                {{ str_limit($quiz->desc, 200) }}  <br>                            
                            <b>Starts In: </b> 
                            {{ \Carbon\Carbon::parse($quiz->start_on)->format('h:i A, l, F j,Y') }}
                            <br><b>Duration:</b> {{ $quiz->duration }} minutes
                        </p>
                    </div>
                    <div class="col-md-2 text-center">
                        <a href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" 
                            class="btn btn-primary btn-md btn-block my-2">
                            Start
                        </a>
                        <a href="{{ route('quiz.scoreboard',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" class="btn btn-secondary btn-md btn-block">Score Board</a>
                    </div>
                </div>
                <!--/.Card-->                
            </div>
            <!--Grid column-->
            @endforeach
        </div>
        <div class="row">
            {{ $prevQuiz->links() }}
        </div>
    </div>
</section> 

@endsection
