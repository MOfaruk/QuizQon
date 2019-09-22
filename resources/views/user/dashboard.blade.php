@extends('layouts.user_master')

@section('content')
<div class="container">
    <div class="row py-5">

        <!-- ============================ SIDEBAR:MENU ============================ -->
        @include('partial.dashboard-left-menu')
        <!-- ./Sidebar -->

        <!--   ==================      Content     ========================     -->
        <div class="col-md-9 z-depth-1 p-5">
            @yield('dashboard-content')
        </div> <!-- ./Content -->
    </div>
</div> <!-- ./Container -->
@endsection
