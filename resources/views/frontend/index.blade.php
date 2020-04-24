@extends('frontend.layouts.app')

@section('content')
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="header-container">
                <h1 class="header center" data-aos="fade-in">
                    {{setting('app_name')}}
                </h1>
            </div>
        </div>
        <div class="parallax">
            <img
                src="{{asset('/storage/'.setting('home-image'))}}"
                alt="Unsplashed background img 1"
            />
        </div>
    </div>
    @include('frontend.sites.search')

    @if(setting('about') == 1)
        @include('frontend.sites.about-us')
    @endif


    @if(setting('rooms') == 1)
        @include('frontend.sites.rooms')
    @endif


    @if(setting('service') == 1)
        @include('frontend.sites.services')
    @endif

    @if(setting('places') == 1)
        @include('frontend.sites.places')
    @endif

    @if(setting('testimonial') == 1)
        @include('frontend.sites.testimonials')
    @endif

    @if(setting('map') == 1)
        @include('frontend.sites.map')
    @endif
@endsection
