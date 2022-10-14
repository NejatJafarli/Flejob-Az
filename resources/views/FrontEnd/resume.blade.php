<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<style>
    .resume-area li {
        border-radius: 10px;
    }
</style>

<body>
    <!-- Pre-loader End -->


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
                                <a href="{{ route('Hom', app()->getLocale()) }}" class="nav-link">Home</a>
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
                                                        <a href="{{ route('Signin', app()->getLocale()) }}"
                                                            class="nav-link">Sign In</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('Signup', app()->getLocale()) }}"
                                                            class="nav-link">Sign Up</a>
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
                                        class="nav-link dropdown-toggle active">{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ route('Account', app()->getLocale()) }}"
                                                class="nav-link active">Profile</a>
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

    <!-- Page Title Start -->
    <section class="page-title title-bg11">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Resume</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Resume</li>
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

    <!-- Resume Area Start -->
    <section class="resume-section ptb-100">
        <div class="container">
            <div class="resume-area">
                <div class="row">
                    <div class="col-md-12">
                        <div class="resume-thumb-area text-center">
                            <img style="width: 150px;height:150px;"
                                src="/CandidatesPicture/{{ session()->get('user')->image }}" alt="account image">
                            <h3>{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</h3>

                            @foreach (session()->get('user')->Categories as $category)
                                <p>{{ $category->Category_lang->CategoryName }}</p>
                            @endforeach

                            <div class="social-links">
                                {{-- Links --}}
                                {{-- <a href="#" target="-blank">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                                <a href="#" target="-blank">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                                <a href="#" target="-blank">
                                    <i class="bx bxl-github"></i>
                                </a>
                                <a href="#" target="-blank">
                                    <i class="bx bxl-linkedin"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 row">
                        <div class="resume-content about-text">
                            <h3>
                                <i class='bx bx-user-circle'></i>
                                Description
                            </h3>
                            <p>{{ session()->get('user')->Description }}</p>
                        </div>

                        <div class="resume-content basic-info-text">
                            <h3>
                                <i class='bx bx-book-alt'></i>
                                Basic Info
                            </h3>
                            <ul>
                                <li>
                                    <span>Age:</span>
                                    {{-- gett Age From Session User BirthDate --}}
                                    @php
                                        // get Age From Session User BirthDate
                                        $date = new DateTime(session()->get('user')->BirthDate);
                                        $now = new DateTime();
                                        $interval = $now->diff($date);
                                        
                                    @endphp
                                    {{ $interval->y }}
                                </li>
                                <li>
                                    <span>Experience:</span>
                                    @php
                                        //get Experince Start From User Companies min Date
                                        use Carbon\Carbon;
                                        $days = 0;
                                        if (isset(session()->get('user')->Companies)) {
                                            $companies = session()->get('user')->Companies;
                                            for ($i = 0; $i < count($companies); $i++) {
                                                $dateStart = new DateTime($companies[$i]->DateStart);
                                                $dateEnd = new DateTime($companies[$i]->DateEnd);
                                        
                                                $interval = $dateEnd->diff($dateStart);
                                        
                                                $days += $interval->days;
                                            }
                                        }
                                        //convert days to years without carbon
                                        $years = floor($days / 365);
                                        
                                        $date = Carbon::now()->addDays($days);
                                        
                                        echo $date->diffForHumans(null, true, false, 2);
                                    @endphp
                                </li>
                            </ul>
                        </div>

                        <div class="resume-content basic-info-text col-md-6">
                            <h3>
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M10 3H4C3.447 3 3 3.447 3 4v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1V4C11 3.447 10.553 3 10 3zM9 9H5V5h4V9zM20 3h-6c-.553 0-1 .447-1 1v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1V4C21 3.447 20.553 3 20 3zM19 9h-4V5h4V9zM10 13H4c-.553 0-1 .447-1 1v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1v-6C11 13.447 10.553 13 10 13zM9 19H5v-4h4V19zM17 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4S19.206 13 17 13zM17 19c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2S18.103 19 17 19z" />
                                </svg>
                                <box-icon name='category-alt'></box-icon>
                            </h3>
                            <ul>
                                <li>
                                    <span>Categories:</span>
                                </li>
                                @foreach (session()->get('user')->Categories as $category)
                                    <li>{{ $category->Category_lang->CategoryName }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="resume-content basic-info-text col-md-6">
                            <h3>
                                <i class='bx bx-globe'></i>
                                Languages
                            </h3>
                            <ul>
                                <li>
                                    <span>Languages:</span>
                                </li>
                                @foreach (session()->get('user')->Languages as $language)
                                    <li>{{ $language->LanguageName }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="resume-content education-text">
                            <h3>
                                <i class="flaticon-graduation-cap"></i>
                                Education Background
                            </h3>
                            @php
                            $educations=session()->get('user')->Educations;

                            //sort by yearStart Desc without usort
                            $educations = $educations->sortByDesc('YearStart');


                            @endphp
                            {{-- education --}}
                            @foreach ($educations as $Education)
                                <div class="education-info">
                                    <span>{{ $Education->YearStart . '-' . $Education->YearEnd }}</span>
                                    <h5>{{ $Education->EducationName }}</h5>
                                    <h5>Education Level:
                                        {{ $Education->EducationLevel->EducationLevelLang->EducationLevelName }}</h5>
                                </div>
                            @endforeach
                        </div>

                        <div class="resume-content  experience-text">
                            <h3>
                                <i class='bx bx-briefcase'></i>
                                Work Expericence
                            </h3>

                            @php
                                $companies = session()->get('user')->Companies;
                                $companies = $companies->sortByDesc('DateStart');
                            @endphp
                            @foreach ($companies as $Company)
                                <div class="experience-info">
                                    @php
                                        //delet last 3 char from company datestart
                                        $dateStart = substr($Company->DateStart, 0, -3);
                                        $dateEnd = substr($Company->DateEnd, 0, -3);
                                        
                                    @endphp
                                    <span>{{ $dateStart . ' --->' . $dateEnd }}</span>
                                    <h5>{{ $Company->Rank }}</h5>
                                    <h4>{{ $Company->CompanyName }}</h4>
                                </div>
                            @endforeach

                        </div>

                        {{-- <div class="resume-content skill">
                            <h3>
                                <i class='bx bx-check-shield'></i>
                                Skills
                            </h3>
                            <span>HTMl</span>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 80%"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                            </div>

                            <span>JS</span>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 90%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div>
                            </div>

                            <span>PHP</span>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"
                                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                            </div>

                            <span>SQL</span>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"
                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">95%</div>
                            </div>
                        </div> --}}

                        <div class="theme-btn">
                            <a href="#" class="default-btn">
                                Download
                                <i class='bx bx-download bx-fade-down'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Resume Area End -->

    @include('FrontEnd.Component.Footer')

</html>
