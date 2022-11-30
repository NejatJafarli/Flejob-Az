@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Blog List')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('Blogs', app()->getLocale()) }}">Blog</a></li>
@endsection
@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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
                            <h4 class="mt-0 header-title">Edit Table With Button</h4>
                            <p class="text-muted mb-4 font-13">Add toolbar column with edit and delete buttons.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Blog id</th>
                                            <th>Blog Title</th>
                                            <th>Blog Description</th>
                                            <th>Blog Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Blogs as $blog)
                                            <tr>
                                                <td>{{ $blog->id }}</td>
                                                <td>{{ $blog->Title }}</td>
                                                <td>
                                                    @php
                                                        $desc = substr($blog->Description, 0, 60)."........";
                                                    @endphp
                                                    {{ $desc }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" style="float: none;">
                                                        <a href="{{ route('EditBlogs', ['id' => $blog->id, 'language' => app()->getLocale()]) }}"
                                                            class="tabledit-edit-button btn btn-sm btn-success active"
                                                            style="float: none; margin: 4px;">
                                                            <span class="ti-pencil"></span>
                                                        </a>
                                                        <a href="{{ route('DeleteBlogs', ['id' => $blog->id, 'language' => app()->getLocale()]) }}"
                                                            class="tabledit-delete-button btn btn-sm btn-danger"
                                                            style="float: none; margin: 4px;"><span
                                                                class="ti-trash"></span></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $Blogs->links() }}
                            </div>
                        </div>
                        <!--end table-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div class="row col-12">
            {{-- add new  language field LanguageName  --}}
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add New Blog</h4>
                        <p class="text-muted mb-4 font-13">Add toolbar column with edit and delete buttons.</p>
                        <form action="{{ route('AddBlogs', app()->getLocale()) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Title">Blog Title</label>
                                <input type="text" class="form-control" id="Title" name="Title"
                                    placeholder="Enter Blog Title" required>
                            </div>
                            <div class="form-group">
                                <label for="Description">Blog Description</label>
                                <textarea class="form-control" name="Description" id="Description" cols="30" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Blog Image</label>
                                <input type="file" class="form-control" name="image" placeholder="Enter Blog Image"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="MetaTitle">Blog MetaTitle</label>
                                <input type="text" class="form-control" id="Description" name="MetaTitle"
                                    placeholder="Enter Blog MetaTitle">
                            </div>
                            <div class="form-group">
                                <label for="MetaTitle">Blog MetaDescription</label>
                                <input type="text" class="form-control" id="MetaDescription" name="MetaDescription"
                                    placeholder="Enter Blog MetaDescription">
                            </div>
                            <div class="form-group">
                                <label for="MetaTitle">Blog MetaKeywords</label>
                                <input type="text" class="form-control" id="MetaKeywords" name="MetaKeywords"
                                    placeholder="Enter Blog MetaKeywords">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
                {{-- <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">{{ __('Add New Category') }}</h4>
                        <form action="{{ route('AddLanguage', app()->getLocale()) }}" method="POST">
                            @csrf



                            <div class="form-group row justify-content-center">
                                <div class="col-sm-10 ">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Add
                                        Category</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div> --}}
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
