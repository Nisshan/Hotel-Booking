<form action="{{route('rooms.available')}}" method="POST">
    @csrf
<div class="booking-header" data-aos="fade-up">
    <div class="booking-title">
        <h6>{{__('lang.BOOK_YOUR')}}</h6>
        <h5>{{__('lang.ROOMS')}}</h5>
    </div>
    <div class="arrival-date">
        <label>{{__('lang.Arrival')}}</label>
        <input
            type="text"
            class="datepicker white-text"
            placeholder="ARRIVAL"
            name="from"
            required
            id="datepicker1"
        />
    </div>
    <div class="departure-date">
        <label>{{__('lang.Departure')}}</label>
        <input
            type="text"
            class="datepicker white-text"
            placeholder="DEPARTURE"
            name="to"
            required
            id="datepicker2"
        />
    </div>
{{--    <div class="adult">--}}
{{--        <div class="input-field col s12 ">--}}
{{--            <label>Persons</label>--}}
{{--            <input type="number" name="number" min="1" max="15" placeholder="No of Persons" required>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="book-now">
        <button class="btn yellow black-text">{{__('lang.Search')}}</button>
    </div>
</div>
</form>
@section('js')
    <script>
        $(function () {
            $('#datepicker1').datepicker({
                setDefaultDate: true,
                autoClose: true,
                minDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}"),
            });
            $('#datepicker2').datepicker({
                setDefaultDate: true,
                autoClose: true,
                minDate: new Date("{{\Carbon\Carbon::now('+05:45')->format('M d,Y')}}")
            });
        });
    </script>
@endsection
