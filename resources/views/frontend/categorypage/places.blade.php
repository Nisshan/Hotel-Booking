@extends('frontend.layouts.app')
@section('content')
    <div id="singlePage-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="header-container">
                <h1 class="header center">
                   {{__('lang.places_to')}} <span class="green-text">{{__('lang.visit_nearby')}}</span>
                </h1>
                <div class="row center">
                    <h5 class="header col s12 light"></h5>
                </div>
            </div>
        </div>
        <div class="parallax">
            <img
                src="{{asset('/storage/'. setting('place-image'))}}"
            />
        </div>
    </div>

    <section>
        @if(setting('show-place-desc') == 1)
        <div class="description center" data-aos="fade-up">
            <p class="center">
               {{setting('place-description')}}
            </p>
        </div>
        @endif
        @foreach($places as $key => $place)
            <div class="room-container" data-aos="fade-up">
                @if($key % 2 == 0)
                    <div class="room-image">
                        <a href="{{route('single.place',[$place->name])}}">
                            <img src="{{$place->getFirstMedia('places')->getUrl()}}"/>
                        </a>
                    </div>
                @endif
                <div class="room-description lime lighten-5">
                    <a href="{{route('single.place',[$place->name])}}">
                        <h4 class="green-text">{{$place->name}}</h4>
                    </a>
                    <p>
                        {{$place->description}}
                    </p>
                    <a href="{{route('single.place',[$place->name])}}"
                       class="further-details">{{__('more_details')}}</a>
                </div>
                @if($key % 2 == 1)
                    <div class="room-image">
                        <img src="{{$place->getFirstMedia('places')->getUrl()}}"/>
                    </div>
                @endif
            </div>
        @endforeach
    </section>
@endsection
