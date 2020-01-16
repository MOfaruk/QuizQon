@extends('layouts.quiz_master')
@section('title', 'Scoreboard: '.$quiz->title)

@section('dashboard-content')

<div class="container">
    <section>
    {{-- <div class="row">    
        <div class="col-md-4 offset-md-4 rounded-div my-5">
            <h2 class="h1 text-center my-3">Score Board</h2>
        </div>
    </div> --}}
    <div class="row">
        <div class="row adsense">
            @include('partial.ad-square-one')
        </div>
        <div class="col-sm">
            <table class="table table-striped table-hover table-responsive-sm">
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
                    @foreach($score as $index=>$sc)
                    <tr class="{{ ($sc->id == Auth::id())?'table-info':''}}">
                        <td><b>{{  ($score->currentPage() -1) * $score->perPage() + $index+1 }}</b>/{{ $score->total() }}</th>
                        <td><a href="{{ route('user_profile',['id'=>$sc->id, 'name'=>Str::slug($sc->name) ]) }}">{{ $sc->name }}</a></td>
                        <td class="table-success"><b>{{ $sc->score }}</b></td>
                        <td>{{ (int)($sc->solve_time/60) }}:{{ ($sc->solve_time)%60 }}</td>
                        <td>{{ $sc->correct }}</td>
                        <td>{{ $sc->wrong }}</td>
                        <td>{{ $sc->unattempted }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="row mb-5">
        @auth     
        <div class="col-sm-3">
            <a href="{{ Request::url().'?page=-1'}}" class="btn btn-sm btn-success m-0">My Score</a>
        </div>
        @endauth 
        <div class="col-sm-2">
            {{ $score->links() }}
        </div>       
    </div>
    </section>
    
</div>

@endsection

@section('link-act-scoreboard')
active
@endsection
