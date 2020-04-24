<section class="room-accomodation">
    <div class="room-accomodation-title" data-aos="fade-up">
        <p>{{__('lang.Room_Accommodation')}}</p>
        <h5>
           {{__('lang.Surround_you_with')}}<span class="green-text"> {{__('lang.Breezy_Comfort')}}</span>
        </h5>
    </div>

    <div id="room-accomodation-corousel" class="owl-carousel owl-theme">
        @foreach($rooms as $room)
            <div class="item" data-aos="zoom-in">
                <div class="card single-room">
                    <div class="card-image">
                        <img src="{{asset($room->getFirstMedia('room-cover')->getUrl())}}"/>
                    </div>
                    <div class="card-content">
                        <h5>{{__('lang.Type')}} {{$room->type}}</h5>
                        <p>{{__('lang.Capacity')}} {{$room->capacity}}</p>
                        <p>{{__('lang.Room_No')}} {{$room->room_no}}</p>
                        <div class="price-book">
                            <a class="btn blue" href="{{route('single.room',[$room->room_no])}}">{{__('lang.Details')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="view-all">
        <a href="/rooms" class="btn">{{__('lang.View_All')}}</a>
    </div>
</section>
