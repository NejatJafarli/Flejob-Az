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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Edit Table With Button</h4>
                            <p class="text-muted mb-4 font-13">Add toolbar column with edit and delete buttons.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>User id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>FatherName</th>
                                            <th>BirthDate</th>
                                            <th>Married</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->FirstName }}</td>
                                                <td>{{ $user->LastName }}</td>
                                                <td>{{ $user->FatherName }}</td>
                                                <td>{{ $user->BirthDate }}</td>
                                                <td>{{ $user->Married }}</td>
                                                <td>{{ $user->Username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    <form action="{{ route('ChangeStatusOfUser', app()->getLocale()) }}" method="POST">
                                                        @csrf
                                                        <div class="checkbox checkbox-success checkbox-single">
                                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                                            <input name="status"
                                                                type="checkbox" {{ $user->Status ? 'Checked' : '' }} onChange="this.form.submit()" >
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
