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
                    <form action="{{ route('rooms.update',[$room->id])}}" method="POST" id="formid"
                          enctype=multipart/form-data>
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="cover">{{__('Cover Photo')}}</label>
                            <input type="file" placeholder="image" name="cover" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Images')}}</label>
                            <input type="file" placeholder="image" name="images[]" multiple class="form-control">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="type" required>
                                @foreach(config('rooms_type.types') as $type)
                                    <option
                                        value="{{$type}}" {{$room->type == $type ? 'selected' : '' }}>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('description')}}</label>
                            <textarea class="form-control" name="description" required>{{$room->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{__('Facilities')}}</label>
                            <textarea class="form-control" name="facilities" required>{{$room->facilities}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label><b>{{__('Status')}}</b> <br><input type="radio" name="status" {{$room->status == 1 ? 'checked' : ''}}
                                                                          value="1">{{__('Active')}}</label>

                                <label><input type="radio" name="status" {{$room->status == 0 ? 'checked' : ''}}
                                              value="0">{{__('Inactive')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="facilities">{{__('Price')}}</label>
                            <input type="number" class="form-control" name="price" required value="{{$room->price}}" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{__('Capacity')}}</label>
                            <input type="number" class="form-control" name="capacity" required value="{{$room->capacity}}" placeholder="No of People that can live">
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






