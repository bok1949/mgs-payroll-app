@extends('layouts.app')

@section('title', 'Payroll-Working Site Management')

@section('library_style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastify-js/src/toastify.css') }}">
@endsection

@section('custom_style')

@endsection

@section('nav-bar')
@include('payroll.payroll-layouts.payroll-sidebar')
@endsection

@section('header')
@include('payroll.payroll-layouts.payroll-header')
@endsection

@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Working Sites</h3>
</div>
<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('payroll-dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">List of Sites</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<section class="section">
    <div class="row ">
        <div class="col-12 col-md-12">
            @livewire('payroll.working-site-management.working-site-index')
        </div>
    </div>
</section>
@endsection

@section('footer')
@include('payroll.payroll-layouts.payroll-footer')
@endsection

@section('modal')

@endsection

@section('library_script')
<script src="{{asset('assets/vendor/toastify-js/src/toastify.js')}}"></script>
@endsection

@section('custom_script')

@endsection