<section class="room-accomodation">
    <div class="room-accomodation-title" data-aos="fade-up">
        <p>{{__('Room Accomodation')}}</p>
        <h5>
           {{__(' Surround you with')}}<span class="green-text"> {{__('breezy comfort')}}</span>
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
                        <h5>{{__('Type')}} {{$room->type}}</h5>
                        <p>{{__('Capacity')}} {{$room->capacity}}</p>
                        <p>{{__('Room No')}} {{$room->room_no}}</p>
                        <div class="price-book">
                            <a class="btn blue" href="{{route('single.room',[$room->room_no])}}">{{__('Details')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="view-all">
        <a href="/" class="btn">{{__('View All')}}</a>
    </div>
</section>
