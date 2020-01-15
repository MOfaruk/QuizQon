@extends('layouts.dashboard_master')

@section('dashboard-content')

@endsection
@section('link-act-settings')
active
@endsection

@push('scripts')
<script src="/js/dropzone.js"></script>
@endpush

@push('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endpush


