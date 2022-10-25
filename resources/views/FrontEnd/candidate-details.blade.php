<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>

    <!-- Navbar Area Start -->
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
                                <a href="#" class="nav-link dropdown-toggle">Jobs</a>

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
                                        <a id="JobDetails" href="job-details.html" class="nav-link">Job Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle CandidateDetails">Candidates</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="candidate.html" class="nav-link ">Candidates</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link CandidateDetails">Candidates
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
                                                    value="{{ route($route, ['language' => $lang->LanguageCode, 'id' => $can->id]) }}">
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
                                            value="{{ route($route, ['language' => $lang->LanguageCode, 'id' => $can->id]) }}">
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
                                        value="{{ route($route, ['language' => $lang->LanguageCode, 'id' => $can->id]) }}">
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
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('CandidateDetails');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>
    <!-- Navbar Area End -->


    <!-- Page Title Start -->
    <section class="page-title title-bg8">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Candidates Details</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Candidates Details</li>
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

    <!-- Candidate Details Start -->
    <section class="candidate-details pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="candidate-profile">
                        <img style="width: 250px;height:250px" src="/CandidatesPicture/{{ $can->image }}"
                            alt="candidate image">
                        <h3> {{ $can->FirstName . ' ' . $can->LastName }}</h3>
                        @foreach ($can->Categories as $Category)
                            <span>{{ $Category->Category_lang->CategoryName }}</span>
                            <br />
                        @endforeach
                        <ul>
                            <li class="pt-2">
                                <a href="tel:+100230342">
                                    <i class='bx bxs-phone'></i>
                                    {{ $can->phone }}
                                </a>
                            </li>
                            <li>
                                <a href="mailto: {{ $can->email }}">
                                    <i class='bx bxs-location-plus'></i>
                                    {{ $can->email }}
                                </a>
                            </li>
                        </ul>
                        {{-- show user linknames and links --}}
                        <ul>
                            @foreach ($can->Links as $link)
                                <li class="pt-2">
                                    <a href="{{ $link->Link }}">
                                        {{ $link->LinkName }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="candidate-info-text">
                        <h3>About Me</h3>
                        <p>{{ $can->Description }}</p>
                    </div>
                    <div class="candidate-info-text candidate-education">
                        <h3>Educations</h3>
                        @foreach ($can->Educations as $Education)
                            <div class="education-info">
                                <h4>{{ $Education->EducationName }}</h4>
                                <p>{{ $Education->EducationLevel->EducationLevelLang->EducationLevelName }}</p>
                                <span>{{ $Education->YearStart . '-' . $Education->YearEnd }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="candidate-info-text candidate-education">
                        <h3>Experiance</h3>
                        @foreach ($can->Companies as $Companies)
                            <div class="education-info">
                                <h4>{{ $Companies->CompanyName }}</h4>
                                @php
                                    $DateStart = date_create($Companies->DateStart);
                                    $DateEnd = date_create($Companies->DateEnd);
                                    
                                    $DateStart = date_format($DateStart, 'Y');
                                    $DateEnd = date_format($DateEnd, 'Y');
                                @endphp
                                <span>{{ $DateStart . '-' . $DateEnd }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="candidate-info-text">
                        <h3>Skills</h3>
                        <p>{{ $can->Skills }}</p>
                    </div>
                    <div class="candidate-info-text text-center">
                        <div class="theme-btn">
                            <a href="#" class="default-btn">Download CV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Candidate Details End -->
    @include('FrontEnd.Component.Footer')

</html>
