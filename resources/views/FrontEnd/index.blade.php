<!doctype html>
<html lang="zxx">

<head>

    @include('FrontEnd.Component.cdn')
</head>

<body>
    <!-- Navbar Area Start -->
    <div class="navbar-area">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="index.html" class="logo">
                <img src="assets2/img/logo.png" alt="logo">
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.html">
                        <img src="assets2/img/logo.png" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <a href="{{ route('Hom', app()->getLocale()) }}" class="nav-link active">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="about.html" class="nav-link ">About</a>
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
                                        <a href="job-details.html" class="nav-link">Job Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Candidates</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="candidate.html" class="nav-link">Candidates</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="candidate-details.html" class="nav-link">Candidates Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="company.html" class="nav-link">Company</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pricing.html" class="nav-link">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link dropdown-toggle">Profile</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a href="account.html" class="nav-link">Account</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link dropdown-toggle">Member</a>

                                                <ul class="dropdown-menu">
                                                    <li class="nav-item">
                                                        <a href="sign-in.html" class="nav-link">Sign In</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="sign-up.html" class="nav-link">Sign Up</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="reset-password.html" class="nav-link">Reset
                                                            Password</a>
                                                    </li>
                                                </ul>
                                            <li>
                                            <li class="nav-item">
                                                <a href="resume.html" class="nav-link">Resume</a>
                                            </li>
                                        </ul>
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
                                        <a href="catagories.html" class="nav-link">Catagories</a>
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
                                        <a href="blog-details.html" class="nav-link">Blog Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="contact.html" class="nav-link">Contact Us</a>
                            </li>
                            @if (session()->has('user'))
                                <div class="px-5">
                                    @include('FrontEnd.Component.MultiLang')
                                </div>
                                <div class="option-item">
                                    <img src="/CandidatesPicture/{{ session()->get('user')->image }}"
                                        alt="profile picture" style="width: 50px; height: 50px; border-radius: 50%;">
                                </div>

                                <li class="nav-item">
                                    <a href="{{ route('Hom', app()->getLocale()) }}"
                                        class="nav-link dropdown-toggle">{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ route('Account', app()->getLocale()) }}" class="nav-link">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('Logout', app()->getLocale()) }}"
                                                class="nav-link">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                        </ul>
                    @else
                        </ul>

                        <div class="other-option">
                            <a href="{{ route('Signup', app()->getLocale()) }}" class="signup-btn">Sign Up</a>
                            <a href="{{ route('Signin', app()->getLocale()) }}" class="signin-btn">Sign In</a>
                        </div>
                        @include('FrontEnd.Component.MultiLang')
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar Area End -->
    <!-- Banner Section Start -->
    <div class="banner-section">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="banner-content text-center">
                        <p>Find Jobs, Employment & Career Opportunities</p>
                        <h1>Drop Resume & Get Your Desire Job!</h1>
                        <div class="find-section pb-100 py-5">
                            <div class="container">
                                <form class="find-form" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Job Title or Keyword">
                                                <i class="bx bx-search-alt"></i>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputEmail2"
                                                    placeholder="Location">
                                                <i class="bx bx-location-plus"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <select class="category">
                                                @foreach ($Categories as $cat)
                                                    <option value="{{ $cat->id }}">
                                                        {{ $cat->Category_lang->CategoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="find-btn">
                                                Find A Job
                                                <i class='bx bx-search'></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Category Section Start -->
    <section class="categories-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Choose Your Category</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices.</p>
            </div>

            <div class="row">
                {{-- categories --}}
                @foreach ($Categories as $cat)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="job-list.html">
                            <div class="category-card">
                                @php
                                    echo $cat->StyleClass;
                                @endphp
                                <h3>{{ $cat->Category_lang->CategoryName }}</h3>
                                <p>{{ $cat->VacanciesCount }} Open position</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Category Section End -->

    <!-- Jobs Section Start -->
    <section class="job-section pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Jobs You May Be Interested In</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices.</p>
            </div>

            <div class="row">
                @foreach ($Vacancies as $vac)
                    <div class="col-sm-6">
                        <div class="job-card">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="thumb-img">
                                        <a href="job-details.html">
                                            <img src="{{ $vac->Owner->CompanyLogo }}" alt="company logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="job-info">
                                        <h3>
                                            <a href="job-details.html">{{ $vac->VacancyName }}</a>
                                        </h3>
                                        <ul>
                                            <li>Via <a href="#">{{ $vac->Owner->CompanyName }}</a></li>
                                            <li>
                                                <i class='bx bx-location-plus'></i>
                                                {{ $vac->City->CityName }}
                                            </li>
                                            <li>
                                                <i class='bx bx-filter-alt'></i>
                                                {{ $vac->Category->CategoryName }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="job-save">
                                        <a href="#">
                                            <i class='bx bx-heart'></i>
                                            Apply
                                        </a>
                                        <p>
                                            <i class='bx bx-stopwatch'></i>
                                            {{ $vac->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Jobs Section End -->

    <!-- Companies Section Start -->
    <section class="company-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Top Companies</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices.</p>


            </div>

            <div class="row">
                {{-- company Users List With Vacancy Count Top  Four --}}
                @php
                    
                    //sort companyUsers With Vacancy Count
                    $MyCompanyUsers = $CompanyUsers->sortByDesc('VacanciesCount');
                @endphp
                @foreach ($MyCompanyUsers as $user)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="company-card">
                            <div class="thumb-img">
                                <a href="company-details.html">
                                    <img src="{{ $user->CompanyLogo }}" alt="company logo">
                                </a>
                            </div>
                            <div class="company-info">
                                <h3>
                                    <a href="company-details.html">{{ $user->CompanyName }}</a>
                                </h3>
                                <p>{{ $user->VacanciesCount }} Open position</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Companies Section End -->

    <!-- Why Choose Section Start -->
    <section class="why-choose">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 p-0">
                    <div class="why-choose-text pt-100 pb-70">
                        <div class="section-title text-center">
                            <h2>Why You Choose Jovie?</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolorei.</p>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-group align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Best Talented People</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-research align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Easy To Find Canditate</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-discussion align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Easy To Communicate</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="media">
                                    <i class="flaticon-recruitment align-self-center mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">Global Recruitment Option</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row counter-area">
                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>127</span></h2>
                                    <p>Job Posted</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>137</span></h2>
                                    <p>Job Filed</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>180</span></h2>
                                    <p>Company</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="counter-text">
                                    <h2><span>144</span></h2>
                                    <p>Members</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 p-0">
                    <div class="why-choose-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Section End -->


    <!-- Pricing Section Start -->
    <section class="pricing-section pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Buy Our Plans & Packages</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="price-card">
                        <div class="price-top">
                            <h3>Free Forever</h3>
                            <i class='bx bx-user'></i>
                            <h2>0<sub>/Month</sub></h2>
                        </div>

                        <div class="price-feature">
                            <ul>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Appear in results
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    <strong>Accept mobile app</strong>
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Manage canditates directly
                                </li>
                            </ul>
                        </div>

                        <div class="price-btn">
                            <a href="post-job.html">Find A Job</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="price-card mt-12">
                        <div class="price-top">
                            <h3>Sponsor</h3>
                            <i class='bx bx-user'></i>
                            <h2>10<sub>/Month</sub></h2>
                        </div>

                        <div class="price-feature">
                            <ul>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Premium placement
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    <strong>PPC on your job</strong>
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Reach more candidates
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Desktop, mobile job alerts
                                </li>
                            </ul>
                        </div>

                        <div class="price-btn">
                            <a href="post-job.html">Find A Job</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                    <div class="price-card">
                        <div class="price-top">
                            <h3>Premium Plan</h3>
                            <i class='bx bx-user'></i>
                            <h2>30<sub>/Month</sub></h2>
                        </div>

                        <div class="price-feature">
                            <ul>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Job ad live for six-weeks
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    <strong>Premium placement</strong>
                                </li>
                                <li>
                                    <i class='bx bx-check'></i>
                                    Desktop, mobile job alerts
                                </li>
                            </ul>
                        </div>

                        <div class="price-btn">
                            <a href="post-job.html">Find A Job</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Section End -->
    {{-- 
    <!-- Candidate Section Start -->
    <section class="candidate-section pb-100">
        <div class="container">
            <div class="section-title text-center">
                <h2>Featured Candidates</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus</p>
            </div>

            <div class="condidate-slider owl-carousel owl-theme">
                @php
                    $MyUsers = $Users->sortByDesc('id');
                @endphp

                @foreach ($MyUsers as $user)
                    <div class="condidate-item">
                        <div class="candidate-img">
                            <img class="img-fluid" src="/CandidatesPicture/{{ $user->image }}" alt="Image">
                        </div>
                        <div class="candidate-text">
                            <h3><a href="candidate-details.html">{{ $user->FirstName . $user->LastName }}</a></h3>
                            <ul>
                                @foreach ($user->Categories as $cat)
                                    <li>
                                        <i class='bx bx-filter-alt'></i>
                                        {{ $cat->Category_lang->CategoryName }}
                                    </li>
                                @endforeach
                                <li>
                                    <i class='bx bx-location-plus'></i>
                                    {{ $user->City->CityLang->CityName }}
                                </li>
                            </ul>
                            <div class="bottom-text">
                                <p>
                                    <i class='bx bx-stopwatch'></i>
                                    {{ $user->created_at->DiffForHumans() }}
                                </p>
                                <a href="#">
                                    <i class='bx bx-heart'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="condidate-item">
                    <div class="candidate-img">
                        <img src="/assets2/img/candidate/1.jpg" alt="candidate image">
                    </div>
                    <div class="candidate-text">
                        <h3><a href="candidate-details.html">Mibraj Alex</a></h3>
                        <ul>
                            <li>
                                <i class='bx bx-filter-alt'></i>
                                Construction & Property
                            </li>
                            <li>
                                <i class='bx bx-location-plus'></i>
                                Botchergate, Carlisle
                            </li>
                        </ul>

                        <div class="bottom-text">
                            <p>
                                <i class='bx bx-stopwatch'></i>
                                9D ago
                            </p>
                            <a href="#">
                                <i class='bx bx-heart'></i>
                            </a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section> --}}
    <!-- Candidate Section End -->


    <!-- Blog Section Start -->
    <section class="blog-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>News, Tips & Articles</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus</p>
            </div>

            <div class="row">
                {{-- blogs --}}
                {{-- <div class="col-lg-4 col-sm-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="/assets2/img/blog/1.jpg" alt="blog image">
                            </a>
                        </div>
                        <div class="blog-text">
                            <ul>
                                <li>
                                    <i class='bx bxs-user'></i>
                                    Admin
                                </li>
                                <li>
                                    <i class='bx bx-calendar'></i>
                                    7 Feb, 2021
                                </li>
                            </ul>

                            <h3>
                                <a href="blog-details.html">
                                    How to Indroduce in Yourself in Job Interview?
                                </a>
                            </h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>

                            <a href="blog-details.html" class="blog-btn">
                                Read More
                                <i class='bx bx-plus bx-spin'></i>
                            </a>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Start -->
    <footer class="footer-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="/assets2/img/logo.png" alt="logo">
                            </a>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut
                            labore et dolore magna. Sed eiusmod tempor incididunt ut.</p>

                        <div class="footer-social">
                            <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                            <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                            <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                            <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget pl-60">
                        <h3>For Candidate</h3>
                        <ul>
                            <li>
                                <a href="job-grid.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Browse Jobs
                                </a>
                            </li>
                            <li>
                                <a href="account.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Account
                                </a>
                            </li>
                            <li>
                                <a href="catagories.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Browse Categories
                                </a>
                            </li>
                            <li>
                                <a href="resume.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Resume
                                </a>
                            </li>
                            <li>
                                <a href="job-list.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Job List
                                </a>
                            </li>
                            <li>
                                <a href="sign-up.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Sign Up
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget pl-60">
                        <h3>Quick Links</h3>
                        <ul>
                            <li>
                                <a href="index.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="about.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="faq.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    FAQ
                                </a>
                            </li>
                            <li>
                                <a href="pricing.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Pricing
                                </a>
                            </li>
                            <li>
                                <a href="privacy.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Privacy
                                </a>
                            </li>
                            <li>
                                <a href="contact.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget footer-info">
                        <h3>Information</h3>
                        <ul>
                            <li>
                                <span>
                                    <i class='bx bxs-phone'></i>
                                    Phone:
                                </span>
                                <a href="tel:882569756">
                                    +101 984 754
                                </a>
                            </li>

                            <li>
                                <span>
                                    <i class='bx bxs-envelope'></i>
                                    Email:
                                </span>
                                <a href="mailto:info@jovie.com">
                                    info@jovie.com
                                </a>
                            </li>

                            <li>
                                <span>
                                    <i class='bx bx-location-plus'></i>
                                    Address:
                                </span>
                                123, Denver, USA
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright-text text-center">
        <p>Copyright @2021 Jovie. All Rights Reserved By <a href="https://hibootstrap.com/"
                target="_blank">HiBootstrp.com</a></p>
    </div>
    <!-- Footer Section End -->

    <!-- Back To Top Start -->
    <div class="top-btn">
        <i class='bx bx-chevrons-up bx-fade-up'></i>
    </div>
    <!-- Back To Top End -->

    <!-- jQuery first, then Bootstrap JS -->
    <script src="/assets2/js/jquery.min.js"></script>
    <script src="/assets2/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="/assets2/js/owl.carousel.min.js"></script>
    <!-- Nice Select JS -->
    <script src="/assets2/js/jquery.nice-select.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="/assets2/js/jquery.magnific-popup.min.js"></script>
    <!-- Subscriber Form JS -->
    <script src="/assets2/js/jquery.ajaxchimp.min.js"></script>
    <!-- Form Velidation JS -->
    <script src="/assets2/js/form-validator.min.js"></script>
    <!-- Contact Form -->
    <script src="/assets2/js/contact-form-script.js"></script>
    <!-- Meanmenu JS -->
    <script src="/assets2/js/meanmenu.js"></script>
    <!-- Custom JS -->
    <script src="/assets2/js/custom.js"></script>
</body>

</html>
