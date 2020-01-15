@extends('layouts.user_master')

@section('content')
<div class="container py-5">
    <div class="row">

        <!-- ============================ SIDEBAR:MENU ============================ --
        include('partial.dashboard-left-menu')
        <-- ./Sidebar -->

        <!--   ==================      Content     ========================     -->
                  
    </div>
  

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-description')" href="{{ route('quiz.description',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)])}}">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-arena')" href="{{ route('quiz.arena',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)])}}">Arena</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-scoreboard')" href="{{ route('quiz.scoreboard',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)])}}">Scoreboard</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-solution')" href="{{ route('quiz.solution',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)])}}">Solution</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card-body"><!--  Alerts and Messages -->
                        @if(session()->has('msg'))
                            <div class="alert alert-{{session()->get('msg.type')}} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session()->get('msg.info') }}
                            </div>
                        @endif
                        
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                
                    @yield('dashboard-content')
            </div>
        </div> <!-- ./Content -->
    </div>
</div> <!-- ./Container -->
@endsection
