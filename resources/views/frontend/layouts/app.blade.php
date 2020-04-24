<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{setting('app_name')}}</title>
    <link rel="shortcut icon" href="{{asset('/storage'.setting('favicon'))}}" type="image/x-icon">
    <link rel="icon" href="{{asset('/storage/'.setting('favicon'))}}" type="image/x-icon">
    <!-- CSS  -->
    <link href="http://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link
        href="http://fonts.googleapis.com/icon?family=Material+Icons|Roboto|Playfair Display:400,700"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="http://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />
    <link
        rel="stylesheet"
        href="http://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />
    <link
        href="{{asset('frontend/css/style.min.css')}}"
        type="text/css"
        rel="stylesheet"
        media="screen,projection"
    />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.3.5/css/bootstrap.min.css">

    @yield('css')
</head>
<body>
@include('frontend.partials.header')
@yield('content')
@if(setting('footer') == 1)
@include('frontend.partials.footer')
@endif

<script
    src="http://kit.fontawesome.com/eb952a3de6.js"
    crossorigin="anonymous"
></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script
    src="http://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    type="text/javascript"
></script>
<script src="http://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{asset('frontend/js/script.min.js')}}"></script>
@yield('js')
</body>
