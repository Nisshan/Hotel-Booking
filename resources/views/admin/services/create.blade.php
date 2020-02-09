@extends('adminlte::page')

@section('title', 'Add Services')
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
                            <h1 class="m-0 text-dark">{{__('Services')}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('services.index')}}">{{__('Back')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.store')}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" class="form-control" placeholder="Title"
                                   name="name" id="name" required value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('Description')}}</label>
                            <textarea class="form-control" placeholder="Description"
                                      name="description" id="description"
                                      required>{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Photo')}}</label>
                            <input type="file" placeholder="image" name="cover" class="form-control">
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





