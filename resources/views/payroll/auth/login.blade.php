@extends('layouts.blank-app')

@section('title', 'Payroll-Employee Management Login')

@section('library_style')
{{--
<link rel="stylesheet" href="{{ asset('assets/vendor/toastify-js/src/toastify.css') }}"> --}}
@endsection

@section('custom_style')
<style>
.auth-logo img {
    width: 120px;
    height: 80px;
    overflow: hidden;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row" >
        <div class="col-md-6 col-sm-12 col-6" @style(['margin:auto'])>
            <div class="auth-logo my-2">
                <a href="#">
                    <img src="{{ asset('assets/images/svg/mgs-logo-2.svg') }}" alt="Logo">
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Log in</h4>
                </div>
                <div class="card-content">
                    @if(Session::has('errorMessage'))
                    <div class="alert alert-danger my-1 col-md-9 offset-2 text-center">
                        {{ Session::get('errorMessage') }}
                    </div>
                    @endIf
                    <div class="card-body">
                        <form action="{{ route('post.login') }}" method="POST" class="form">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input 
                                                    type="text" 
                                                    name="username" 
                                                    class="form-control @error('username') is-invalid @enderror" 
                                                    placeholder="User Name..."
                                                    value="{{old('username')}}"
                                                >
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input 
                                                    type="password" 
                                                    name="password" 
                                                    class="form-control @error('password') is-invalid @enderror" 
                                                    placeholder="Password"
                                                >
                                                <div class="form-control-icon">
                                                    <i class="bi bi-lock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="text-sm text-end">
                            <p><a class="fw-bold text-muted" href="#">Forgot password?</a>.</p>
                        </div>
                    </div>

                    <div class="card-footer">
                        <p>{{ \Carbon\Carbon::now()->format('Y') }} &copy; MGS-Payroll App</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

