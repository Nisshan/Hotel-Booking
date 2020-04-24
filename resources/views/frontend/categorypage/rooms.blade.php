@extends('frontend.layouts.app')
@section('content')
    <div id="singlePage-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="header-container">
                <h1 class="header center">
                    {{__('lang.Room')}} <span class="green-text">{{__('lang.Accommodation')}}</span>
                </h1>
            </div>
        </div>
        <div class="parallax">
            <img src="{{asset('/storage/'. setting('room-cover'))}}"/>
        </div>
    </div>
    <section>
        <div class="description center" data-aos="fade-up">
            <p>
                {{setting('room-description')}}
            </p>
        </div>
        @foreach($rooms as $key =>$room)

            <div class="room-container" data-aos="fade-up">
                @if($key % 2 == 1)
                    <div class="room-image">
                        <a href="{{route('single.room',[$room->room_no])}}">
                            <img src="{{asset($room->getFirstMedia('room-cover')->getUrl())}}"/>
                        </a>
                    </div>
                @endif
                <div class="room-description lime lighten-5">
                    <h4 class="green-text">{{$room->type}}</h4>
                    <p>
                        {{$room->description}}
                    </p>
                    <h6>{{__('lang.Capacity')}} : {{$room->capacity}}</h6>
                    <h6>{{__('lang.Price')}} : {{__('lang.Rs')}} {{$room->price}}</h6>
                    <h6> {{__('lang.Room_No')}} : {{$room->room_no}}</h6>
                    <a href="{{route('single.room',[$room->room_no])}}"
                       class="further-details">{{__('lang.More_Details')}}</a>
                </div>
                @if($key % 2 == 0)
                    <div class="room-image">
                        <a href="{{route('single.room',[$room->room_no])}}">
                            <img src="{{asset($room->getFirstMedia('room-cover')->getUrl())}}"/>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </section>
@endsection
