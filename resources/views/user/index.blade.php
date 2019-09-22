@extends('layouts.user_master')

@section('content')
<div class="container-fluid bg-green-light">
    <section>
        <div class="row pb-5">
            <div class="col-md-6 offset-md-3" id="search-bar">
                <h3 class="h3 text-center mt-5 mb-3 text-white">Search for Course, Quiz, Author</h3>
                <!-- <div class="rounded-div bg-white">
                    <input type="text" class="form-control" style="border-radius:2rem;width:100%; height:45px">
                </div> -->
                <div class="input-group mb-3 ">
                  <input type="text" class="form-control z-depth-2" placeholder="author, quiz, course, anything ..." aria-describedby="basic-addon2" style="border-top-left-radius:1.5rem; border-bottom-left-radius:1.5rem; height:45px">
                  <div class="input-group-append" >
                    <span class="input-group-text bg-green-light z-depth-2" id="basic-addon2" style="border-top-right-radius:1.5rem; border-bottom-right-radius:1.5rem; height:45px;    background-color: #4dcb44;border: 3px solid #ffffff; color: #ffffff;cursor: pointer;">search</span>
                  </div>
                </div>
            </div>
        </div>
        
    </section>
</div>

<div class="container {{ $UpQuiz->count()?'':'d-none' }}">
    <section>
        <div class="col-md-4 offset-md-4 rounded-div">
            <h2 class="h1 text-center my-5">Upcoming Quiz</h2>
        </div>
        <div class="row text-left">
            @foreach($UpQuiz as $quiz)
            <!--Grid column-->
            <div class="col-lg-12 col-md-12 mb-2">
                <!--Card-->
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0 col-md-2">
                        <img src="https://mdbootstrap.com/img/Photos/Others/images/86.jpg" class="img-fluid img-thumbnail mw-50" alt="">
                    </div>
                    <div class="card-block px-2 col-md-8 p-2">
                        <h4 class="card-title"><strong>{{ $quiz->title }}</strong></h4>
                        <p class="card-text">
                            {{ $quiz->desc }} <br>                            
                            <b>Starts In: </b> 
                            {{ \Carbon\Carbon::parse($quiz->start_on)->format('h:i A, l, F j,Y') }}
                            <br><b>Duration:</b> {{ $quiz->duration }} minutes
                        </p>
                    </div>
                    <div class="col-md-2 text-center">
                        <a href="{{ url('/quiz/'.$quiz->id)}}" class="btn btn-primary btn-md btn-block my-2">Start</a>
                    </div>
                </div>
                <!--/.Card-->                
            </div>
            <!--Grid column-->
            @endforeach
        </div>
    </section>    
</div>

<div class="container {{ $prevQuiz->count()?'':'d-none' }}">
    <section>
        <div class="col-md-4 offset-md-4 rounded-div">
            <h2 class="h1 text-center my-5">Previous Quiz</h2>
        </div>
        <div class="row text-left">
            @foreach($prevQuiz as $quiz)
            <!--Grid column-->
            <div class="col-lg-12 col-md-12 mb-2">
                <!--Card-->
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0 col-md-2">
                        <img src="https://mdbootstrap.com/img/Photos/Others/images/86.jpg" class="img-fluid img-thumbnail mw-50" alt="">
                    </div>
                    <div class="card-block px-2 col-md-8 p-2">
                        <h4 class="card-title"><strong>{{ $quiz->title }}</strong></h4>
                        <p class="card-text">
                            {{ $quiz->desc }} <br>                            
                            <b>Starts In: </b> 
                            {{ \Carbon\Carbon::parse($quiz->start_on)->format('h:i A, l, F j,Y') }}
                            <br><b>Duration:</b> {{ $quiz->duration }} minutes
                        </p>
                    </div>
                    <div class="col-md-2 text-center">
                        <a href="{{ url('/quiz/'.$quiz->id)}}" class="btn btn-primary btn-md btn-block my-2">Start</a>
                        <a href="{{ url('/scoreboard/'.$quiz->id)}}" class="btn btn-secondary btn-md btn-block">Score Board</a>
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
    </section>    
</div>
@endsection
