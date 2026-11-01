<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{config('app.name')}}</title>
    {{--Google fonts--}}
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    {{--Font Awesome--}}
    <link href="{{asset('frontEnd/plugins/font-awesome/font-awesome.css')}}" rel="stylesheet">
    {{--Bootstrap CSS--}}
    <link rel="stylesheet" href="{{asset('frontEnd/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontEnd/css/custom.css')}}">

    {{--toastr--}}
    <link rel="stylesheet" type="text/css" href="{{asset('frontEnd/plugins/toastr/toastr.min.css')}}">

    {{--Owl-Carousel--}}
    <link rel="stylesheet" href="{{asset('frontEnd/plugins/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontEnd/plugins/owl-carousel/owl.theme.default.min.css')}}">
    @yield('style')

    {!! $web_settings->fb_pixel ?? null !!}

    {{-- GTM HEAD --}}
    {!! $web_settings->gtm_head ?? null !!}
</head>
<body>
{{-- GTM BODY --}}
{!! $web_settings->gtm_body ?? null !!}

@yield('fb_share')
<div class="main-wrapper">
    @include('frontEnd.inc.header')

    @yield('body')

    @include('frontEnd.inc.footer')
</div>

{{--<script src="{{asset('frontEnd/js/jquery.slim.min.js')}}"></script>--}}
<script src="{{asset('frontEnd/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('frontEnd/js/bootstrap.bundle.min.js')}}"></script>
{{--toastr--}}
<script src="{{asset('frontEnd/plugins/toastr/toastr.min.js')}}"></script>
{{--Owl-Carousel--}}
<script src="{{asset('frontEnd/plugins/owl-carousel/owl.carousel.min.js')}}"></script>

<script>
    $('#account-btn').on('click', function () {$('.login-float').toggle()});$('#header-top-menu-btn').on('click', function () {$('.header-top-menu-m').toggle()});$('#cat_menu_mobile_btn').on('click', function () {$('.cat_menu_m').toggle()});$('#search_mobile_btn').on('click', function () {$('.search-form-m').toggle()});$('.search_btnclose').on('click', function () {$('.search-form-m').toggle()});

    @if(session()->has('success'))
        toastr.options = {
        "positionClass": "toast-bottom-left"
    };
    toastr.success("{{ session('success') }}");
    @endif
        @if(Session::has('error'))
        toastr.options = {
        "positionClass": "toast-bottom-left"
    };
    toastr.error("{{ session('error') }}");
    @endif
        @if(Session::has('info'))
        toastr.options = {
        "positionClass": "toast-bottom-left"
    };
    toastr.info("{{ session('info') }}");
    @endif
        @if(Session::has('warning'))
        toastr.options = {
        "positionClass": "toast-bottom-left"
    };
    toastr.warning("{{ session('warning') }}");
    @endif
</script>

@yield('script')
</body>
</html>
