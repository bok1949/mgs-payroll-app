@extends('layouts.app')

@section('title', 'Payroll-User Account Settings')

@section('custom_style')

@endsection

@section('library_style')
<link rel="stylesheet" href="{{ asset('assets/vendor/toastify-js/src/toastify.css') }}">
@endsection

@section('nav-bar')
@include('payroll.payroll-layouts.payroll-sidebar')
@endsection

@section('header')
@include('payroll.payroll-layouts.payroll-header')
@endsection

@section('breadcrumb')
<div class="col-12 col-md-6 order-md-1 order-last">
    <h3>Account Settings</h3>
</div>
<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('payroll-dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header border-bottom mb-3">
                    <h5 class="card-title">Change Password</h5>
                    <h6 class="card-subtitle text-muted">
                        <span class="text-warning fw-bolder">NOTE:</span>
                        Labels with <span class="text-danger">*</span> are
                        required fields.
                    </h6>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                    <div class="alert alert-light-danger color-danger alert-dismissible show fade mb-2 text-center"
                        role="alert">
                        <i class="bi bi-exclamation-circle float-start"></i>
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endIf
                    
                    <form action="{{ route('account.settings.saveNewPassword') }}" method="POST">
                        @csrf
                        <div class="form-group my-2 has-icon-right">
                            <label for="current_password" class="form-label">
                                Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input 
                                    type="password" 
                                    name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror" 
                                    placeholder="Enter current password..."
                                    value="{{ old('current_password') }}"
                                >

                                <div class="form-control-icon" role="button">
                                    <i 
                                        class="bi bi-eye"
                                        id="current_password"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top"
                                        title="Show password!"
                                    ></i>
                                </div>
                            </div>
                            @error('current_password') <span class="text-danger">{{ $message }}</span>@enderror
                            @if (Session::has('errorPasswordNotMatch'))
                                <span class="text-danger">{{ Session::get('errorPasswordNotMatch') }}</span>
                            @endif
                        </div>
                        <div class="form-group my-2 has-icon-right">
                            <label for="password" class="form-label">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input 
                                    type="password" 
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter new password..."
                                    value="{{ old('password') }}"
                                >
                                <div class="form-control-icon" role="button">
                                    <i 
                                        class="bi bi-eye" 
                                        id="password" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top"
                                        title="Show password!"
                                    ></i>
                                </div>
                            </div>
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                            @if (Session::has('errorCurrentAndNewAreSame'))
                                <span class="text-danger">{{ Session::get('errorCurrentAndNewAreSame') }}</span>
                            @endif
                        </div>
                        <div class="form-group my-2 has-icon-right">
                            <label for="password_confirmation" class="form-label">
                                Confirm password <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Enter confirm password..."
                                    value="{{ old('password_confirmation') }}"
                                >
                                <div class="form-control-icon" role="button">
                                    <i 
                                        class="bi bi-eye" 
                                        id="password_confirmation" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Show password!"
                                    ></i>
                                </div>
                            </div>
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span>@enderror                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header border-bottom mb-3">
                    <h5 class="card-title">Change Username</h5>
                    <h6 class="card-subtitle text-muted">
                        <span class="text-warning fw-bolder">NOTE:</span>
                        Labels with <span class="text-danger">*</span> are
                        required fields.
                    </h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group my-2">
                            <label for="current_username" class="form-label">
                                Current Username: {{ Auth::user()->getUserUserName() }}
                            </label>
                        </div>
                        <div class="form-group my-2">
                            <label for="username" class="form-label">
                                New Username <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="username" 
                                class="form-control @error('username') is-invalid @enderror"
                                placeholder="Enter new username..."
                            >
                            @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="password" class="form-label">
                                Enter your password <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="password" 
                                name="password_confirm"
                                class="form-control @error('password_confirm') is-invalid @enderror"
                                placeholder="Enter password...">
                            @error('password_confirm') <span class="text-danger">{{ $message }}</span>@enderror
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

{{-- @section('library_script')
<script src="{{asset('assets/vendor/toastify-js/src/toastify.js')}}"></script>
@endsection
 --}}

@section('custom_script')
<script>
    $(document).ready(function() {
        // Enable Bootstrap tooltips on page load
        $('[data-bs-toggle="tooltip"]').tooltip();

        $("#current_password").on('click', function(e) {
            e.stopPropagation();

            toggleShowHidePassword($(this), 'current_password');
        });

        $("#password").on('click', function(e) {
            e.stopPropagation();

            toggleShowHidePassword($(this), 'password');
        });

        $("#password_confirmation").on('click', function(e) {
            e.stopPropagation();

            toggleShowHidePassword($(this), 'password_confirmation');
        });
    });


    function toggleShowHidePassword(element, inputName)
    {
        if ($(element).hasClass('bi-eye')) {
            $(element).addClass('bi-eye-slash').removeClass('bi-eye');
            $(element).attr('title', 'Hide password').tooltip('_fixTitle').tooltip('show');
            $('input[name="' + inputName + '"]').attr("type", "text");
        } else {
            $(element).addClass('bi-eye').removeClass('bi-eye-slash');
            $(element).attr('title', 'Show password').tooltip('_fixTitle').tooltip('show');
            $('input[name="' + inputName + '"]').attr("type", "password");
        }
    }


</script>


@endsection