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
                            <h1 class="m-0 text-dark">{{__('Rooms')}}</h1>
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
                    <form action="{{ route('rooms.store')}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        <div class="form-group">
                            <label for="cover">Cover</label>
                            <input type="file" name="cover" class="form-control" id="cover" >
                        </div>
                        <div class="form-group">
                            <label for="images">Images</label>
                            <input type="file" name="images[]" class="form-control" id="images" multiple>
                        </div>
                        <div class="form-group">
                            <label for="type"> Room Type</label>
                            <select class="form-control" name="type" required>
                                @foreach(config('rooms_type.types') as $types)
                                     <option value="{{$types}}">{{$types}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="room_no">{{__('Room no')}}</label>
                            <input type="text" class="form-control" name="room_no" required value="{{old('room_no')}}" id="room_no">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('description')}}</label>
                            <textarea class="form-control" name="description" required>{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{__('Facilities')}}</label>
                            <textarea class="form-control" name="facilities" required>{{old('facilities')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{__('Price')}}</label>
                            <input type="number" class="form-control" name="price" required value="{{old('price')}}" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{__('Capacity')}}</label>
                            <input type="number" class="form-control" name="capacity" required value="{{old('capacity')}}" placeholder="No of People that can live">
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






