@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
    <div class="card-primary">
        @include('flash::message')
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-6 card-title">
                            <h3 class="m-0 text-dark">{{__('Roles')}}</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('roles.create')}}"><button class="btn btn-sm btn-primary">{{__('Create New')}}</button></a></li>
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
                            <th>Title</th>
                            <th>Permissions</th>
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
                ajax: '{{ url('admin/getRoles') }}',
                columns: [
                    {data: "id", name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'title', name: 'title'},
                    {data:'permissions', name:'permissions'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@stop
