<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{URL::asset('assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/css/core.css')}}" class=" template-customizer-core-css" />
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Helpers -->
    <script src="{{URL::asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{URL::asset('assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{URL::asset('assets/js/config.js')}}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @yield('mainContent')
            <!-- Core JS -->
            <!-- build:js assets/vendor/js/core.js -->
            <script src="{{URL::asset('assets/vendor/libs/popper/popper.js')}}"></script>
            <script src="{{URL::asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
            <script src="{{URL::asset('assets/vendor/js/bootstrap.js')}}"></script>
            <script src="{{URL::asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
            <script src="{{URL::asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
            <script src="{{URL::asset('assets/vendor/js/menu.js')}}"></script>
            <script src="{{URL::asset('assets/vendor/js/bootstrap.js')}}"></script>
            <!-- endbuild -->

            <!-- Main JS -->
            <script src="{{URL::asset('assets/js/main.js')}}"></script>

            <!-- Vendors JS -->
            <script src="{{URL::asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

            <!-- Page JS -->
            <script src="{{URL::asset('/assets/js/dashboards-analytics.js')"></script>

        </div>
    </div>
</body>
</html>