@extends('frontend.layouts.app')
@section('css')
    <style>
        .single-image {
            height: 500px !important;
        }

        .form-control {
            color: white;
        }

        .required {
            color: red;
        }

        .alert {
            background-color: #007bff;
            border-color: red;
            position: fixed;
            padding: 15px;
        }
    </style>
@endsection
@section('content')
    @include('flash::message')

    <div id="singleRoom-banner" class="parallax-container">
        <div class="parallax">
            <img
                src="{{$room->getFirstMedia('room-cover')->getUrl()}}"
            />
        </div>
    </div>
    <nav id="singleRoom-breadcrumb">
        <div class="nav-wrapper center">
            <a href="/" class="breadcrumb grey-text">{{__('lang.Home')}}</a>
            <a href="javascript:void(0)" class="breadcrumb black-text lighten-1"
            >{{$room->type}}</a
            >
        </div>
    </nav>
    <section>
        <div class="singleRoom-page-container">
            <div class="description center">
                <h4 class="green-text center">{{$room->type}}</h4>
                <p class="center">
                    {{$room->description}}
                </p>
                <p>{{__('lang.Capacity')}} : {{$room->capacity}}</p>
                <p>{{__('lang.Room_No')}} : {{$room->room_no}}</p>

            </div>
            <div id="singlePage-room-corousel" class="owl-carousel owl-theme ">
                @foreach($room->getMedia('rooms') as $image)
                    <div class="item" data-aos="flip-left">
                        <div class="single-image">
                            <img class="center" src="{{$image->getUrl()}}"/>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="singleRoom-facilities center">
                <h4>{{__('lang.Facilities')}}</h4>
                <ul class="room-service-list">
                    {!! nl2br(e( $room->facilities)) !!}
                </ul>
            </div>
            <div class="center">
                <form action="{{route('bookingroom.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button class="btn modal-trigger orange " data-target="modal1">
                        {{__('lang.Book_Now')}}
                    </button>
                    <div id="modal1" class="modal bottom-sheet" style="background-color: #0a0a0a">
                        <div class="row">
                            <div class="modal-content col sm12 l9">
                                <input value="{{$room->id}}" name="room_id" required hidden>
                                <div class="col sm12 l4">
                                    <label class="white-text">{{__('lang.From')}} <span class="required">*</span></label>
                                    <input type="text" class="datepicker" name="date_from" placeholder="ARRIVAL"
                                           required
                                           style="color: white" id="datepicker1"/>
                                </div>
                                <div class="col sm12 l4">
                                    <label class="white-text">{{__('lang.To')}}<span class="required">*</span></label>
                                    <input
                                        type="text"
                                        class="datepicker"
                                        placeholder="Departure"
                                        required
                                        style="color: white"
                                        name="date_to"
                                        id="datepicker2"

                                    />
                                </div>
                                <div class="col sm12 l4">
                                    <label class="white-text">{{__('lang.Name')}}<span class="required">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Name"
                                        required
                                        name="name"
                                    />
                                </div>
                                <div class="col sm12 l4">
                                    <label class="white-text">{{__('lang.Email')}} <span class="required">*</span></label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="Mail Address"
                                        required
                                        name="email"
                                    />
                                </div>
                                <div class="col sm12 l4">
                                    <label class="white-text">{{__('lang.Phone_Number')}}<span class="required">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Phone Number"
                                        required
                                        name="number"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn orange black-text modal-close" data-dismiss="modal"
                                    aria-hidden="true">{{__('lang.Close')}}
                            </button>
                            <button class="btn modal-trigger orange black-text" id="submit-button">{{__('lang.submit_now')}}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
    <br>
@endsection

@section('js')
    <script>
        $(function () {
            var disableDate = {!! json_encode($disabledates) !!};
            $('#datepicker1').datepicker({
                setDefaultDate: true,
                autoClose: true,
                {{--defaultDate: new Date("{{(end($dates))?(Carbon\Carbon::parse(end($dates))->addDay()->format('M d,Y')):(\Carbon\Carbon::now('+05:45')->format('M d,Y'))}}"),--}}
                minDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}"),
                disableDayFn: function (date) {
                    var okk = ('0' + (date.getMonth() + 1)).slice(-2) + '-'
                        + ('0' + date.getDate()).slice(-2) + '-'
                        + date.getFullYear();
                    return $.inArray(okk, disableDate) !== -1;
                }
            });
            $('#datepicker2').datepicker({
                setDefaultDate: true,
                autoClose: true,
                {{--defaultDate: new Date("{{(end($dates))?(Carbon\Carbon::parse(end($dates))->addDay()->format('M d,Y')):(\Carbon\Carbon::now('+05:45')->format('M d,Y'))}}"),--}}
                minDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}"),
                disableDayFn: function (date) {
                    var okk = ('0' + (date.getMonth() + 1)).slice(-2) + '-'
                        + ('0' + date.getDate()).slice(-2) + '-'
                        + date.getFullYear();
                    return $.inArray(okk, disableDate) !== -1;
                }
            });
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 3000);
        });
    </script>
@endsection


