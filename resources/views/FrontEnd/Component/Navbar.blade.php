<!-- Navbar Area Start -->
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="/assets2/img/logo.png" alt="logo">
        </a>
    </div>


    @php
        
        use App\Models\NotificationForCompanyUser;
        use App\Models\Vacancy;
        if (session()->has('CompanyUser')) {
            // NotificationForCompanyUser count
        
            // NotificationForCompanyUser count
            $NotificationForCompanyUser = NotificationForCompanyUser::where('status', 0)->get();
        
            $CompanyUserVacancy = Vacancy::where('CompanyUser_id', session()->get('CompanyUser')->id)->get();
        
            $count = 0;
        
            foreach ($NotificationForCompanyUser as $value) {
                foreach ($CompanyUserVacancy as $value2) {
                    if ($value->vacancy_id == $value2->id) {
                        $count++;
                    }
                }
            }
            $empty = null;
            if ($count == 0) {
                $empty = 'empty';
            }
        }
        
    @endphp

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
                            <a id="Hom" href="{{ route('Hom', app()->getLocale()) }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a id="About" href="{{ route('About', app()->getLocale()) }}"
                                class="nav-link ">About</a>
                        </li>
                        @if (session()->has('CompanyUser'))
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle FindAJob">Jobs</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('PostAJob', app()->getLocale()) }}" class="nav-link">Post A
                                            Job</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('FindAJob', app()->getLocale()) }}"
                                            class="nav-link FindAJob">Find A Job</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('FindAJob', app()->getLocale()) }}" class="nav-link FindAJob">Find A
                                    Job</a>
                            </li>
                        @endif

                        @if (session()->has('CompanyUser'))
                            @php
                                $CompanyUser = session()->get('CompanyUser')->Paying;
                            @endphp
                            @if ($CompanyUser == 1)
                                <li class="nav-item">
                                    <a id="Candidate" href="{{ route('Candidates', app()->getLocale()) }}"
                                        class="nav-link">Candidates</a>
                                </li>
                            @endif
                        @endif
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link dropdown-toggle Company Categories term faq Privacy">Pages</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('Companies', app()->getLocale()) }}"
                                        class="nav-link Company">Company</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="pricing.html" class="nav-link">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a href="404.html" class="nav-link">404 Page</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('Faq', app()->getLocale()) }}" class="nav-link faq">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Categories', app()->getLocale()) }}"
                                        class="nav-link Categories">Catagories</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Privacy', app()->getLocale()) }}"
                                        class="nav-link Privacy">Privacy
                                        & Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('terms', app()->getLocale()) }}" class="nav-link term">Terms &
                                        Conditions</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Blog', app()->getLocale()) }}"class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a id="Contact" href="{{ route('Contact', app()->getLocale()) }}"
                                class="nav-link">Contact
                                Us</a>
                        </li>
                        @if (session()->has('user'))
                            <div class="px-5">
                                @if (isset($myIdBool))
                                    @include('FrontEnd.Component.MultiLang', ['id' => $myId])
                                @else
                                    @include('FrontEnd.Component.MultiLang')
                                @endif
                            </div>
                            <div class="option-item">
                                <img src="/CandidatesPicture/{{ session()->get('user')->image }}" alt="profile picture"
                                    style="width: 50px; height: 50px; border-radius: 50%;">
                            </div>

                            <li class="nav-item">
                                <a href="{{ route('Account', app()->getLocale()) }}"
                                    class="nav-link dropdown-toggle account Messages MyResume AppliedJobs ChangePass">{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item ">
                                        <a href="{{ route('Account', app()->getLocale()) }}"
                                            class="nav-link account">Profile</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('MyResume', app()->getLocale()) }}"
                                            class="nav-link MyResume">My Resume</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('AppliedJobs', app()->getLocale()) }}"
                                            class="nav-link AppliedJobs">Applied Jobs</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('Messages', app()->getLocale()) }}"
                                            class="nav-link Messages">Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('ChangePass', app()->getLocale()) }}"
                                            class="nav-link ChangePass">Change Password</a>
                                    <li class="nav-item">
                                        <a href="{{ route('Logout', app()->getLocale()) }}" class="nav-link">Logout</a>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                @elseif (session()->has('CompanyUser'))
                    <div class="px-5">
                        @if (isset($myIdBool))
                            @include('FrontEnd.Component.MultiLang', ['id' => $myId])
                        @else
                            @include('FrontEnd.Component.MultiLang')
                        @endif
                    </div>


                    <div class="option-item">
                        <img src="/CompanyLogos/{{ session()->get('CompanyUser')->CompanyLogo }}" alt="profile picture"
                            style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>

                    <li class="nav-item">
                        <a href="{{ route('AccountCompany', app()->getLocale()) }}"
                            class="nav-link dropdown-toggle Vacancies account ChangePass">{{ session()->get('CompanyUser')->CompanyName }}
                            @if ($empty == null)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $count }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu ">
                            <li class="nav-item">
                                <a style="display: flex;
                                align-items: center;
                                justify-content: space-between;"
                                    href="{{ route('AccountCompany', app()->getLocale()) }}"
                                    class="nav-link account">Profile
                                    @if ($empty == null)
                                        <span class="badge bg-danger"
                                            style="font-size: 15px;">{{ $count }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('AccountCompanyVacancies', app()->getLocale()) }}"
                                    class="nav-link Vacancies">Vacancies</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('ChangePassCompany', app()->getLocale()) }}"
                                    class="nav-link ChangePass">Change Password</a>
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
                    @if (isset($myIdBool))
                        @include('FrontEnd.Component.MultiLang', ['id' => $myId])
                    @else
                        @include('FrontEnd.Component.MultiLang')
                    @endif
                    @endif
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar Area End -->
