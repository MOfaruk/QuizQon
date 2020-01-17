@extends('layouts.dashboard_master')
@section('title','Contests')
@section('dashboard-content')

<div class="card-body">
    <h2 class="card-title">Performance Summary</h2>

    @foreach($quizzes as $quiz)
    <div class="border shadow-none mb-3">
        <div class="p-3">
            <div class="row px-3">
                <h4>{{ $quiz->title }}</h4>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <span>Score: {{ $quiz->score }}/{{ $quiz->nQs }} </span>&nbsp;
                        @for($i=1; $i <= ($quiz->score*5)/$quiz->nQs; $i++)
                            <i class="fa fa-star text-warning"></i>
                        @endfor
                        @for( ; $i <= 5; $i++)
                            <i class="fa fa-star-o text-warning"></i>
                        @endfor
                    <br>
                    Total: {{ $quiz->nQs }} &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-check-circle text-muted"> {{ $quiz->correct }}</i>&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-times-circle text-muted"> {{ $quiz->wrong }}</i> &nbsp;&nbsp;&nbsp;
                    <i class="fa fa-circle-thin text-muted"> {{ $quiz->unattempted }}</i> &nbsp;&nbsp;&nbsp;
                    <i class="fa fa-clock-o text-muted"> {{ (int)($quiz->solve_time/60) }}:{{ $quiz->solve_time%60 }}</i><br>
                    <span>{{ \Carbon\Carbon::parse($quiz->start_on)->format('h:i A, M j, Y') }}</span>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}" class="btn btn-success btn-md float-right">View Quiz</a>            
                </div>
            </div>
            
        </div>
        <div>

        </div>
    </div>
    @endforeach
    <div class="row adsense">
        @include('partial.ad-square-one')
    </div>

</div>
<div class="mt-3">
    {{$quizzes->links()}}
</div>

@endsection
@section('link-act-quizzes')
active
@endsection
