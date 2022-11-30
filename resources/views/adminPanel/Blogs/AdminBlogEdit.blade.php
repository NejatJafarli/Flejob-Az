@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Language Edit')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><span>Blog Edit</span></li>
@endsection
@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row col-12">
                {{-- add new  language field LanguageName  --}}
                <div class="col-6">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                                </button>
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Edit Blog</h4>
                            <p class="text-muted mb-4 font-13">Add toolbar column with edit and delete buttons.</p>
                            <form action="{{ route('UpdateBlogs', app()->getLocale()) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="Title">Blog Title</label>
                                    <input type="text" class="form-control" id="Title" name="Title"
                                        placeholder="Enter Blog Title" value="{{ $Blog->Title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Blog Description</label>
                                    <textarea class="form-control" name="Description" id="Description" cols="30" rows="10" required>{{ $Blog->Description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Blog Image</label>
                                    <input type="file" class="form-control" name="image"
                                        placeholder="Enter Blog Image">
                                </div>
                                <div class="form-group">
                                    <label for="MetaTitle">Blog MetaTitle</label>
                                    <input type="text" class="form-control" id="Description" name="MetaTitle"
                                        placeholder="Enter Blog MetaTitle" value="{{ $Blog->MetaTitle }}">
                                </div>
                                <div class="form-group">
                                    <label for="MetaTitle">Blog MetaDescription</label>
                                    <input type="text" class="form-control" id="MetaDescription" name="MetaDescription"
                                        placeholder="Enter Blog MetaDescription" value="{{ $Blog->MetaDescription }}">
                                </div>
                                <div class="form-group">
                                    <label for="MetaTitle">Blog MetaKeywords</label>
                                    <input type="text" class="form-control" id="MetaKeywords" name="MetaKeywords"
                                        placeholder="Enter Blog MetaKeywords" value="{{ $Blog->MetaKeywords }}">
                                </div>
                                <input type="hidden" value="{{ $Blog->id }}" name="id">
                                <button type="submit" class="btn btn-primary">Edit Blog</button>
                            </form>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div> <!-- end col -->
            {{-- <div class="col-3">
                @if (isset($success))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                        </button>
                        <strong>{{ $success }}</strong>
                    </div>
                @endif
            </div> --}}
        </div> <!-- end row -->

    </div>
    <!-- end page content -->
@endsection
