<!-- Navbar Area Start -->
<div class="navbar-area" id="navBar-Area">
    {{-- //create a tag achor header --}}


    <!-- Menu For Mobile Device -->
    <div class="mobile-nav" style="padding-bottom: 55px">
        <a href="{{ route('Hom', app()->getLocale()) }}" class="logo">
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
                <a class="navbar-brand" href="{{ route('Hom', app()->getLocale()) }}">
                    <img src="/assets2/img/logo.png" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a id="Hom" href="{{ route('Hom', app()->getLocale()) }}"
                                class="nav-link">{{ __('Navbar.Home') }}</a>
                        </li>

                        {{-- @if (session()->has('CompanyUser'))
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle FindAJob">{{__("Navbar.Jobs")}}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('PostAJob', app()->getLocale()) }}" class="nav-link">{{__("Navbar.Post A Job")}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('FindAJob', app()->getLocale()) }}"
                                            class="nav-link FindAJob">{{__("Navbar.Find A Job")}}</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('FindAJob', app()->getLocale()) }}" class="nav-link FindAJob">{{__("Navbar.Find A Job")}}</a>
                            </li>
                        @endif --}}
                        {{-- <li class="nav-item">
                            <a href="{{ route('Categories', app()->getLocale()) }}"
                                class="nav-link Categories">{{__("Navbar.Catagories")}}</a>
                        </li> --}}

                        @if (session()->has('CompanyUser'))
                            @php
                                $CompanyUser = session()->get('CompanyUser')->Paying;
                            @endphp
                            @if ($CompanyUser == 1)
                                <li class="nav-item">
                                    <a id="Candidate" href="{{ route('Candidates', app()->getLocale()) }}"
                                        class="nav-link">{{ __('Navbar.Candidates') }}</a>
                                </li>
                            @endif
                        @endif
                        </li>
                        <li class="nav-item">
                            <a id="About" href="{{ route('About', app()->getLocale()) }}"
                                class="nav-link ">{{ __('Navbar.About') }}</a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="{{ route('Blog', app()->getLocale()) }}"class="nav-link Blog">{{ __('Navbar.Blog') }}</a>
                        </li>
                        <li class="nav-item">
                            <a id="Contact" href="{{ route('Contact', app()->getLocale()) }}"
                                class="nav-link">{{ __('Navbar.Contact Us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a id="ads" href="{{ route('adsAdd', app()->getLocale()) }}"
                                class="nav-link">{{ __('Navbar.Saytda Reklam') }}</a>
                        </li>
                        @if (!session()->has('user'))
                            <li class="nav-item signin-mobile">
                                <a id="Contact" href="{{ route('Signin', app()->getLocale()) }}"
                                    class="nav-link">{{ __('Navbar.Sign In') }}</a>
                            </li>
                            <li class="nav-item signin-mobile">
                                <a id="Contact" href="{{ route('Signup', app()->getLocale()) }}"
                                    class="nav-link">{{ __('Navbar.Sign Up') }}</a>
                            </li>
                        @endif
                        @if (session()->has('user'))
                            <div class="px-5">
                                @if (isset($ItIsCategory))
                                    @include('FrontEnd.Component.MultiLang', ['catSlug' => $catSlug])
                                @elseif (isset($ItIsAVacancy))
                                    @include('FrontEnd.Component.MultiLang', [
                                        'VacSlug' => $VacSlug,
                                        'catSlug' => $catSlug,
                                    ])
                                @elseif(isset($myIdBool))
                                    @include('FrontEnd.Component.MultiLang', ['id' => $myId])
                                @else
                                    @include('FrontEnd.Component.MultiLang')
                                @endif
                            </div>
                            <div class="option-item ">
                                <img src="/CandidatesPicture/{{ session()->get('user')->image }}" alt="profile picture"
                                    style="width: 40px; height: 40px; margin:10px; border-radius:7px; "
                                    class="navbar-img-mobile">
                            </div>

                            <li class="nav-item">
                                <a href="{{ route('Account', app()->getLocale()) }}"
                                    class="nav-link dropdown-toggle account Messages MyResume AppliedJobs ChangePass">{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item ">
                                        <a href="{{ route('Account', app()->getLocale()) }}"
                                            class="nav-link account">{{ __('Navbar.Profile') }}</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('MyResume', app()->getLocale()) }}"
                                            class="nav-link MyResume">{{ __('Navbar.My Resume') }}</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('AppliedJobs', app()->getLocale()) }}"
                                            class="nav-link AppliedJobs">{{ __('Navbar.Applied Jobs') }}</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('Messages', app()->getLocale()) }}"
                                            class="nav-link Messages">{{ __('Navbar.Messages') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('ChangePass', app()->getLocale()) }}"
                                            class="nav-link ChangePass">{{ __('Navbar.Change Password') }}</a>
                                    <li class="nav-item">
                                        <a href="{{ route('Logout', app()->getLocale()) }}"
                                            class="nav-link">{{ __('Navbar.Logout') }}</a>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                @elseif (session()->has('CompanyUser'))
                    <div
                        style="    display: flex;
                    justify-content: center;
                    align-items: center;">
                        @if (isset($myIdBool))
                            @include('FrontEnd.Component.MultiLang', ['id' => $myId])
                        @else
                            @include('FrontEnd.Component.MultiLang')
                        @endif
                    </div>


                    <div class="option-item">
                        <img src="/CompanyLogos/{{ session()->get('CompanyUser')->CompanyLogo }}" alt="profile picture"
                            style="width: 40px; height: 40px; border-radius: 100%; margin-left:10px; object-fit: cover;"
                            class="navbar-img-mobile">
                    </div>

                    <li class="nav-item">
                        <a href="{{ route('AccountCompany', app()->getLocale()) }}"
                            class="nav-link dropdown-toggle Vacancies account ChangePass">{{ session()->get('CompanyUser')->CompanyName }}
                            @if ($empty == null)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $count }}
                                    <span class="visually-hidden">{{ __('Navbar.unread messages') }}</span>
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu ">
                            <li class="nav-item">
                                <a style="display: flex;
                                align-items: center;
                                justify-content: space-between;"
                                    href="{{ route('AccountCompany', app()->getLocale()) }}"
                                    class="nav-link account">{{ __('Navbar.Profile') }}
                                    @if ($empty == null)
                                        <span class="badge bg-danger"
                                            style="font-size: 15px;">{{ $count }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('PostAJob', app()->getLocale()) }}"
                                    class="nav-link PostAJob">{{ __('PostAJob.Post a Job') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('AccountCompanyVacancies', app()->getLocale()) }}"
                                    class="nav-link Vacancies">{{ __('Navbar.Vacancies') }}</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('ChangePassCompany', app()->getLocale()) }}"
                                    class="nav-link ChangePass">{{ __('Navbar.Change Password') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('LogoutCompany', app()->getLocale()) }}"
                                    class="nav-link">{{ __('Navbar.Logout') }}</a>
                            </li>
                        </ul>
                    </li>
                @else
                    </ul>
                    <div class="other-option" style="margin-right: 10px;">
                        <a href="{{ route('Signup', app()->getLocale()) }}"
                            class="add-vacancy-btn">{{ __('Navbar.Sign Up') }}</a>
                        <a href="{{ route('Signin', app()->getLocale()) }}"
                            class="signin-btn">{{ __('Navbar.Sign In') }}</a>
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
    <div class="sub-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul>
                        <li>
                            <a
                                href="{{ route('vacancies', app()->getLocale()) }}">{{ __('Navbar.Vakansiyalar') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('Candidates', app()->getLocale()) }}">{{ __('Navbar.CV-ler') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('Companies', app()->getLocale()) }}">{{ __('Navbar.Sirketler') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar Area End -->
