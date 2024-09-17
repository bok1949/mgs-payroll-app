<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <meta name="csrf_token" value="{{ csrf_token() }}" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])

    <!-- General CSS Files -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- CSS Libraries -->
    @yield('library_style')
    <link href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('custom_style')

</head>

<body>
    <div id="app">
        <div id="main-content">
            <section class="section">
                @yield('content')
            </section>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- JS Libraies -->
    @yield('library_script')

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/default.js') }}"></script>
    
    <script>
        $(document).ready(function() {
        
            // Enable Bootstrap tooltips on page load
            $('[data-bs-toggle="tooltip"]').tooltip();
            
            // Ensure Livewire updates re-instantiate tooltips
            /* if (typeof window.Livewire !== 'undefined') {
                window.Livewire.hook('message.processed', (message, component) => {
                    $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
                });
            } */
        
        });
    </script>
        
    @yield('custom_script')
        
</body>

</html>