@extends('adminlte::page')

@section('title', 'Add Rooms')

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
                            <h1 class="m-0 text-dark">{{__('Rooms Booking')}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('rooms.index')}}">{{__('Back')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookingroom.store')}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">From</label>
                            <div class="input-group date " id="datetimepicker1" data-target-input="nearest" >
                                <input type="text" class="form-control datetimepicker-input"
                                       data-target="#datetimepicker1" name="date_from"/>
                                <div class="input-group-addon" data-target="#datetimepicker1"
                                     data-toggle="datetimepicker" id="date">
                                    <div class="input-group-text" style="height: 38px"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">To</label>
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
                            <input type="text" class="form-control" name="email" required value="{{old('email')}}"
                                   placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" name="name" required value="{{old('name')}}"
                                   placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('Address')}}</label>
                            <textarea type="text" class="form-control" name="address" required
                                      placeholder="Address">{{old('address')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{__('Phone Number')}}</label>
                            <input type="number" class="form-control" name="number" required value="{{old('number')}}"
                                   placeholder="Phone Number" min="0">
                        </div>

                        <div class="form-group">
                            <label for="room_number">Room No</label>
                            <select class="form-control" name="room_id">
                                @foreach($rooms as $room)
                                    <option value="{{$room->id}}">{{$room->room_no}}</option>
                                @endforeach
                            </select>

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
            $('#datetimepicker1').datetimepicker({
                defaultDate: "{{\Carbon\Carbon::now('+05:45')}}",
            });
            $('#datetimepicker2').datetimepicker({
                defaultDate: "{{\Carbon\Carbon::now('+05:45')->addDay()}}",
            });
        });
    </script>
@endsection






