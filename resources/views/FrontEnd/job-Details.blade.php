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
                <h2>Job Details</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Job Details</li>
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
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job-details-text">
                                <div class="job-card">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <div class="company-logo">
                                                <img style="height: 150px; width:150px;"
                                                src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}" alt="logo">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="job-info">
                                                <h3>{{ $vac->VacancyName }}</h3>
                                                <ul>
                                                    <li>
                                                        <i class='bx bx-location-plus'></i>
                                                        {{ $vac->City->CityLang->CityName }}
                                                    </li>
                                                    <li>
                                                        <i class='bx bx-filter-alt'></i>
                                                        {{ $vac->Category->Category_lang->CategoryName }}
                                                    </li>
                                                    @php
                                                        $expired = false;
                                                        if ($vac->EndDate < date('Y-m-d')) {
                                                            $expired = true;
                                                        }
                                                    @endphp
                                                    <span>
                                                        <i class='bx bx-paper-plane'></i>
                                                        Apply Before: {{ $vac->EndDate }}
                                                        {{-- write this vacancy has been expired --}}
                                                        @if ($expired)
                                                            <span class="badge badge-danger">Expired</span>
                                                        @endif
                                                    </span>
                                                    <br>

                                                    {{-- @if (session()->has('User'))
                                                        @if ($vac->User_id == session()->get('User')->id)
                                                            <a href="{{ route('EditVacancy', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                                class="btn btn-primary">Edit</a>
                                                    @endif --}}


                                                    @if ($vac->SortOrder == 0 &&
                                                        session()->has('CompanyUser') &&
                                                        $vac->owner->id == session()->get('CompanyUser')->id)
                                                        @php
                                                            $price = config::where('key', 'premium_price')->first()->value;
                                                        @endphp
                                                        <div class="account-details"
                                                            style="padding:0px; box-shadow:0px 0px;">
                                                            <form>
                                                                <button type="button"
                                                                    class="account-btn btn position-relative">Elani
                                                                    Premium Et
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
                                    <h3>Description</h3>
                                    @php
                                        $desc = nl2br($vac->VacancyDescription);
                                        echo $desc;
                                    @endphp
                                </div>
                                <div class="details-text">
                                    <h3>Requirements</h3>
                                    @php
                                        $req = nl2br($vac->VacancyRequirements);
                                        echo $req;
                                    @endphp
                                </div>
                                <div class="details-text">
                                    <h3>Job Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>Company :</span></td>
                                                        <td>{{ $vac->CompanyUser->CompanyName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Email :</span></td>
                                                        <td><a href="mailto:{{ $vac->Email }}">{{ $vac->Email }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Person Name :</span></td>
                                                        <td>{{ $vac->PersonName }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>Location :</span></td>
                                                        <td>{{ $vac->City->CityLang->CityName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Salary :</span></td>
                                                        <td>{{ $vac->VacancySalary }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Phone :</span></td>
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
                                            {{ $userApplied ? 'UnApply Now' : 'Apply Now' }}</button>
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

                <div class="col-lg-4">
                    <div class="job-sidebar">
                        <h3>Posted By</h3>
                        <div class="posted-by">
                            <img style="height:100px; widht:100px;"
                                src="/CompanyLogos/{{ $vac->CompanyUser->CompanyLogo }}" alt="client image">
                            <h4>{{ $vac->CompanyUser->CompanyName }}</h4>
                        </div>
                    </div>
                    @if ($vac->Status == 3)
                        <div class="job-sidebar">
                            <h3 style="color:red;font-size:30px;">Aktiv deyil odenis gozlenilir</h3>
                        </div>
                    @elseif ($vac->Status == 0)
                        <div class="job-sidebar">
                            <h3 style="color:red;font-size:30px;">Elan Muddeti Bitib aktiv deyil</h3>
                        </div>
                    @elseif ($vac->Status == 4)
                        <div class="job-sidebar">
                            <h3 style="color:red;font-size:30px;">Admin Terefinden Testiqlenme gozlenilir</h3>
                        </div>
                    @elseif ($vac->Status == 5)
                        <div class="job-sidebar">
                            <h3 style="color:red;font-size:30px;">Qaydalara Uygun Deyil sizin vakansiyaniz</h3>
                        </div>
                    @endif
                </div>
            </div>

            <section class="job-style-two pt-100 pb-70">
                <div class="container">
                    <div class="section-title text-center">
                        <h2>Jobs You May Be Interested In</h2>
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
                                                    href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vacs->id]) }}">
                                                    <img style="height:50px; widht:50px;"
                                                        src="/CompanyLogos/{{ $vacs->Owner->CompanyLogo }}"
                                                        alt="logo">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="job-info">
                                                <h3>
                                                    <a
                                                        href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vacs->id]) }}">{{ $vacs->VacancyName }}</a>
                                                </h3>
                                                <ul>
                                                    <li>
                                                        <i class='bx bx-briefcase'></i>
                                                        {{ $vacs->Category->CategoryName }}
                                                    </li>
                                                    <li>
                                                        <i class='bx bx-briefcase'></i>
                                                        {{ $vacs->VacancySalary }}
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
                                                <a href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vacs->id]) }}"
                                                    class="default-btn">
                                                    Browse Job
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
                                event.innerHTML = "UnApply Now";
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
                                event.innerHTML = "Apply Now";
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
