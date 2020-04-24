<!--Near-By Section-->
<section id="nearbySection">
    <div class="near-by" data-aos="fade-up">
        <div class="near-by-title">
            <p>{{__('lang.Near_By')}}</p>
            <h5>{{__('lang.Places_to')}} <span class="green-text">{{__('lang.Visit')}}</span></h5>
        </div>
        @foreach($places as $key => $place)
            @if($key == 0)
                <div class="nearby-firstImage" data-aos="zoom-in">
                    <div class="image">
                        <img src="{{asset($place->getFirstMedia('place-cover')->getUrl())}}" alt="{{$place->name}}"/>
                        <div class="overlay"></div>
                    </div>

                    <a href="{{route('single.place',[$place->name])}}" class="btn overlay-btn white"
                    >{{$place->name}}</a
                    >
                </div>
            @endif
        @endforeach
        @foreach($places as $key => $place)
            @if($key != 0)
                <div class="nearby-secondRow" data-aos="zoom-in">
                    <div class="image">
                        <img src="{{asset($place->getFirstMedia('place-cover')->getUrl())}}" alt="{{$place->name}}"/>
                    </div>
                    <div class="overlay"></div>
                    <a href="{{route('single.place',[$place->name])}}" class="btn overlay-btn white"
                    >{{$place->name}}</a
                    >
                </div>
            @endif
        @endforeach

    </div>
</section>
