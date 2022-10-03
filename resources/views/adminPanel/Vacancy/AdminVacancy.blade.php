@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Vacancy List')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><span>Vacancy</span></li>
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
                                            <th>Vacancy id</th>
                                            <th>Vacancy Name</th>
                                            <th>Vacancy Person Name</th>
                                            <th>Vacancy Person Phone</th>
                                            <th>Vacancy Salary</th>
                                            <th>Vacancy Email</th>
                                            <th>Vacancy Status</th>
                                            <th>Vacancy Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Vacancies as $vac)
                                            <tr>
                                                <td>{{ $vac->id }}</td>
                                                <td>{{ $vac->VacancyName }}</td>
                                                <td>{{ $vac->PersonName }}</td>
                                                <td>{{ $vac->PersonPhone }}</td>
                                                <td>{{ $vac->VacancySalary }}</td>
                                                <td>{{ $vac->Email }}</td>
                                                <td>
                                                    <form action="{{ route('ChangeStatusOfVacancy', app()->getLocale()) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="checkbox checkbox-success checkbox-single">
                                                            <input type="hidden" name="id"
                                                                value="{{ $vac->id }}">
                                                            <input name="status" type="checkbox"
                                                                {{ $vac->Status ? 'Checked' : '' }}
                                                                onChange="this.form.submit()">
                                                            <label></label>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" style="float: none;">
                                                        <a href="{{ route('EditVacancy', ['id' => $vac->id, 'language' => app()->getLocale()]) }}"
                                                            class="tabledit-edit-button btn btn-sm btn-success active"
                                                            style="float: none; margin: 4px;">
                                                            <span class="ti-pencil"></span>
                                                        </a>
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
