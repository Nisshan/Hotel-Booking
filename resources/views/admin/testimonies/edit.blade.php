@extends('adminlte::page')

@section('title', 'Edit Testimony')
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
                            <h1 class="m-0 text-dark">{{__('Testimony')}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('testimonials.index')}}">{{__('Back')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('testimonials.update',[$testimonial->id])}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">{{__('Name')}}</label>
                            <input type="text" class="form-control" placeholder="Name of person"
                                   name="name" id="name" required value="{{$testimonial->name}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('Description')}}</label>
                            <textarea class="form-control" placeholder="Testimony Description"
                                      name="description" id="description"
                                      required>{{$testimonial->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Photo')}}</label>
                            <input type="file" placeholder="image" name="image" class="form-control">
                            <img src="{{$image}}">
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label><b>{{__('Status')}}</b> <br><input type="radio" name="status" {{$testimonial->status == 1 ? 'checked' : ''}}
                                    value="1">{{__('Active')}}</label>

                                <label><input type="radio" name="status" {{$testimonial->status == 0 ? 'checked' : ''}}
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





