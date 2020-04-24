@extends('frontend.layouts.app')
@section('content')
    <div id="singlePage-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="header-container">
                <h1 class="header center">
                    {{__('lang.Our_Facilities_and')}}<span class="green-text"> {{__('lang.Services')}}</span>
                </h1>
                <div class="row center">
                    <h5 class="header col s12 light"></h5>
                </div>
            </div>
        </div>
        <div class="parallax">
            <img
                src="{{asset('/storage/'. setting('service-cover'))}}"
                alt="Unsplashed background img 1"
            />
        </div>
    </div>

    <section>
        @if(setting('show-service-desc') == 1)
        <div class="description center" data-aos="fade-up">
            <p class="center" >
                {{setting('service-description')}}
            </p>
        </div>
        @endif
        @foreach($services as $key => $service)
            <div class="room-container" data-aos="fade-up">
                @if($key % 2 == 0)
                    <div class="room-image">
                            <img src="{{$service->getFirstMedia('services')->getUrl()}}"/>
                    </div>
                @endif
                <div class="room-description lime lighten-5">
                        <h4 class="green-text">{{$service->name}}</h4>
                    <p>
                       {{$service->description}}
                    </p>
                    <a href="{{route('single.service',[$service->name])}}"
                       class="further-details">{{__('More_Details')}}</a>
                </div>
                @if($key % 2 == 1)
                    <div class="room-image">
                        <img src="{{$service->getFirstMedia('services')->getUrl()}}"/>
                    </div>
                @endif
            </div>
        @endforeach
    </section>
@endsection
