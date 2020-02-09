@extends('adminlte::page')
@section('title', 'View ' . $user->name)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Details')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{__('Users')}}</a></li>
                    <li class="breadcrumb-item">{{__('Details')}}</li>
                </ol>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-blue">
                    <h3 class="card-title">{{$user->name}}</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>{{__('Name')}}</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Email')}}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>{{__('Role')}}</td>
                            <td>{{ $user->getRoles()[0] }}</td>
                        </tr>
                        <tr>
                            <td>{{__('Abilities')}}</td>
                            @foreach($abilities as $ability)
                                <td>{{ $ability->title}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>{{__('Status')}}</td>
                            <td>@if($user->type == 1 )
                                    active
                                @else
                                    inactive
                                @endif
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        @can('edit_user')
                            <a href="{{route('users.edit',[$user->id])}}"
                               class="btn btn-info  pull-left">
                                {{__('Edit')}}</a>
                        @endcan
                        <a href="{{route('users.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
