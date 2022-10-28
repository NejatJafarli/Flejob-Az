<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    <!-- Pre-loader End -->
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
    @include('FrontEnd.Component.Preloader')

    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('JobDetails');
            Hom.classList.add('active');
        });
    </script>
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Account</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Account</li>
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

    <!-- Account Area Start -->
    <section class="account-section ptb-100">
        <div class="container" style="">
            <div class="row">
                <div class="col-md-3">
                    <div class="account-information">
                        <div class="profile-thumb">
                            <img class="img-fluid"
                                src="/CompanyLogos/{{ session()->get('CompanyUser')->CompanyLogo }}"
                                alt="account holder image"
                                style="max-width: 200px; height:200px;border-radius: 0; width:100%;object-fit:cover">
                            <h3>{{ session()->get('CompanyUser')->CompanyName }}</h3>
                            {{-- category List --}}
                            @foreach (session()->get('CompanyUser')->Categories as $category)
                                <p>{{ $category->Category_lang->CategoryName }}</p>
                            @endforeach
                        </div>
                        @include('FrontEnd.Component.AccountSideBarCompany')
                        <script>
                            $(document).ready(function() {
                                var account = document.getElementById('Vacancies');
                                account.classList.add('active');
                            });
                        </script>
                    </div>
                </div>

                <div class="col-md-9 account-details row">
                    @foreach ($myCandidates as $can)
                        <div class="col-md-4">
                            <div class="candidate-card">
                                <div class="candidate-img">
                                    <img src="/CandidatesPicture/{{ $can->image }}" class="img-fluid"
                                        alt="candidate image ">
                                </div>
                                <div class="candidate-text m-0">
                                    <h3>
                                        <a
                                            href="{{ route('CandidateDetails', ['language' => app()->getLocale(), 'id' => $can->id]) }}">{{ $can->FirstName . ' ' . $can->LastName }}</a>
                                    </h3>
                                    <ul>
                                        @foreach ($can->Categories as $category)
                                            <li>{{ $category->Category_lang->CategoryName }}</li>
                                        @endforeach
                                        <li>
                                            <button onclick="GetUserIdAndSendModalForm('{{ $can->id }}')"
                                                type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Send Message To Candidate
                                            </button>
                                            {{-- <a href="{{ route('SendMessageCandidate', ['language' => app()->getLocale(), 'id' => $can->id]) }}" --}}
                                            {{-- class="btn btn-primary">Send Message</a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $Candidates->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                    <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                    <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                    <form method="POST" action="{{ route('SendMessagePost', app()->getLocale()) }}"
                        enctype="multipart/form-data" class="basic-info" id="SendMessage">
                        @csrf
                        <input type="hidden" name="UserId" id="UserId" />
                        <input type="hidden" name="VacId" value="{{ $vac->id }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="MessageTitle"> Message Title</label>
                                    <input type="text" class="form-control" id="MessageTitle" name="MessageTitle"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="Message"> Message</label>
                                <textarea style="height: 250px" class="form-control" id="Message" name="Message" rows="10" cols="30"
                                    required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="CloseModal()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="SubmitForm('{{ route('SendMessagePost', app()->getLocale()) }}')"
                        class="btn btn-primary">Send Message To Candidate</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Area End -->
    <script>
        function CloseModal() {
            //set defaults
            // MessageTitle get elementby id
            document.getElementById('MessageTitle').value = '';
            let msg = document.getElementById('Message');
            msg.value = "";
            msg.style['height'] = '250px';


            //close modal
            setTimeout(function() {
                $('div.Myfailure').html("");
                $('div.Mysuccess').html("");
                $('#exampleModal').modal('hide');
            }, 800)

        }

        function GetUserIdAndSendModalForm(id) {
            document.getElementById('UserId').value = id;
        }


        function SubmitForm(url) {

            FData = new FormData(document.getElementById('SendMessage'))

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: url,
                type: 'POST',
                data: FData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data)
                    if (data.hasOwnProperty('errors')) {
                        let errValues = Object.values(data.errors)
                        let errStr = ''

                        for (let i = 0; i < data.errors.length; i++)
                            errStr += errValues[i] + '<br>'

                        $('div.Myfailure').html(errStr)
                        $('div.Myfailure')
                            .fadeIn(300)
                            .delay(5000)
                            .fadeOut(400)


                    } else if (data.hasOwnProperty('success')) {
                        $('div.Mysuccess').html(data.success)
                        $('div.Mysuccess')
                            .fadeIn(300)
                            .delay(5000)
                            .fadeOut(400)

                        CloseModal();
                    }
                },
                error: function(data) {
                    console.log(data)
                    let errKeys = Object.keys(data.responseJSON.errors)
                    let errValues = Object.values(data.responseJSON.errors)
                    let errStr = ''
                    for (let i = 0; i < errKeys.length; i++) {
                        errStr += errKeys[i] + ' : ' + errValues[i][0] + '<br>'
                    }
                    $('div.Myfailure').html(errStr)
                    $('div.Myfailure')
                        .fadeIn(300)
                        .delay(5000)
                        .fadeOut(400)
                }
            })
        }
    </script>
    @include('FrontEnd.Component.Footer')

</html>
