@extends('layouts.user_master')

@section('content')
<div class="container py-5 px-0">
    <!-- ============================ SIDEBAR:MENU ============================ --
    <div class="row">

        include('partial.dashboard-left-menu')                
    </div>
    <--   ==================      Content     ========================     -->

    <div class="row border shadow-sm mb-4 rounded p-3">
        <div class="col-md-2">
            <img src="{{ asset('images/images.jpg')}}" class="rounded-circle float-sm-left float-md-right" width="80px">

        </div>
        <div class="col-md-10 text-left border-left">
            
            <h2>{{isset($account)?$account->name:Auth::user()->name}} </h2>
            <span>{{ $personalInfo['institute'] }}</span><br>
            @empty($anonymous)
            <a href="{{ route('dashboard.update_view') }}" class="btn btn-sm btn-default m-0 p-1">Update info</a>
            @endempty

            @isset($anonymous)
                @if($bFriend)
                    <a href="#" class="btn btn-sm btn-warning m-0 p-1" id="{{ $account->id }}" onclick="removeFriend(this.id)">Remove Friend</a>
                @else
                    <a href="#" class="btn btn-sm btn-success m-0 p-1" id="{{ $account->id }}" onclick="addFriend(this.id)">Add Friend</a>

                @endif
            @endisset

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
                                <a class="nav-link @yield('link-act-quizzes')" href="{{ route('dashboard.quizzes')}}">Performance</a>
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
