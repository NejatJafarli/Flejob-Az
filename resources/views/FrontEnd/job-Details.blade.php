<!doctype html>
<html>

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    @php
        use App\Models\lang;
        
        $Langs = lang::all();
        
        $route = Route::current()->getName();
        
        $locale = app()->getLocale();
        
        //UpperCase First Char of LangCode
        $langCode = strtoupper($locale);
        
    @endphp
    {{-- nav bar start --}}
    <!-- Navbar Area Start -->
    <div class="navbar-area">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="index.html" class="logo">
                <img src="/assets2/img/logo.png" alt="logo">
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.html">
                        <img src="/assets2/img/logo.png" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <a id="Hom" href="{{ route('Hom', app()->getLocale()) }}"
                                    class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a id="About" href="about.html" class="nav-link ">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle JobDetails">Jobs</a>

                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="find-job.html" class="nav-link">Find A Job</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="post-job.html" class="nav-link">Post A Job</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="job-list.html" class="nav-link">Job List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="job-grid.html" class="nav-link">Job Grid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link JobDetails">Job Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Candidates</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a id="Candidates" href="candidate.html" class="nav-link">Candidates</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="CandidatesDetails" href="candidate-details.html"
                                            class="nav-link">Candidates
                                            Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a id="Companies" href="company.html" class="nav-link">Company</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pricing.html" class="nav-link">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="404.html" class="nav-link">404 Page</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="testimonial.html" class="nav-link">Testimonials</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="faq.html" class="nav-link">FAQ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="Categories" href="catagories.html" class="nav-link">Catagories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="privacy-policy.html" class="nav-link">Privacy & Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="terms-condition.html" class="nav-link">Terms & Conditions</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="blog.html" class="nav-link">Blog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="blog-two.html" class="nav-link">Blog Two</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="BlogDetails" href="blog-details.html" class="nav-link">Blog Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a id="Contact" href="contact.html" class="nav-link">Contact Us</a>
                            </li>
                            @if (session()->has('user'))
                                <div class="px-5">
                                    <div class="other-option" style="padding: 0 0 0 50px">
                                        <select class="form-control" onchange="window.location.href=this.value">
                                            @foreach ($Langs as $lang)
                                                <option {{ $locale == $lang->LanguageCode ? 'Selected' : '' }}
                                                    value="{{ route($route, ['language' => $lang->LanguageCode, 'id' => $vac->id]) }}">
                                                    {{ strtoupper($lang->LanguageCode) }}</a>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="option-item">
                                    <img src="/CandidatesPicture/{{ session()->get('user')->image }}"
                                        alt="profile picture" style="width: 50px; height: 50px; border-radius: 50%;">
                                </div>

                                <li class="nav-item">
                                    <a href="{{ route('Account', app()->getLocale()) }}"
                                        class="nav-link dropdown-toggle account">{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item account">
                                            <a href="{{ route('Account', app()->getLocale()) }}"
                                                class="nav-link">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="Settings" href="#" class="nav-link">Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('Logout', app()->getLocale()) }}"
                                                class="nav-link">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                        </ul>
                    @elseif (session()->has('CompanyUser'))
                        <div class="px-5">
                            <div class="other-option" style="padding: 0 0 0 50px">
                                <select class="form-control" onchange="window.location.href=this.value">
                                    @foreach ($Langs as $lang)
                                        <option {{ $locale == $lang->LanguageCode ? 'Selected' : '' }}
                                            value="{{ route($route, ['language' => $lang->LanguageCode, 'id' => $vac->id]) }}">
                                            {{ strtoupper($lang->LanguageCode) }}</a>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="option-item">
                            <img src="/CompanyLogos/{{ session()->get('CompanyUser')->CompanyLogo }}"
                                alt="profile picture" style="width: 50px; height: 50px; border-radius: 50%;">
                        </div>

                        <li class="nav-item">
                            <a href="{{ route('AccountCompany', app()->getLocale()) }}"
                                class="nav-link dropdown-toggle account">{{ session()->get('CompanyUser')->CompanyName }}</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('AccountCompany', app()->getLocale()) }}"
                                        class="nav-link account">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a id="Settings" href="#" class="nav-link">Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('LogoutCompany', app()->getLocale()) }}"
                                        class="nav-link">Logout</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        </ul>

                        <div class="other-option">
                            <a href="{{ route('Signup', app()->getLocale()) }}" class="signup-btn">Sign Up</a>
                            <a href="{{ route('Signin', app()->getLocale()) }}" class="signin-btn">Sign In</a>
                        </div>
                        <div class="other-option" style="padding: 0 0 0 50px">
                            <select class="form-control" onchange="window.location.href=this.value">
                                @foreach ($Langs as $lang)
                                    <option {{ $locale == $lang->LanguageCode ? 'Selected' : '' }}
                                        value="{{ route($route, ['language' => $lang->LanguageCode, 'id' => $vac->id]) }}">
                                        {{ strtoupper($lang->LanguageCode) }}</a>
                                @endforeach
                            </select>
                        </div>

                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar Area End -->

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
                                                <img src="/VacanciesPicture/{{ $vac->Photo }}" alt="logo">
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
                                                        <td><a
                                                                href="mailto:{{ $vac->Email }}">{{ $vac->Email }}</a>
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
                            <img src="/CompanyLogos/{{ $vac->CompanyUser->CompanyLogo }}" alt="client image">
                            <h4>{{ $vac->CompanyUser->CompanyName }}</h4>
                        </div>
                    </div>
                    {{-- <div class="job-sidebar">
                        <h3>Keywords</h3>
                        <ul>
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                        </ul>
                    </div> --}}
                    {{-- 
                        <div class="job-sidebar social-share">
                            <h3>Share In</h3>
                            <ul>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-pinterest"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
    </section>
    <!-- Job Details Section End -->

    <!-- Job Section End -->
    <section class="job-style-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Jobs You May Be Interested In</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>
            </div>

            <div class="row">
                {{-- Same categoried Vacancies --}}
                @foreach ($Vacancies as $vacs)
                    <div class="col-lg-12">
                        <div class="job-card-two">
                            <div class="row align-items-center">
                                <div class="col-md-1">
                                    <div class="company-logo">
                                        <a href="{{route('JobDetails',['language'=>app()->getLocale(),'id'=>$vacs->id])}}">
                                            <img src="/CompanyLogos/{{ $vacs->Owner->CompanyLogo }}" alt="logo">
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
                                                {{ $vacs->VacansySalary }}
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
    @include('FrontEnd.Component.Footer')

</html>
