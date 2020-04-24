@extends('adminlte::page')

@section('title', 'Edit Rooms')

@section('content')
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="card-primary">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6 card-title">
                            <h1 class="m-0 text-dark">{{__('Rooms_Booking')}}</h1>
                        </div>
                        <div class="col-sm-6">
{{--                            <ol class="breadcrumb float-sm-right">--}}
{{--                                <li class="breadcrumb-item"><a href="{{route('rooms.index')}}">{{__('Back')}}</a>--}}
{{--                                </li>--}}
{{--                            </ol>--}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('booking.update',[$booking->id])}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        @method('Patch')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date">{{__('From')}}</label>
                                <div class="input-group date " id="datetimepicker1" data-target-input="nearest" >
                                    <input type="text" class="form-control datetimepicker-input"
                                           data-target="#datetimepicker1" name="date_from" value="{{$booking->from}}"/>
                                    <div class="input-group-addon" data-target="#datetimepicker1"
                                         data-toggle="datetimepicker" id="date">
{{--                                        <div class="input-group-text" style="height: 38px"><i class="fa fa-calendar"></i></div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">{{__('To')}}</label>
                                <div class="input-group date " id="datetimepicker2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                           data-target="#datetimepicker2" name="date_to"/>
                                    <div class="input-group-addon" data-target="#datetimepicker2"
                                         data-toggle="datetimepicker" id="date">
                                        <div class="input-group-text" style="height: 38px"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="text" class="form-control" name="email"  value="{{$booking->email}}"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" name="name"  value="{{$booking->name}}"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('Address')}}</label>
                            <textarea type="text" class="form-control" name="address"
                                      readonly>{{$booking->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{__('Phone_Number')}}</label>
                            <input type="text" class="form-control" name="number"  value="{{$booking->number}}"
                                    readonly>
                        </div>

                        <div class="form-group">
                            <label for="room_number">{{__('Room_No')}}</label>
                            <input type="text" value="{{$booking->room->room_no}}" class="form-control" readonly>
{{--                            <select class="form-control" name="room_id">--}}
{{--                                @foreach($rooms as $room)--}}
{{--                                    <option value="{{$room->id}}">{{$room->room_no}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}

                        </div>

                        <div class="form-group">
                            <div class="radio">
                                <label><b>{{__('Status')}}</b> <br><input type="radio" name="status" value="1" {{$booking->status == 1 ? 'checked' : ''}}
                                    >{{__('Accept')}}</label> <br>

                                <label><input type="radio" name="status" value="0" {{$booking->status == 0 ? 'checked' : ''}}
                                    >{{__('Reject')}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            {{--$('#datetimepicker1').datetimepicker({--}}
            {{--    defaultDate: "{{\Carbon\Carbon::now('+05:45')}}",--}}
            {{--});--}}
            $('#datetimepicker2').datetimepicker({
                defaultDate: "{{\Carbon\Carbon::now('+05:45')->addDay()}}",
            });
        });
    </script>
@endsection






