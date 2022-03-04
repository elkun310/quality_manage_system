<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale())  }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name') }}</title>
    <link rel=icon href="{{ asset('images/logo/favicon.png') }}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('css/all.min.css') }}>
    <!-- Ionicons -->
    <link rel="stylesheet" href={{ asset('css/ionicons.min.css') }}>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href={{ asset('css/tempusdominus-bootstrap-4.min.css') }}>
    <!-- iCheck -->
    <link rel="stylesheet" href={{ asset('css/icheck-bootstrap.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('css/adminlte.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('css/OverlayScrollbars.min.css') }}>
    <!-- Daterange picker -->
    <link rel="stylesheet" href={{ asset('css/daterangepicker.css') }}>
    <link rel="stylesheet" href={{ asset('css/custom/common.css') }}>
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link href="{{ asset('plugins/tagify/tagify.css') }}" rel="stylesheet" type="text/css" />

    @yield('styles')

    <!-- jQuery -->
    <script src={{ asset('js/jquery.min.js') }}></script>
    <!-- jQuery UI 1.11.4 -->
    <script src={{ asset('js/jquery-ui.min.js') }}></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src={{ asset('js/bootstrap.bundle.min.js') }}></script>
    <!-- daterangepicker -->
    <script src={{ asset('js/moment.min.js') }}></script>
    <script src={{ asset('js/daterangepicker.js') }}></script>
    <!-- overlayScrollbars -->
    <script src={{ asset('js/jquery.overlayScrollbars.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('js/adminlte.js') }}></script>
    <!-- InputMask -->
    <script src={{ asset('js/moment.min.js') }}></script>
    <script src={{ asset('js/jquery.inputmask.min.js') }}></script>
    <!-- bs-custom-file-input -->
    <script src={{ asset('js/bs-custom-file-input.min.js') }}></script>
    <script src={{ asset('js/custom/common.js') }}></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/tagify/tagify.min.js') }}"></script>
    <script src="{{ asset('plugins/tagify/tagify.polyfills.min.js') }}"></script>
    @yield('script-files')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper">
{{--    <!-- Preloader -->--}}
{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--        <img class="animation__shake" src={{ asset('images/AdminLTELogo.png') }} alt="AdminLTELogo" height="60" width="60">--}}
{{--    </div>--}}
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('layouts.footer')
</div>

@yield('js')
<script>
    @if( \Illuminate\Support\Facades\Session::has("success-flash") )
    toastr.success("{{ \Illuminate\Support\Facades\Session::get(STR_SUCCESS_FLASH) }}");
    @endif
    @if( \Illuminate\Support\Facades\Session::has("error-flash") )
    toastr.error("{!! \Illuminate\Support\Facades\Session::get(STR_ERROR_FLASH) !!}");
    @endif
</script>
</body>
</html>
