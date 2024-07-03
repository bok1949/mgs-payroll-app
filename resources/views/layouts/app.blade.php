
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <meta name="csrf_token" value="{{ csrf_token() }}" />

        <!-- Scripts -->
        {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
        @vite(['resources/sass/app.scss'])
         
        <!-- General CSS Files -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

        <!-- CSS Libraries -->
        @yield('library_style')
        <link href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}">

        <!-- Template CSS -->
        <link rel="stylesheet" rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        @yield('custom_style')

        @livewireStyles
    </head>

    <body>
        <div id="app">
            {{-- @include('layouts.sidebar') --}}
            @yield('nav-bar')
            <div id="main" class='layout-navbar navbar-fixed'>
                {{-- @include('layouts.header') --}}
                @yield('header')
                <div id="main-content">
                    <div class="page-heading">
                        <div class="page-title">
                            <div class="row">
                                @yield('breadcrumb')
                            </div>
                        </div>
                        <section class="section">
                            @yield('content')
                        </section>
                    </div>
                </div>

                @yield('footer')
            </div>
        </div>

        @yield('modal')

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

        <!-- JS Libraies -->
        @yield('library_script')

        <!-- Page Specific JS File -->
        <script src="{{ asset('assets/js/default.js') }}"></script>
        <script src="{{ asset('assets/js/setup-ajax.js') }}"></script>
        @yield('custom_script')

        @livewireScripts

        <script>
            document.addEventListener('livewire:load', () => {
                Livewire.onPageExpired((response, message) => {})
            })
        </script>
    </body>
</html>
