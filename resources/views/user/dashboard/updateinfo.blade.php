@extends('layouts.dashboard_master')
@section('title', 'Update profile info')
@section('dashboard-content')
<div class="card-body col-sm-10 offset-sm-1">
    <div class="row">
        <div class="col">
            <h4 class="card-title">Account Info</h4>
            <hr class="border-success">
            <form action="{{ route('dashboard.update_account') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $account->name }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone(+88):</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $account->phone }}" placeholder="01XXXXXXXXX" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $account->email }}" required>
                </div>
                <button type="submit" class="btn btn-success m-0">update</button>
            </form>
        </div>
        <div class="col offset-sm-1">
                <h4 class="card-title">Create/Update Password</h4>
                <hr class="border-success">
                <form action="{{ route('dashboard.update_password') }}" method="POST">
                    {{ csrf_field() }}
                    @if(Auth::User()->password != NULL)
                    <div class="form-group">
                        <label for="current">Current Password:</label>
                        <input type="password" class="form-control" id="current" name="current" required>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="password">New:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm:</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-success m-0">update</button>
                </form>
        </div>
    </div>
</div>
<div class="row adsense">
    @include('partial.ad-square-one')
</div>
<div class="card-body col-sm-10 offset-sm-1 mt-5">
        <h4 class="card-title">Other Information</h4>
        <hr class="border-success">
        <div class="row">
            <div class="col">                
                <form action="{{ route('dashboard.update_info') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="institute">Institute(school/college/univesity):</label>
                        <input type="text" class="form-control" id="institute" name="institute" value="{{ $personalInfo['institute'] }}">
                    </div>
                    <div class="form-group">
                        <label for="level">Level(class/year):</label>
                        <input type="text" class="form-control" id="level" name="level" value="{{ $personalInfo['level'] }}">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="{{ $personalInfo['dob'] }}">
                    </div>
            </div>
            <div class="col offset-sm-1">
                    <div class="form-group">
                        <label for="present">Present Address:</label>
                        <textarea class="form-control" id="present" name="present" rows=2>{{ $personalInfo['present'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="permanent">Permanent Address:</label>
                        <textarea class="form-control" id="permanent" name="permanent" rows=2>{{ $personalInfo['permanent'] }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success m-0">update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('link-act-profile')
active
@endsection

@push('scripts')
<script src="/js/dropzone.js"></script>
@endpush

@push('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endpush


