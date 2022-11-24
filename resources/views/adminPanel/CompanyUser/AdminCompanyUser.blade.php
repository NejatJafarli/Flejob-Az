@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Company User')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><span>Company User</span></li>
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
                                            <th>Company User id</th>
                                            <th>Company Name</th>
                                            <th>Company Username</th>
                                            <th>Company Email</th>
                                            <th>Company WebSiteLink</th>
                                            <th>Company Address</th>
                                            <th>Company Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Companies as $comp)
                                            <tr>
                                                <td>{{ $comp->id }}</td>
                                                <td>{{ $comp->CompanyName }}</td>
                                                <td>{{ $comp->CompanyUsername }}</td>
                                                <td>{{ $comp->CompanyEmail }}</td>
                                                <td>{{ $comp->CompanyWebSiteLink }}</td>
                                                <td>{{ $comp->CompanyAddress }}</td>
                                                <td>
                                                    <form action="{{ route('ChangeStatusOfCompany', app()->getLocale()) }}" method="POST">
                                                        @csrf
                                                        <div class="checkbox checkbox-success checkbox-single">
                                                            <input type="hidden" name="id" value="{{ $comp->id }}">
                                                            <input name="status"
                                                                type="checkbox" {{ $comp->Status ? 'Checked' : '' }} onChange="this.form.submit()" >
                                                                <label></label>
                                                        </div>
                                                    </form>
                                                    {{-- <a href="{{ route('DeleteLanguage', ['id' => $lang->id, 'language' => app()->getLocale()]) }}"
                                                            class="tabledit-delete-button btn btn-sm btn-danger"
                                                            style="float: none; margin: 4px;"><span
                                                                class="ti-trash"></span></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{$Companies->links()}}
                                </div>
                            </div>
                        </div>
                        <!--end table-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end row -->
    <!-- end page content -->
@endsection
