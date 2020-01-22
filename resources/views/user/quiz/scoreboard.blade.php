@extends('layouts.quiz_master')
@section('title', 'Scoreboard: '.$quiz->title)

@section('dashboard-content')

<div class="container px-0">
    <section>
        <div class="row">
            <div class="col text-center">
                @if($bFinalScore)
                <h4 class="font-weight-bold">Final Scoreboard</h4>
                @else
                <h4 class="font-weight-bold">Scoreboard(Current)</h4>
                <h6>final scoreboard will be published after the quiz end</h6>
                @endif
            </div>
        </div>
        @if($userAns)
        <div class="row px-3">
            <div class="col text-left rounded p-3" style="background-color: #ccf59d;">
            <h6 class="font-weight-bold">Your Score: {{$userAns->score*100}}%</h6>
            <h6>Correct: {{$userAns->correct}}</h6>
            <h6>Wrong: {{$userAns->wrong}}</h6>
            <h6>Unattempted: {{$userAns->unattempted}}</h6>
            <h6>Solve Time: {{$userAns->solve_time}} seconds</h6>
            </div>
        </div>
        @endif
    {{-- <div class="row">    
        <div class="col-md-4 offset-md-4 rounded-div my-5">
            <h2 class="h1 text-center my-3">Score Board</h2>
        </div>
    </div> --}}
    <div class="row">        
        <div class="col-md-12">
            @include('partial.ad-square-one')
        </div>
    </div>
    @if($score)
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-responsive-md">
                <thead class="thead-dark"> 
                    <tr>
                    <th scope="col">#Rank</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="table-success">Score</th>
                    <th scope="col">Solve Time</th>
                    <th scope="col">Correct</th>
                    <th scope="col">Wrong</th>
                    <th scope="col">Unattempted</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($score))
                    @foreach($score as $index=>$sc)
                    <tr class="{{ ($sc->id == Auth::id())?'table-success':''}}">
                        <td><b>{{  ($score->currentPage() -1) * $score->perPage() + $index+1 }}</b>/{{ $score->total() }}</td>
                        <td><a href="{{ route('user_profile',['id'=>$sc->id, 'name'=>Str::slug($sc->name) ]) }}" class="text-success font-weight-bold">{{ $sc->name }}</a></td>
                        <td class="table-info font-weight-bold">{{ $sc->score*100 }}<small>%</small></td>
                        <td>{{ (int)($sc->solve_time/60) }}:{{ ($sc->solve_time)%60 }}</td>
                        <td>{{ $sc->correct }}</td>
                        <td>{{ $sc->wrong }}</td>
                        <td>{{ $sc->unattempted }}</td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="row mb-5">
        {{-- @auth     
        <div class="col-sm-3">
            <a href="{{ Request::url().'?page=-1'}}" class="btn btn-sm btn-success m-0">My Score</a>
        </div>
        @endauth  --}}
        <div class="col-sm-2">
            {{$score->links() }}
        </div>       
    </div>
    @endif
    </section>
    
</div>

@endsection

@section('link-act-scoreboard')
active
@endsection
