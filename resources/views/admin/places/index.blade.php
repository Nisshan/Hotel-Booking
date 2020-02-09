@extends('adminlte::page')

@section('title', 'Places')

@section('content')
    <div class="card-primary">
        @include('flash::message')
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6 card-title">
                            <h3 class="m-0 text-dark">{{__('Places')}}</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('places.create')}}"><button class="btn btn-sm btn-primary">{{__('Create New')}}</button></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive table-striped">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    {{--    <script src="{{asset('js/delete.js')}}"></script>--}}
    <script>
        $(function () {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 20,
                retrieve: true,
                ajax: '{{ url('getPlaces') }}',
                columns: [
                    {data: "id", name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
