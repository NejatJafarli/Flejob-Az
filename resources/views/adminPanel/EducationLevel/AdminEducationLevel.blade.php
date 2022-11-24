@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Education Level List')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><span>Education Level</span></li>
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
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                @foreach ($languages as $language)
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                            href="#{{ $language->LanguageCode . 'datatable' }}" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">{{ $language->LanguageName }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($languages as $language)
                                    <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                        id="{{ $language->LanguageCode . 'datatable' }}" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="{{ $language->LanguageCode . 'table' }}"
                                                class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Education id</th>
                                                        <th>Education Level Name</th>
                                                        <th>Education Level Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($EducationLevels as $education)
                                                        @if ($education->lang_id == $language->id)
                                                            <tr>
                                                                <td>{{ $education->education_level_id }}</td>
                                                                <td>{{ $education->EducationLevelName }}</td>
                                                                <td>
                                                                    <div class="btn-group btn-group-sm"
                                                                        style="float: none;">
                                                                        <a href="{{ route('EditEducationLevel', ['id' => $education->education_level_id, 'language' => app()->getLocale()]) }}"
                                                                            class="tabledit-edit-button btn btn-sm btn-success active"
                                                                            style="float: none; margin: 4px;">
                                                                            <span class="ti-pencil"></span>
                                                                        </a>
                                                                        <a href="{{ route('DeleteEducationLevel', ['id' => $education->education_level_id, 'language' => app()->getLocale()]) }}"
                                                                            class="tabledit-delete-button btn btn-sm btn-danger"
                                                                            style="float: none; margin: 4px;"><span
                                                                                class="ti-trash"></span></a>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-center">
                                                {{ $EducationLevels->links() }}
                                            </div>
                                        </div>
                                        {{-- <a href="{{ route('CategoryEdit', ['locale' => app()->getLocale(), 'id' => $category->CategoryID]) }}"
                                                    class="btn btn-primary waves-effect waves-light">Edit</a>
                                                <a href="{{ route('CategoryDelete', ['locale' => app()->getLocale(), 'id' => $category->CategoryID]) }}"
                                                    class="btn btn-danger waves-effect waves-light">Delete</a> --}}
                                    </div>
                                @endforeach
                                <!--end table-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row col-12">
                    {{-- add new  category fields CategoryName styleClass MetaTitle MetaDescription  MetaKeywords  --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">{{ __('Add Education Level') }}</h4>
                                <form action="{{ route('AddEducationLevel', app()->getLocale()) }}" method="POST">
                                    @csrf
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        @foreach ($languages as $language)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                                    href="#{{ $language->LanguageCode }}" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">{{ $language->LanguageName }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        @foreach ($languages as $language)
                                            <div class="tab-pane p-3 {{ $loop->first ? 'active' : '' }}"
                                                id="{{ $language->LanguageCode }}" role="tabpanel">
                                                <div class="form-group row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">{{ __('Education Level Name') }}</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text"
                                                            name="EducationLevelName[{{ $language->LanguageCode }}]"
                                                            id="example-text-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="LanguageCode[]"
                                                value="{{ $language->LanguageCode }}">
                                            <input type="hidden" name="LanguageCodeId[]" value="{{ $language->id }}">
                                        @endforeach
                                    </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-sm-10 ">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Add
                                        Education Level</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
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
