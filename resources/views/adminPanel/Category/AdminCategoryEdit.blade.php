@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Category Edit')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item "><a href="{{ route('Category', app()->getLocale()) }}">Category</a></li>
    <li class="breadcrumb-item active"><span>Edit Category</span></li>
@endsection
@section('content')
    <div class="row col-12">
        {{-- add new  category fields CategoryName styleClass MetaTitle MetaDescription  MetaKeywords  --}}
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
                    <h4 class="mt-0 header-title">{{ __('Update Category') }}</h4>
                    <form action="{{ route('UpdateCategory', app()->getLocale()) }}" method="POST">
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
                        <div class="form-group row mt-3">
                            <label for="example-text-input" class="col-md-2 col-form-label">{{ __('Style Class') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="styleClass" id="example-text-input"
                                    value="{{ $categories[0]['StyleClass'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="example-text-input" class="col-md-2 col-form-label">{{ __('Sort Order') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" name="SortOrder" id="example-text-input"
                                    value="{{ $categories[0]['SortOrder'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="example-text-input" class="col-md-2 col-form-label">{{ __('slug') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="slug" id="example-text-input"
                                    value="{{ $categories[0]['slug'] }}">
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach ($languages as $language)
                                <div class="tab-pane p-3 {{ $loop->first ? 'active' : '' }}"
                                    id="{{ $language->LanguageCode }}" role="tabpanel">
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-md-2 col-form-label">{{ __('Category Name') }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text"
                                                name="CategoryName[{{ $language->LanguageCode }}]" id="example-text-input"
                                                required value="{{ $categories[$loop->index]['CategoryName'] }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-md-2 col-form-label">{{ __('Meta Title') }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text"
                                                name="MetaTitle[{{ $language->LanguageCode }}]" id="example-text-input"
                                                value="{{ $categories[$loop->index]['MetaTitle'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-md-2 col-form-label">{{ __('Meta Description') }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text"
                                                name="MetaDescription[{{ $language->LanguageCode }}]"
                                                id="example-text-input"
                                                value="{{ $categories[$loop->index]['MetaDescription'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-md-2 col-form-label">{{ __('Meta Keywords') }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text"
                                                name="MetaKeywords[{{ $language->LanguageCode }}]" id="example-text-input"
                                                value="{{ $categories[$loop->index]['MetaKeywords'] }}">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="LanguageCode[]" value="{{ $language->LanguageCode }}">
                                <input type="hidden" name="LanguageCodeId[]" value="{{ $language->id }}">
                            @endforeach
                            <input type="hidden" name="CatId" value="{{ $categories[0]['category_id'] }}">
                        </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10 ">
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Edit
                            Category</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
