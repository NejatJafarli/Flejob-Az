<!doctype html>
<html>

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    @php
        use App\Models\lang;
        use App\Models\CompanyUser;
        use App\Models\config;
        
        $Langs = lang::all();
        
        $route = Route::current()->getName();
        
        $locale = app()->getLocale();
        
        //UpperCase First Char of LangCode
        $langCode = strtoupper($locale);
        
    @endphp

    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')

    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('JobDetails');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg6">
        <div class="d-table">
            <div class="d-table-cell">
                {{-- <h2>{{ __('Jobdetail.Job Details') }}</h2> --}}
                <h1 class="banner-title"> {{ $vac->VacancyName }} ({{ $vac->CompanyUser->CompanyName }}) </h1>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{ __('Jobdetail.Home') }}</a>
                    </li>
                    {{-- <li>{{ __('Jobdetail.Job Details') }}</li> --}}
                    <li>{{ $vac->VacancyName }} ({{ $vac->CompanyUser->CompanyName }}) </li>
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

    <!-- Job Details Section Start -->
    <section class="job-details ptb-100">
        <div class="container">
            {{-- //get message from redirect back with message --}}
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="job-details-text">
                                @php
                                    $class = $vac->SortOrder == 1 ? 'premium-job-card' : '';
                                @endphp
                                <div class="job-card {{ $class }}">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 mb-3">
                                            <div class="company-logo">
                                                <img class="img-fluid"
                                                    src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}" alt="logo">
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-3">
                                            <div class="job-info">
                                                <h2>{{ $vac->VacancyName }}</h2>
                                                <ul>
                                                    <li>
                                                        {{-- <i class='bx bx-location-plus'></i> --}}
                                                        {{ $vac->City->CityLang->CityName }}
                                                    </li>
                                                    <li>
                                                        {{-- <i class='bx bx-filter-alt'></i> --}}
                                                        {{ $vac->Category->Category_lang->CategoryName }}
                                                    </li>
                                                    {{-- price --}}
                                                    @php
                                                        $expired = false;
                                                        if ($vac->EndDate < date('Y-m-d')) {
                                                            $expired = true;
                                                        }
                                                    @endphp
                                                    <li>
                                                        {{-- <i class="fa-solid fa-hand-holding-dollar"></i> --}}
                                                        @if ($vac->WithAgreement == 1)
                                                            {{ __('home.With Agreement') }}
                                                        @else
                                                            {{ $vac->VacancySalary }} ₼
                                                        @endif
                                                    </li>
                                                    <li>
                                                        {{-- <i class="fa-solid fa-phone"></i> --}}
                                                        {{ $vac->PersonPhone }}
                                                    </li>
                                                    {{-- <span>
                                                        <i class='bx bx-paper-plane'></i>
                                                        {{ __('Jobdetail.Apply Before') }}:
                                                        {{ $vac->EndDate }}
                                                        @if ($expired)
                                                            <span
                                                                class="badge badge-danger">{{ __('Jobdetail.Expired') }}</span>
                                                        @endif
                                                    </span> --}}
                                                    <br>

                                                    {{-- @if (session()->has('User'))
                                                        @if ($vac->User_id == session()->get('User')->id)
                                                            <a href="{{ route('EditVacancy', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                                class="btn btn-primary">Edit</a>
                                                    @endif --}}


                                                    @if (
                                                        $vac->SortOrder == 0 &&
                                                            session()->has('CompanyUser') &&
                                                            $vac->owner->id == session()->get('CompanyUser')->id &&
                                                            $vac->Status == 1)
                                                        @php
                                                            $price = config::where('key', 'premium_price')->first()->value;
                                                        @endphp
                                                        <div class="account-details"
                                                            style="padding:0px; box-shadow:0px 0px;">

                                                            <form action="{{ route('payment2', app()->getLocale()) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="vacancy_id"
                                                                    value="{{ $vac->id }}">

                                                                <button type="submit"
                                                                    class="account-btn btn position-relative">
                                                                    {{ __('Jobdetail.do premium this job') }}
                                                                    <span
                                                                        style="color: white;font-size: 14px;background-color: #010c29;"
                                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                                                        {{ $price }} AZN
                                                                        <span class="visually-hidden">Price</span>
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="details-text">
                                    <h2>{{ __('Jobdetail.Description') }}</h2>
                                    @php
                                        $desc = nl2br($vac->VacancyDescription);
                                        echo $desc;
                                    @endphp
                                </div>
                                <div class="details-text">
                                    <h2>{{ __('Jobdetail.Requirements') }}</h2>
                                    @php
                                        $req = nl2br($vac->VacancyRequirements);
                                        echo $req;
                                    @endphp
                                </div>
                                <div class="details-text">
                                    <h2>{{ __('Jobdetail.Job Details') }}</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>{{ __('Jobdetail.Company') }} :</span></td>
                                                        <td>{{ $vac->CompanyUser->CompanyName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>{{ __('Jobdetail.Email') }} :</span></td>
                                                        <td><a
                                                                href="mailto:{{ $vac->Email }}">{{ $vac->Email }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>{{ __('Jobdetail.Person Name') }} :</span>
                                                        </td>
                                                        <td>{{ $vac->PersonName }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>{{ __('Jobdetail.Location') }} :</span>
                                                        </td>
                                                        <td>{{ $vac->City->CityLang->CityName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>{{ __('Jobdetail.Salary') }} :</span></td>

                                                        <td>
                                                            @if ($vac->WithAgreement == 1)
                                                                {{ __('home.With Agreement') }}
                                                            @else
                                                                {{ $vac->VacancySalary }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>{{ __('Jobdetail.Phone') }} :</span></td>
                                                        <td>{{ $vac->PersonPhone }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @if (session()->has('user'))
                                    @php
                                        $userApplied = false;
                                        
                                        $userApplied = session()
                                            ->get('user')
                                            ->AppliedVacancies->contains($vac->id);
                                        
                                    @endphp

                                    <div class="theme-btn">
                                        <button
                                            onclick="ApplyVac(this,'{{ route('ApplyVacancy', ['language' => app()->getLocale(), 'id' => $vac->id]) }}')"
                                            type="button" class="default-btn" data-toggle="modal">
                                            {{ $userApplied ? __('Jobdetail.UnApply Now') : __('Jobdetail.Apply Now') }}</button>
                                    </div>
                                @endif
                                <div class="my-5">
                                    <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                                    <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                                    <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3">
                    <div class="job-sidebar {{ $class }}">
                        <p class="sidebar-name">{{ __('Jobdetail.Posted By') }}</p>
                        <div class="posted-by">
                            <img style="height:100px; width:100px;"
                                src="/CompanyLogos/{{ $vac->CompanyUser->CompanyLogo }}" alt="client image">
                            <p>{{ $vac->CompanyUser->CompanyName }}</p>
                        </div>
                    </div>
                    @if ($vac->Status == 3 || $vac->Status == 0)
                        <div class="job-sidebar">
                            @if ($vac->Status == 3)
                                <h3 style="color:red;font-size:30px;">
                                    {{ __('Jobdetail.Your Vacancy Not Active Waiting For Payment') }}</h3>
                            @elseif ($vac->Status == 0)
                                {{-- // add payment form --}}
                                <h3 style="color:red;font-size:30px;">
                                    {{ __('Jobdetail.This Vacancy Has Been Expired Not Active') }}</h3>
                            @endif
                            @php
                                $vacancy_price = config::where('key', 'vacancy_price')->first()->value;
                            @endphp
                            <div class="account-details">
                                <form action="{{ route('payment', app()->getLocale()) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="vacancy_id" value="{{ $vac->id }}">

                                    <button type="submit"
                                        class="account-btn btn position-relative">{{ __('Jobdetail.Pay For 1 Month') }}<span
                                            style="color: white;font-size: 14px;background-color: #010c29;"
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                            {{ $vacancy_price }} AZN
                                            <span class="visually-hidden">Price</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif ($vac->Status == 4)
                        <div class="job-sidebar">
                            <h3 style="color:red;font-size:30px;">{{ __('Jobdetail.Waiting Confirm from Admin') }}</h3>
                        </div>
                    @elseif ($vac->Status == 5)
                        <div class="job-sidebar">
                            <h3 style="color:red;font-size:30px;">{{ __('Jobdetail.Your Vacancy not correct') }}</h3>
                        </div>
                    @endif
                    @php
                        
                        $Ads = config::where('key', 'like', 'site-ads-dynamic%');
                        //get count of ads
                        $AdsCount = $Ads->count();
                        //conver to array
                        $Ads = $Ads->get()->toArray();
                        $random = rand(0, $AdsCount - 1);
                        $AdsOne = $Ads[$random]['value'];
                        
                        $word = $Ads[$random]['key'];
                        //split -
                        $word = explode('-', $word);
                        //get last word
                        $word = $word[count($word) - 1];
                        //get site-links-$word
                        $AdsOneLink = config::where('key', 'site-links-' . $word)->first()->value;
                    @endphp
                    <a href="{{ $AdsOneLink }}" target="_blank">
                        <div class="ads-banner-vacancy ">
                            <img class="img-fluid" src="/AdsImages/{{ $AdsOne }}" alt="">
                        </div>
                    </a>
                </div>
            </div>

            <section class="job-style-two pt-100 pb-70">
                <div class="container">
                    <div class="section-title text-center">
                        <h2>{{ __('Jobdetail.Jobs You May Be Interested In') }}</h2>
                    </div>

                    <div class="row">
                        {{-- Same categoried Vacancies --}}
                        @foreach ($Vacancies as $vacs)
                            <div class="col-lg-12">
                                <div class="job-card-two">
                                    <div class="row align-items-center">
                                        <div class="col-md-1">
                                            <div class="company-logo">
                                                <a
                                                    href="{{ route('vacancyDetails', ['language' => app()->getLocale(), 'slug' => $vacs->slug, 'categorySlug' => $vacs->Category->slug]) }}">
                                                    <img style="height:50px; widht:50px;"
                                                        src="/CompanyLogos/{{ $vacs->Owner->CompanyLogo }}"
                                                        alt="logo">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="job-info">
                                                <p>
                                                    <a
                                                        href="{{ route('vacancyDetails', ['language' => app()->getLocale(), 'slug' => $vacs->slug, 'categorySlug' => $vacs->Category->slug]) }}">{{ $vacs->VacancyName }}</a>
                                                </p>
                                                <ul>
                                                    <li>
                                                        <i class='bx bx-briefcase'></i>
                                                        {{ $vacs->Category->CategoryName }}
                                                    </li>
                                                    <li>
                                                        <i class='bx bx-briefcase'></i>
                                                        @if ($vacs->WithAgreement == 1)
                                                            {{ __('home.With Agreement') }}
                                                        @else
                                                            {{ $vacs->VacancySalary }}
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <i class='bx bx-location-plus'></i>
                                                        {{ $vacs->City->CityName }}
                                                    </li>
                                                    <li>
                                                        <i class='bx bx-stopwatch'></i>
                                                        {{ $vacs->created_at->diffForHumans() }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="theme-btn text-end">
                                                <a href="{{ route('vacancyDetails', ['language' => app()->getLocale(), 'slug' => $vacs->slug, 'categorySlug' => $vacs->Category->slug]) }}"
                                                    class="default-btn">
                                                    {{ __('Jobdetail.Browse Job') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- Job Section End -->
            <script>
                function ApplyVac(event, url) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            if (data.success == "Applied Successfully") {
                                event.innerHTML = "{{ __('Jobdetail.Apply Now') }}";
                                $('div.Mysuccess').html(data.success)
                                $('div.Mysuccess')
                                    .fadeIn(300)
                                    .delay(5000)
                                    .fadeOut(400)
                                $('html, body').animate({
                                        scrollTop: $('div.Mysuccess').offset().top - 250
                                    },
                                    100
                                )
                            } else if (data.success == "UnApplied Successfully") {
                                //data have a redirect property
                                //change element value to Apply
                                event.innerHTML = "{{ __('Jobdetail.Apply Now') }}";
                                $('div.Mysuccess').html(data.success)
                                $('div.Mysuccess')
                                    .fadeIn(300)
                                    .delay(5000)
                                    .fadeOut(400)
                                $('html, body').animate({
                                        scrollTop: $('div.Mysuccess').offset().top - 250
                                    },
                                    100
                                )
                            } else if (data.hasOwnProperty("errors")) {
                                $('div.Myfailure').html(data.errors)
                                $('div.Myfailure')
                                    .fadeIn(300)
                                    .delay(5000)
                                    .fadeOut(400)
                                $('html, body').animate({
                                        scrollTop: $('div.Myfailure').offset().top - 250
                                    },
                                    100
                                )
                            } else if (data.hasOwnProperty('redirect'))
                                window.location.href = data.redirect;

                        },
                        error: function(data) {
                            $('div.Myfailure').html(data.errors)
                            $('div.Myfailure')
                                .fadeIn(300)
                                .delay(5000)
                                .fadeOut(400)
                            $('html, body').animate({
                                    scrollTop: $('div.Myfailure').offset().top - 250
                                },
                                100
                            )
                        }
                    });
                }
            </script>
        </div>
    </section>
    @include('FrontEnd.Component.Footer')

</html>
