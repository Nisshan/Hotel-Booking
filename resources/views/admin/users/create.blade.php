@extends('adminlte::page')

@section('title', 'Create User')

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
                            <h1 class="m-0 text-dark">{{__('Users')}}</h1>
                        </div>
                        <div class="col-sm-6">
                            @can('view_user')
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{__('Back')}}</a>
                                    </li>
                                </ol>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store')}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        <div class="form-group">
                            <label for="title">{{__('Name')}}</label>
                            <input type="text" class="form-control" placeholder="Username"
                                   name="name" id="name" required value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Mail')}}</label>
                            <input type="email" class="form-control" placeholder="Mail"
                                   name="email" id="email" required value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control" placeholder="Password"
                                   name="password" id="password" required value="{{old('password')}}">
                        </div>
                        <div class="form-group">
                            <label for="confirm_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" placeholder="Confirm Password"
                                   name="password_confirmation" id="password_confirmation" required
                                   value="{{old('password_confirmation')}}">
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






