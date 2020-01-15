@extends('layouts.user_master')

@section('content')
<div class="container py-5">
    <div class="row">

        <!-- ============================ SIDEBAR:MENU ============================ --
        include('partial.dashboard-left-menu')
        <-- ./Sidebar -->

        <!--   ==================      Content     ========================     -->
                  
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="col-md-12">
                        <img src="{{ asset('images/images.jpg')}}" class="rounded-circle float-left" width="80px">
                    </div>
                    <div class="p-2">
                        <h2>{{isset($account)?$account->name:Auth::user()->name}} </h2>
                        <span>{{ $personalInfo['institute'] }}</span><br>
                    </div>
                </div>
                <div class="col">
                    <div class="text-right">
                        <span>Rating</span>
                        <br>                        
                        <i class="fa fa-trophy text-warning"></i>
                        <i class="fa fa-trophy" style="color:#D2691E"></i>
                        <i class="fa fa-trophy" style="color:#aaa9ad"></i>
                        <br>
                        <a href="" class="fa fa-facebook"></a>
                        <a class="fa fa-globe text-success"></a>
                        <br>

                        @empty($anonymous)
                        <a href="{{ route('dashboard.update_view') }}" class="btn btn-sm btn-default m-0 p-1">Update info</a>
                        @endempty

                        @isset($anonymous)
                            @if($bFriend)
                                <a href="#" class="btn btn-sm btn-outline-warning m-0 p-1" id="{{ $account->id }}" onclick="removeFriend(this.id)">Remove Friend</a>
                            @else
                                <a href="#" class="btn btn-sm btn-success m-0 p-1" id="{{ $account->id }}" onclick="addFriend(this.id)">Add Friend</a>

                            @endif
                        @endisset
                        
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-profile')" href="{{ route('dashboard.index')}}">Profile</a>
                            </li>
                            @empty($anonymous)
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-quizzes')" href="{{ route('dashboard.quizzes')}}">Contests</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-friends')" href="{{ route('dashboard.friends')}}">Friends</a>
                            </li>
                            <!--
                            <li class="nav-item">
                                <a class="nav-link @yield('link-act-settings')" href="{{ route('dashboard.settings')}}" tabindex="-1">Settings</a>
                            </li> -->
                            @endempty 
                            <!--                          
                            <li>
                                <a class="nav-link @yield('link-act-update')" href="{{ route('dashboard.update_view')}}">Update Profile</a>
                            </li> -->
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

@push('head')
<!-- User Id -->
<meta name="user-id" content="{{isset($account)?$account->id:Auth::user()->id}}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="/js/friend.js"></script>
@endpush
