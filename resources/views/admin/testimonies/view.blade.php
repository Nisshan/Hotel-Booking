@extends('adminlte::page')
@section('title', 'View Testimonial')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Details')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('testimonials.index')}}">{{__('Testiomonials')}}</a></li>
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
                    <h3 class="card-title">{{$testimonial->name}}</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>{{__('Name')}}</td>
                            <td>{{$testimonial->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Description')}}</td>
                            <td>{{$testimonial->description}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Status')}}</td>
                            <td>@if($testimonial->status == 1 )
                                    active
                                @else
                                    inactive
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('Cover Image')}}</td>
                            <td><img src="{{asset($image)}}" ></td>
                        </tr>

                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        @can('edit_testimony')
                            <a href="{{route('testimonials.edit',[$testimonial->id])}}"
                               class="btn btn-info  pull-left">
                                {{__('Edit')}}</a>
                        @endcan
                        <a href="{{route('testimonials.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
