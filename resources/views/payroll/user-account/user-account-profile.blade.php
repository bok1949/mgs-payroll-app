@extends('layouts.app')

@section('title', 'Payroll-User Account Profile')

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
    <h3>Account Profile</h3>
</div>
<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('payroll-dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <h3 class="mt-3">{{ Auth::user()->getUserFullName() }}</h3>
                        <p class="text-small">{{ Auth::user()->userRole() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header border-bottom mb-3">
                    <h6 class="card-subtitle text-muted">
                        <span class="text-warning fw-bolder">NOTE:</span> 
                        Labels with <span class="text-danger">*</span> are
                        required fields.
                    </h6>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div 
                            class="alert alert-light-danger color-danger alert-dismissible show fade mb-2 text-center" 
                            role="alert"
                        >
                            <i class="bi bi-exclamation-circle float-start"></i>
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endIf
                    @if(Session::has('success'))
                        <div 
                            class="alert alert-light-success color-success alert-dismissible show fade mb-2 text-center" 
                            role="alert"
                        >
                            <i class="bi bi-check-circle float-start"></i>
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endIf

                    <form action="{{ route('post.accountProfile') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="first_name" class="form-label">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="first_name" 
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ Auth::user()->getFirstName() }}"
                                placeholder="First name..."
                            >
                            @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="form-label">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="last_name" 
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ Auth::user()->getLastName() }}"
                                placeholder="Last name..."
                            >
                            @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="form-label">
                                Mobile number
                            </label>
                            <input 
                                type="number" 
                                name="mobile" 
                                class="form-control @error('mobile') is-invalid @enderror"
                                value="{{ Auth::user()->getUserMobile() }}"
                                placeholder="Mobile number..."
                            >
                            @error('mobile') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email address <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ Auth::user()->getUserEmail() }}"
                                placeholder="Email address..."
                            >
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
@include('payroll.payroll-layouts.payroll-footer')
@endsection
