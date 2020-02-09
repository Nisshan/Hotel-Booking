@extends('adminlte::page')
@section('title', 'View ' . $role->name)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Details')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">{{__('Roles')}}</a></li>
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
                    <h3 class="card-title">{{$role->name}}</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>{{__('Name')}}</td>
                            <td>{{$role->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Title')}}</td>
                            <td>{{$role->title}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Abilities')}}</td>
                            @foreach($permissions as $permission)
                                <td>{{ $permission}}</td>
                            @endforeach
                        </tr>
                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        @can('edit_role')
                            <a href="{{route('roles.edit',[$role->id])}}"
                               class="btn btn-info  pull-left">
                                {{__('Edit')}}</a>
                        @endcan
                        <a href="{{route('roles.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
