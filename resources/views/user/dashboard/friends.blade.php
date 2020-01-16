@extends('layouts.dashboard_master')
@section('title','Friends')
@section('dashboard-content')

    <div class="card-header text-center">        
        <form class="form-inline">
            <div class="form-group mx-sm-3">
                <input type="text" class="form-control" id="" placeholder="type name.." required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Find</button>
        </form>
    </div>

    <div class="card-body">
        <h2>Friends</h2>
        <div class="row adsense">
            @include('partial.ad-square-one')
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Rating</th>
                <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
            @foreach($friends as $friend)
                <tr>
                <td><a href="{{ route('user_profile',['id'=>$friend->id, 'name'=>Str::slug($friend->name) ]) }}">{{ $friend->name }}</a></td>
                <td>-</td>
                <td><a href="#" class="btn btn-warning px-3 py-1" id="{{ $friend->id }}" onclick="removeFriend(this.id)"><i class="fa fa-trash-o "></i></a></td>
                </tr>
            @endforeach            
            </tbody>
        </table>
    </div>


@endsection

@section('link-act-friends')
active
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="/js/friend.js"></script>
@endpush