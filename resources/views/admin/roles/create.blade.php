@extends('adminlte::page')
@section('title', 'Create Roles')

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
                            <h1 class="m-0 text-dark">{{__('Roles')}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">{{__('Back')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store')}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        <div class="form-group">
                            <label for="title">{{__('Name')}}</label>
                            <input type="text" class="form-control" placeholder="Name"
                                   name="name" id="name" required value="{{old('name')}}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" class="form-control" placeholder="Title of Role"
                                   name="title" id="email" value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <h4>Select Permissions</h4>
                            <ul class="permissions checkbox">
                                <div class="row">
                                    @foreach($attributes as $key=> $attribute)
                                        <ol class="col-md-4">
                                            <input type="checkbox" id="{{$key}}" class="permission-group">
                                            <label
                                                for="{{$key}}" class="reduce-gap"><strong>{{$key}}</strong></label>
                                            <ul>
                                                @foreach($attribute as $attr)
                                                    <li>
                                                        <input type="checkbox" id="permission-{{$attr->id}}"
                                                               name="permissions[]" class="the-permission"
                                                               value="{{$attr->id}}">
                                                        <label
                                                            for="permission-{{$attr->id}}"
                                                            class="reduce-gap">{{ $attr->title}}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </ol>
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                        <br>
                        <div class="form-group col-lg-12">
                            <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            $('.permission-group').on('change', function () {
                $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
            });

            function parentChecked() {
                $('.permission-group').each(function () {
                    var allChecked = true;
                    $(this).siblings('ul').find("input[type='checkbox']").each(function () {
                        if (!this.checked) allChecked = false;
                    });
                    $(this).prop('checked', allChecked);
                });
            }

            parentChecked();
            $('.the-permission').on('change', function () {
                parentChecked();
            });
        });
    </script>
@stop








