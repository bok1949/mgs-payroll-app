@extends('layouts.app')

@section('title', 'Payroll-Payroll Management')

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
    <h3>Manage Employee Cash Advances</h3>
</div>
<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('payroll-dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee cash advances</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<section class="section">
    <div class="row ">
        <div class="col-12 col-md-12">
            @livewire('payroll.payroll-management.employee-cash-advance-index')
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
<script>
    $(document).ready(function() {
    
        // Enable Bootstrap tooltips on page load
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Ensure Livewire updates re-instantiate tooltips
        if (typeof window.Livewire !== 'undefined') {
            window.Livewire.hook('message.processed', (message, component) => {
                $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
            });
        }
    
    });
</script>
@endsection