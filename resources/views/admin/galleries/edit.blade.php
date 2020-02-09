@extends('adminlte::page')

@section('title', 'Create Gallery')
@section('css')
    <style>
        .selected-image {
            background-color: green !important;
        }
    </style>
@stop
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
                            <h1 class="m-0 text-dark">{{__('Gallery')}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('galleries.index')}}">{{__('Back')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('galleries.update',[$gallery->id])}}" method="POST" id="formid" enctype=multipart/form-data>
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" class="form-control" placeholder="Gallery Title"
                                   name="title" id="title" required value="{{$gallery->title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('Description')}}</label>
                            <textarea class="form-control" placeholder="Gallery Description"
                                      name="description" id="description"
                                      required>{{$gallery->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="gallery_image" id="gallery_image" >
                        </div>
                        <div class="form-group col-md-12" style="background-color: lavender;padding:10px;">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="cover"> Image </label>
                                    <input type="file" class="form control" name="cover"
                                           id="cover" onchange="ValidateSize(this)">
                                    <img id="cover" alt="your image" width="100" height="100" src="{{asset($gallery->getFirstMedia('posts')->getUrl('thumb'))}}" />
                                </div>
                                <div class="form-group col-md-6" style="margin-top: 15px">
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#galleryModal" id="galleryModalBtn">Choose from gallery
                                    </button>
                                    <p id="galleryImageName"></p>
                                    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog"
                                         aria-labelledby="galleryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="galleryModalLabel">Choose Images
                                                        from gallery</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="searchTerm">Search Images</label>
                                                        <input type="text" name="searchTerm" id="searchTerm"
                                                               class="form-control">
                                                    </div>
                                                    <div>
                                                        <div class="row image-container"
                                                             style="overflow-y: scroll;max-height:300px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal" id="cancelButton">Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            id="selectButton">Select
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="imagename"> Image Name
                            </label>
                            <input type="text" name="imagename" class="form-control" value="{{old('imagename')}}">
                        </div>
                        <div class="form-group">
                            <label for="photoby">{{__('Photo By')}}</label>
                            <input type="text" class="form-control" placeholder="Photographer Name"
                                   name="photo_by" id="photoby" required value="{{old('photo_by')}}">
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
@section('js')
    <script>
        function selectImage(e) {
            var imgArr = e.children[0].src
            $('.image-wrapper').each(function (index, element) {
                $(element).css('background', 'white')
                $(element).removeClass('selected-image')
            })
            $(e).addClass('selected-image');
            $('#gallery_image').val(imgArr)
        }

        function ValidateSize(file) {
            var FileSize = file.files[0].size / 1024 / 1024; // in MB

            if (FileSize > 2) {
                swal('File size should not exceeds 2 MB ');
                $(file).val(''); //for clearing with Jquery
            } else {
            }
        }

        $(() => {
            $('#galleryModalBtn').click((e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log("Hello world");
                $('#cover').val("");

                $('#galleryModal').modal('show');
                $.ajax({
                    url: '/images/latest',
                    method: 'GET',
                    success: (data) => {
                        $('.image-container').empty()
                        data.forEach((imageurl) => {
                            console.log('data received');
                            var html = `<div class="col-md-3 image-wrapper" style="padding:10px;" onclick="selectImage(this)">
        <img src="${imageurl}" alt="" class="img img-responsive">
    </div>`;
                            $('.image-container').append(html);
                        })
                    }
                })
            })
            $('#searchTerm').keydown((e) => {
                var searchTerm = $('#searchTerm').val();
                if (searchTerm.length > 1) {
                    $('.image-container').empty()
                    $.ajax({
                        method: 'GET',
                        url: "/images/search/" + searchTerm,
                        success: (data) => {
                            $('.image-container').empty()
                            data.forEach((imageurl) => {
                                var html = `<div class="col-md-3 image-wrapper" style="padding:10px;" onclick="selectImage(this)">
                                  <img src="${imageurl}" alt="" class="img img-responsive">
                                  </div>`;
                                $('.image-container').append(html);
                            })
                        }
                    })
                }
            })
            $('.image-wrapper').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var imgArr = e.currentTarget.children[0].src.split('/')
                var imgName = imgArr[imgArr.length - 1]
                $('.image-wrapper').each(function (index, element) {
                    $(element).css('background', 'white')
                })
                $(this).css('background', 'green');
                $('#gallery_image').val(imgName)
            })
            $('#cancelButton').click(() => {
                $('.image-wrapper').each(function (index, element) {
                    $(element).css('background', 'white')
                })
                $('#gallery_image').val("")
                $('#imageMeta').css('display', 'block');
            })
            $('#selectButton').click(() => {
                $('.image-wrapper').each(function (index, element) {
                    $(element).css('background', 'white')
                })
                $('#galleryModal').modal('hide')
                $('#imageMeta').css('display', 'none')
                $('#galleryImageName').text($('#gallery_image').val())
            })
            $('#cover').click(() => {
                $('#imageMeta').css('display', 'block')
                $('#galleryImageName').text("")
            })
        })
    </script>
@endsection






