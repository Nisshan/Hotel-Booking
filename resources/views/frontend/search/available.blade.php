@extends('frontend.layouts.app')
@section('content')
    <section id="booking-section">
        <div class="booking-section-title">
            <h4>
                Rooms Available
            </h4>
        </div>

        <div class="booking-details">
            <div class="booking-date">
                <p>
                    Your Stay: <strong> {{\Carbon\Carbon::parse($time_from)->format('d M Y')}}
                        - {{\Carbon\Carbon::parse($time_to)->format('d M Y')}}</strong>
                </p>
                <p>
                    <a href="" class=" modal-trigger orange-text" data-target="modal1"
                    >Modify</a
                    >
                </p>
            </div>
        </div>
    </section>
    <section id="available-rooms">
        @if(!empty($rooms))
            @foreach($rooms as $room)
                <div class="booking-room-container">
                    <div class="booking-room-image">
                        <a>
                            <img src="{{$room->getFirstMedia('room-cover')->getUrl()}}"/>
                        </a>
                    </div>
                    <div class="booking-room-description">
                        <a href="{{route('single.room',[$room->room_no])}}">
                            <h4 class="green-text">{{$room->type}}</h4>
                        </a>
                        <p>
                            {{  $room->description }}
                        </p>
                        <div class="room-price">
                            <p>

                                <sup> Rs: </sup>{{$room->price}} <br/><sup>Including Taxes & Fees</sup>
                            </p>
                            <a href="{{route('single.room',[$room->room_no])}}" class="book-now orange black-text">
                                More Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <p style="right: 50px">No rooms available for Now</p>
            </div>
        @endif

        <div id="modal1" class="modal bottom-sheet">
            <form action="{{route('available.rooms')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="modal-content col sm12 l9">
                        <div class="col sm12 l4">
                            <label class="black-text">Arrival</label>
                            <input type="text" class="datepicker" placeholder="ARRIVAL" name="from" required id="datepicker1"/>
                        </div>
                        <div class="col sm12 l4">
                            <label class="black-text">Departure</label>
                            <input type="text" class="datepicker" placeholder="Departure" name="to" id="datepicker2" required/>
                        </div>
                    </div>
                    <div class="col sm12 l3" id="single-room-book-now"></div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn orange black-text modal-close" data-dismiss="modal"
                            aria-hidden="true">{{__('Close')}}
                    </button>
                    <button
                        class="btn modal-close waves-effect waves-green btn-flat orange ">Conform
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function () {
            $('#datepicker1').datepicker({
                setDefaultDate: true,
                autoClose: true,
                defaultDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}"),
                minDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}"),
            });
            $('#datepicker2').datepicker({
                setDefaultDate: true,
                autoClose: true,
                defaultDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}"),
                minDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}")
            });
        });
    </script>
@endsection
