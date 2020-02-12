@extends('frontend.layouts.app')
@section('css')
    <style>
        .single-image {
            height: 500px !important;
        }
    </style>
@endsection
@section('content')
    <div id="singleRoom-banner" class="parallax-container">
        <div class="parallax">
            <img
                src="{{$place->getFirstMedia('place-cover')->getUrl()}}"
            />
        </div>
    </div>
    <nav id="singleRoom-breadcrumb">
        <div class="nav-wrapper center">
            <a href="/" class="breadcrumb grey-text">{{__('Home')}}</a>
            <a href="javascript:void(0)" class="breadcrumb black-text lighten-1"
            >{{$place->name}}</a
            >
        </div>
    </nav>
    <section>
        <div class="singleRoom-page-container">
            <div class="description center">
                <h4 class="green-text center">{{$place->name}}</h4>
                <p class="center">
                    {{$place->description}}
                </p>
            </div>
            <div id="singlePage-room-corousel" class="owl-carousel owl-theme ">
                @foreach($place->getMedia('places') as $image)
                    <div class="item" data-aos="flip-left">
                        <div class="single-image">
                            <img class="center" src="{{$image->getUrl()}}"/>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="singleRoom-facilities center">
                <h4>{{__('Travel Guide')}}</h4>
                <ul class="room-service-list">
                    {!! nl2br(e( $place->travel_description)) !!}
                </ul>
            </div>
        </div>
    </section>
    <br>
@endsection
