@extends('layouts.app')

@section('title', 'Payroll-Dashboard')

@section('library_style')

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
    <h3>Payroll Dashboard</h3>
</div>
<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('payroll-dashboard') }}">Dashboard</a></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
@endsection

@section('footer')
    @include('payroll.payroll-layouts.payroll-footer')
@endsection

@section('modal')

@endsection

@section('library_script')

@endsection

@section('custom_script')

@endsection