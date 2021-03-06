@extends('adminlte::page')

@section('title', 'Add Places')
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
                            <h1 class="m-0 text-dark">{{__('Places')}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('places.index')}}">{{__('Back')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('places.update',[$place->id])}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">{{__('Name')}}</label>
                            <input type="text" class="form-control" placeholder="Name of place"
                                   name="name" id="name" required value="{{$place->name}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('Description')}}</label>
                            <textarea class="form-control" placeholder="Description of Place"
                                      name="description" id="description"
                                      required>{{$place->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="cover">{{__('Cover Photo')}}</label>
                            <input type="file" placeholder="image" name="cover" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Photos')}}</label>
                            <input type="file" placeholder="image" name="images[]" multiple class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="travel_description">{{__('Travel Guide')}}</label>
                            <textarea class="form-control" placeholder="Description of Travel"
                                      name="travel_description" id="travel_description"
                                      required>{{$place->travel_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label><b>{{__('Status')}}</b> <br><input type="radio" name="type" {{$place->status == 1 ? 'checked' : ''}}
                                    value="1">{{__('Active')}}</label>

                                <label><input type="radio" name="type" {{$place->status == 0 ? 'checked' : ''}}
                                    value="0">{{__('Inactive')}}</label>
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





