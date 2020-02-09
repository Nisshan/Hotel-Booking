@extends('adminlte::page')

@section('title', 'Edit User')

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
    <div class="card-primary ">
        @include('flash::message')
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6 card-title">
                            <h2 class="m-0 text-dark">{{__('Users')}}</h2>
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
                    <form action="{{ route('users.update',[$user->id])}}" method="POST" id="formid"
                          enctype=multipart/form-data>
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">{{__('Name')}}</label>
                            <input type="text" class="form-control" placeholder="Username"
                                   name="name" id="name" required value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Mail')}}</label>
                            <input type="email" class="form-control" placeholder="Mail"
                                   name="email" id="email" required value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control" placeholder="Password"
                                   name="password" id="password" value="{{old('password')}}">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" placeholder="Confirm Password"
                                   name="password_confirmation" id="password_confirmation"
                                   value="{{old('password_confirmation')}}">
                        </div>

                        <div class="form-group">
                            <label for="Roles"> {{__('Assign Role')}}</label>
                            <select name="role" class="form-control">
                                <option value=" ">Select Role to Assign</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->title}}</option>
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






