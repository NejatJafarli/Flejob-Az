<!doctype html>
<html lang="zxx">

<head>

    @include('FrontEnd.Component.cdn')

</head>

<body>
    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    <!-- Navbar Area End -->
    @include('FrontEnd.Component.Preloader')
    <!-- Page Title Start -->
    <section class="page-title title-bg3">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{ __('PostAJob.Edit A Job') }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{ __('PostAJob.Home') }}</a>
                    </li>
                    <li>{{ __('PostAJob.Edit A Job') }}</li>
                </ul>
            </div>
        </div>
        <div class="lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </section>
    <!-- Page Title End -->

    <!-- Post Job Section Start -->
    <div class="job-post ptb-100">
        <div class="container">
            {{-- //show errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="job-post-from" action="{{ route('EditAJobPost', app()->getLocale()) }}" method="POST">
                @csrf
                <h2>{{ __('PostAJob.Edit A Job') }}</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('PostAJob.Job Title') }}</label>
                            <input type="hidden" value="{{ $vac->id }}" name="vacId">
                            <input value="{{ $vac->VacancyName }}" name="VacancyName" type="text"
                                class="form-control" id="exampleInput1"
                                placeholder="{{ __('PostAJob.Job Title or Keyword') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('PostAJob.Email') }}</label>
                            <input value="{{ $vac->Email }}" name="Email" type="text" class="form-control"
                                id="exampleInput1" placeholder="{{ __('PostAJob.Email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('PostAJob.Job Category') }}</label>
                            <select name="Category" class="form-control">
                                @foreach ($Categories as $Category)
                                    @if ($Category->id == $vac->Category_id)
                                        <option value="{{ $Category->id }}" selected>
                                            {{ $Category->Category_lang->CategoryName }}
                                        </option>
                                    @else
                                        <option value="{{ $Category->id }}">
                                            {{ $Category->Category_lang->CategoryName }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="{{ session()->get('CompanyUser')->id }}" name="CompanyUser">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('PostAJob.Job City') }} </label>
                            <select value="{{ $vac->City_id }}" name="City" class="form-control">
                                @foreach ($Cities as $City)
                                    @if ($City->id == $vac->City_id)
                                        <option value="{{ $City->id }}" selected>
                                            {{ $City->CityLang->CityName }}
                                        </option>
                                    @else
                                        <option value="{{ $City->id }}">{{ $City->CityLang->CityName }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('PostAJob.Person Name') }}</label>
                            <input value="{{ $vac->PersonName }}" name="PersonName" type="text" class="form-control"
                                id="exampleInput1" placeholder="{{ __('PostAJob.Enter Your Name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('PostAJob.Person Phone') }}</label>
                            <input value="{{ $vac->PersonPhone }}" name="PersonPhone" type="text"
                                class="form-control" id="exampleInput1"
                                placeholder="{{ __('PostAJob.Enter Your Phone') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ __('PostAJob.Job Description') }}</label>
                            <textarea class="form-control description-area" id="exampleFormControlTextarea1" rows="6"
                                placeholder="{{ __('PostAJob.Job Description') }}" required name="VacancyDescription">{{ $vac->VacancyDescription }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ __('PostAJob.Job Requirement') }}</label>
                            <textarea class="form-control description-area" id="exampleFormControlTextarea1" rows="6"
                                placeholder="{{ __('PostAJob.Job Requirement') }}" name="VacancyRequirements" required>{{ $vac->VacancyRequirements }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('PostAJob.Vacancy Salary') }}</label>
                            <input value="{{ $vac->VacancySalary }}" name="VacancySalary" type="number"
                                class="form-control" id="exampleInput1" placeholder="{{ __('PostAJob.Salary') }}"
                                min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" style="float: right; margin-right:50px;" class="post-btn">
                            {{ __('PostAJob.Post a Job') }}
                        </button>
                    </div>
                    {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Title</label>
                                <input type="text" class="form-control" id="exampleInput1" placeholder="Job Title or Keyword" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Category</label>
                                <select class="category">
                                    <option data-display="Category">Category</option>
                                    <option value="1">Web Development</option>
                                    <option value="2">Graphics Design</option>
                                    <option value="4">Data Entry</option>
                                    <option value="5">Visual Editor</option>
                                    <option value="6">Office Assistant</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" id="exampleInput2" placeholder="Company Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Email</label>
                                <input type="email" class="form-control" id="exampleInput3" placeholder="e.g. hello@company.com" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Website (Optional)</label>
                                <input type="text" class="form-control" id="exampleInput4" placeholder="e.g www.companyname.com">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" id="exampleInput5" placeholder="e.g. London" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Type</label>
                                <select class="category">
                                    <option data-display="Job Type">Job Type</option>
                                    <option value="1">Full Time</option>
                                    <option value="2">Part Time</option>
                                    <option value="4">Freelancer</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Tags</label>
                                <input type="text" class="form-control" id="exampleInput6" placeholder="e.g. web design, graphics design, video editing" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Salary (Optional)</label>
                                <input type="number" class="form-control" id="exampleInput7" placeholder="e.g. $20,000">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Experience</label>
                                <input type="text" class="form-control" id="exampleInput8" placeholder="e.g. 1 year" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Job Description</label>
                                <textarea class="form-control description-area" id="exampleFormControlTextarea1" rows="6" placeholder="Job Description" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="post-btn">
                                Post A Job
                            </button>
                        </div> --}}
                </div>
            </form>
        </div>
    </div>
    <!-- Post Job Section End -->


    <!-- Footer Area Start -->
    @include('FrontEnd.Component.Footer')

</html>
