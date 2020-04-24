{{--You received a message from : {{setting('email') }}--}}

@if($status == 1 )
    <p>Thank you for Booking Room with us <b>{{$name}}</b>.
        <br>Your Room have been booked from {{\Carbon\Carbon::parse($to)->format('Y M d')}} to {{\Carbon\Carbon::parse($from)->format('Y M d')}}.
        <br>If anything goes wrong or you want to cancel your room booking<br>
        please contact us at {{setting('phone_number')}} </p>

@elseif($status == 0)
    <p>Thank you <b>{{$name}}</b> for Contacting us But This room is not available at the moment.
        <br>You can contact and query for
       available room at {{setting('phone_number')}}.
        <br>Thank You </p>
@endif

