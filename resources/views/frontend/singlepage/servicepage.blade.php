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
                src="{{$service->getFirstMedia('services')->getUrl()}}"
            />
        </div>
    </div>
    <nav id="singleRoom-breadcrumb">
        <div class="nav-wrapper center">
            <a href="/" class="breadcrumb grey-text">{{__('Home')}}</a>
            <a href="javascript:void(0)" class="breadcrumb black-text lighten-1"
            >{{$service->name}}</a
            >
        </div>
    </nav>
    <section>
        <div class="singleRoom-page-container">
            <div class="description center">
                <h4 class="green-text center">{{$service->name}}</h4>
                <p class="center">
                    {{$service->description}}
                </p>
            </div>
        </div>
    </section>
    <br>
@endsection
