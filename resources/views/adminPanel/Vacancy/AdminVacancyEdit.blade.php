@extends('layouts/master')
@section('title', 'Admin Panel')
@section('Username', session('AdminUser'))
@section('contentName', 'Vacancy Edit')
@section('userLogo', 'https://cdn-icons-png.flaticon.com/128/149/149071.png');
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('Panel', app()->getLocale()) }}">AdminPanel</a></li>
    <li class="breadcrumb-item active"><span>Vacancy Edit</span></li>
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
                            <h4 class="mt-0 header-title">Edit Vacancy</h4>
                            <p class="text-muted mb-4 font-13">Add toolbar column with edit and delete buttons.</p>
                            <form action="{{ route('UpdateVacancy', app()->getLocale()) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="VacancyName">Vacancy Name</label>
                                    <input type="text" class="form-control" id="VacancyName" name="VacancyName"
                                        placeholder="Enter VacancyName" required value="{{ $vac->VacancyName }}">
                                </div>
                                <div class="form-group">
                                    <label for="PersonName">Person Name</label>
                                    <input type="text" class="form-control" id="PersonName" name="PersonName"
                                        placeholder="Enter PersonName" required value="{{ $vac->PersonName }}">
                                </div>
                                <div class="form-group">
                                    <label for="PersonPhone">Person Phone</label>
                                    <input type="text" class="form-control" id="PersonPhone" name="PersonPhone"
                                        placeholder="Enter PersonPhone" required value="{{ $vac->PersonPhone }}">
                                </div>
                                <div class="form-group">
                                    <label for="VacancySalary">Vacancy Salary</label>
                                    <input type="text" class="form-control" id="VacancySalary" name="VacancySalary"
                                        placeholder="Enter VacancySalary" required value="{{ $vac->VacancySalary }}">
                                </div>
                                @php
                                // php-developer-9 make it php-developer remove last dash and number
                                $slug = $vac->slug;
                                $slug = explode('-', $slug);
                                $slug = implode('-', array_slice($slug, 0, -1));
                                
                                @endphp
                                <div class="form-group">
                                    <label for="slug">Vacancy SLUG URL</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="Enter slug" required value="{{ $slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="VacancyDescription">Vacancy Description</label>
                                    <textarea class="form-control" name="VacancyDescription" id="VacancyDescription" cols="30" rows="10">{{ $vac->VacancyDescription }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="VacancyRequirements">Vacancy Requirements</label>
                                    <textarea class="form-control" name="VacancyRequirements" id="VacancyRequirements" cols="30" rows="10">{{ $vac->VacancyRequirements }}</textarea>
                                </div>
                                {{-- add vacancy email --}}
                                <div class="form-group">
                                    <label for="Email">Vacancy Email</label>
                                    <input type="text" class="form-control" id="Email" name="Email"
                                        placeholder="Enter Email" required value="{{ $vac->Email }}">
                                </div>

                                <div class="form-group">
                                    <label for="Status">Status</label>
                                    <select class="form-control" id="Status" name="Status">
                                        <option value="0" @if ($vac->Status == 0) selected @endif>Not Active
                                        </option>
                                        <option value="1" @if ($vac->Status == 1) selected @endif>Active
                                        </option>
                                        <option value="3" @if ($vac->Status == 3) selected @endif>Waiting For Payment
                                        </option>
                                        <option value="4" @if ($vac->Status == 4) selected @endif>Waiting For
                                            Approve</option>
                                        <option value="5" @if ($vac->Status == 5) selected @endif>Rejected By Admin
                                        </option>




                                    </select>
                                    {{-- //vacancy category id --}}
                                    <div class="form-group">
                                        <label for="Category_id">Category ID</label>
                                        <input type="number" class="form-control" id="Category_id" name="Category_id"
                                            placeholder="Enter Category_id" required value="{{ $vac->Category_id }}">
                                    </div>
                                    {{-- //vacancy CompanyUser id --}}
                                    <div class="form-group">
                                        <label for="CompanyUser_id">Company User ID</label>
                                        <input type="number" class="form-control" id="CompanyUser_id" name="CompanyUser_id"
                                            placeholder="Enter CompanyUser_id" required
                                            value="{{ $vac->CompanyUser_id }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="City_id">City_id</label>
                                        <select class="form-control" id="City_id" name="City_id">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($vac->City_id == $city->id) selected @endif>{{ $city->CityName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="id" value="{{ $vac->id }}">
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
        </div> <!-- end row -->
    </div>
    <!-- end page content -->
@endsection
