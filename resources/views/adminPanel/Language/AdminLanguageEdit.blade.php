@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Language Edit')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><span>Language Edit</span></li>
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
                            <h4 class="mt-0 header-title">Edit Language</h4>
                            <p class="text-muted mb-4 font-13">Add toolbar column with edit and delete buttons.</p>
                            <form action="{{ route('UpdateLanguage', app()->getLocale()) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="LanguageName">Language Name</label>
                                    <input type="text" class="form-control" id="LanguageName" name="LanguageName"
                                        placeholder="Enter Language Name" required value="{{$Language->LanguageName}}">
                                </div>
                                <input type="hidden" name="id" value="{{$Language->id}}">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
