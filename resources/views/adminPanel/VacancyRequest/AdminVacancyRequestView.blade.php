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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">View Vacancy</h4>
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="VacancyName">Vacancy Name</label>
                                    <input type="text" class="form-control" id="VacancyName" name="VacancyName"
                                        placeholder="Enter VacancyName" required value="{{ $vac->VacancyName }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="PersonName">Person Name</label>
                                    <input type="text" class="form-control" id="PersonName" name="PersonName"
                                        placeholder="Enter PersonName" required value="{{ $vac->PersonName }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="PersonPhone">Person Phone</label>
                                    <input type="text" class="form-control" id="PersonPhone" name="PersonPhone"
                                        placeholder="Enter PersonPhone" required value="{{ $vac->PersonPhone }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="VacancySalary">Vacancy Salary</label>
                                    <input type="text" class="form-control" id="VacancySalary" name="VacancySalary"
                                        placeholder="Enter VacancySalary" required value="{{ $vac->VacancySalary }}"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="VacancyDescription">Vacancy Description</label>
                                    <textarea disabled class="form-control" name="VacancyDescription" id="VacancyDescription" cols="30" rows="10">{{ $vac->VacancyDescription }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="VacancyRequirements">Vacancy Requirements</label>
                                    <textarea disabled class="form-control" name="VacancyRequirements" id="VacancyRequirements" cols="30"
                                        rows="10">{{ $vac->VacancyRequirements }}</textarea>
                                </div>
                                {{-- add vacancy email --}}
                                <div class="form-group">
                                    <label for="Email">Vacancy Email</label>
                                    <input type="text" class="form-control" id="Email" name="Email"
                                        placeholder="Enter Email" required value="{{ $vac->Email }}" disabled>
                                </div>

                                <div class="form-group">
                                    {{-- //vacancy category id --}}
                                    <div class="form-group">
                                        <label for="Category">Category </label>
                                        <input type="text" class="form-control" id="Category_id" name="Category_id"
                                            placeholder="Enter Category_id" required
                                            value="{{ $vac->Category->CategoryName }}" disabled>
                                    </div>
                                    {{-- //vacancy CompanyUser id --}}
                                    <div class="form-group">
                                        <label for="CompanyUser_id">Company User</label>
                                        <input type="text" class="form-control" id="CompanyUser_id" name="CompanyUser_id"
                                            placeholder="Enter CompanyUser_id" required
                                            value="{{ $vac->Owner->CompanyName }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="City">City</label>
                                        <input type="text" class="form-control" id="City_id" name="City_id"
                                            placeholder="Enter City_id" required value="{{ $vac->City->CityName }}" disabled>
                                    </div>
                                    <a href="{{ route('VacancyRequestAcceptView', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                        class="btn btn-success btn-sm mx-4">Accept</a>


                                    <a href="{{ route('VacancyRequestRejectView', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                        type="submit" class="btn btn-danger btn-sm">Cancel</a>
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
