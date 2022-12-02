<!doctype html>
<html lang="zxx">

<head>

    @include('FrontEnd/Component/cdn')
</head>

<body>

    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg12">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Sign In</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Sign In</li>
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

    <!-- Sign In Section Start -->
    <div class="signin-section ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 offset-md-2 offset-lg-3">
                    {{-- show erros --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">Sign In With
                                User</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">Sign In With
                                Company</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home-1" role="tabpanel">
                            <form id="signin" class="signin-form" method="POST"
                                action="{{ route('Signin', app()->getLocale()) }}" enctype="multipart/form-data"
                                id="SigninForm">
                                @csrf
                                <div class="form-group">
                                    <label>Enter Email & Username</label>
                                    <input id="username" name="Email" type="text" class="form-control"
                                        placeholder="Enter Your Email & Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Enter Password</label>
                                    <input id="pass" name="Password" type="password" class="form-control"
                                        placeholder="Enter Your Password" required>
                                </div>
                                <div class="signin-btn text-center">
                                    <button>Sign In</button>
                                </div>
                                <div class="create-btn text-center">
                                    <p>Not have an account?
                                        <a href="{{ route('Signup', app()->getLocale()) }}">
                                            Create an account
                                            <i class='bx bx-chevrons-right bx-fade-right'>

                                            </i>
                                        </a>
                                    </p>
                                </div>
                                <div class="create-btn text-center">
                                    <p>you can't remember your password?
                                        <a href="{{ route('ResetPasswordUser', app()->getLocale()) }}">
                                            Forget Password
                                            <i class='bx bx-chevrons-right bx-fade-right'>

                                            </i>
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="profile-1" role="tabpanel">
                            <form id="signinCompany" class="signin-form" method="POST"
                                action="{{ route('SigninCompany', app()->getLocale()) }}" enctype="multipart/form-data"
                                id="SigninForm">
                                @csrf
                                <div class="form-group">
                                    <label>Enter Company Email & Username</label>
                                    <input id="CompanyUsername" name="CompanyEmail" type="text" class="form-control"
                                        placeholder="Enter Your Email & Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Enter Company Password</label>
                                    <input id="CompanyPass" name="CompanyPassword" type="password" class="form-control"
                                        placeholder="Enter Your Password" required>
                                </div>
                                <div class="signin-btn text-center">
                                    <button>Sign In</button>
                                </div>
                                <div class="create-btn text-center">
                                    <p>Not have an account?
                                        <a href="{{ route('Signup', app()->getLocale()) }}">
                                            Create an account
                                            <i class='bx bx-chevrons-right bx-fade-right'>

                                            </i>
                                        </a>
                                    </p>
                                </div>
                                <div class="create-btn text-center">
                                    <p>you can't remember your password?
                                        <a href="{{ route('ResetPasswordCompany', app()->getLocale()) }}">
                                            Forget Password
                                            <i class='bx bx-chevrons-right bx-fade-right'>

                                            </i>
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In Section End -->
    {{-- 
        <!-- Subscribe Section Start -->
        <section class="subscribe-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="section-title">
                            <h2>Get New Job Notifications</h2>
                            <p>Subscribe & get all related jobs notification</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <form class="newsletter-form" data-toggle="validator">
                            <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required autocomplete="off">
    
                            <button class="default-btn sub-btn" type="submit">
                                Subscribe
                            </button>
    
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Subscribe Section End --> --}}
    <script src="/assets2/js/Script.js"></script>
    @include('FrontEnd/Component/Footer')

</html>
