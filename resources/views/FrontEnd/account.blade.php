<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

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
                                            <a href="" class="nav-link">Profile</a>
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
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Account</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
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
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="account-information">
                        <div class="profile-thumb">
                            <img class="img-fluid" src="/CandidatesPicture/{{ session()->get('user')->image }}"
                                alt="account holder image"
                                style="max-width: 200px; height:200px;border-radius: 0; width:100%;object-fit:cover">
                            <h3>{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</h3>
                            {{-- category List --}}
                            @foreach (session()->get('user')->Categories as $category)
                                <p>{{ $category->Category_lang->CategoryName }}</p>
                            @endforeach
                        </div>

                        <ul>
                            <li>
                                <a href="{{ route('Account', app()->getLocale()) }}" class="active">
                                    <i class='bx bx-user'></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="resume.html">
                                    <i class='bx bxs-file-doc'></i>
                                    My Resume
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-briefcase'></i>
                                    Applied Job
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-envelope'></i>
                                    Messages
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-heart'></i>
                                    Saved Jobs
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-lock-alt'></i>
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-coffee-togo'></i>
                                    Delete Account
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-log-out'></i>
                                    Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="account-details">
                        <h3>Information</h3>
                        {{-- show errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('UpdateUser', app()->getLocale()) }}"
                            enctype="multipart/form-data" class="basic-info" id="EditAccountForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="FirstName" type="text"
                                            value="{{ session()->get('user')->FirstName }}" class="form-control"
                                            placeholder="Enter Your First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="LastName" type="text"
                                            value="{{ session()->get('user')->LastName }}" class="form-control"
                                            placeholder="Enter Your Last Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input name="Username" type="text"
                                            value="{{ session()->get('user')->Username }}" class="form-control"
                                            placeholder="Enter Your Username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input name="FatherName" type="text"
                                            value="{{ session()->get('user')->FatherName }}" class="form-control"
                                            placeholder="Enter Your Father Name">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email"
                                            value="{{ session()->get('user')->email }}" class="form-control"
                                            placeholder="Enter Your Email">
                                    </div>
                                </div>


                                {{-- add City select --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select name="City" class="form-control">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($city->id == session()->get('user')->City_id) selected @endif>
                                                    {{ $city->CityLang->CityName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{-- BirthDate --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input name="BirthDate" type="date"
                                            value="{{ session()->get('user')->BirthDate }}" class="form-control"
                                            placeholder="Enter Your Birth Date" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text"
                                            value="{{ session()->get('user')->phone }}" class="form-control"
                                            placeholder="Your Phone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Maried</label>
                                        <select name="Married" class="form-control">
                                            <option value="1">Maried</option>
                                            <option value="0">Not Maried</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- change image --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>if You Want Change Image Upload New Image</label>
                                        <input name="image" type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="Description" style="height: 250px;" cols="30" rows="10" class="form-control"
                                            placeholder="Enter Description">{{ session()->get('user')->Description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Skills</label>
                                        <textarea name="Skills" style="height: 250px;" cols="30" rows="10" class="form-control"
                                            placeholder="Enter Skills">{{ session()->get('user')->Skills }}</textarea>
                                    </div>
                                </div>
                                {{-- add User Know languages and categories --}}
                                <div class="col-md-6">
                                    <label>Categories</label>
                                    <select class="js-example-basic-multiple form-control" name="Categories[]"
                                        multiple="multiple">
                                        @foreach ($categories as $Category)
                                            <option value="{{ $Category->id }}"
                                                {{ $Category->Selected ? 'Selected' : '' }}>
                                                {{ $Category->CategoryLang->CategoryName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Categories</label>
                                    <select class="js-example-basic-multiple form-control" name="Languages[]"
                                        multiple="multiple">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                {{ $language->Selected ? 'Selected' : '' }}>
                                                {{ $language->LanguageName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="tofrom col-md-6 my-5">
                                    <span>Min Salary ₼ {{ session()->get('user')->MaxSalary }}</span>
                                    <div class="form-group">
                                        <label></label>
                                        <input name="MinSalary" value="{{ session()->get('user')->MinSalary }}"
                                            type="number" class="form-control" placeholder="Enter Min Salary"
                                            id="flefilter_price_min">
                                    </div>
                                </div>
                                <div class="from col-md-6 my-5">
                                    <span>Max Salary ₼</span>
                                    <div class="form-group">
                                        <label></label>
                                        <input name="MaxSalary" value="{{ session()->get('user')->MaxSalary }}"
                                            type="number" class="form-control" placeholder="Enter Max Salary"
                                            id="flefilter_price_max">
                                    </div>
                                </div>
                                <div class="price-filter col-md-12">
                                    <input type="text" class="js-range-slider" value="" min-price="1"
                                        current-min-price="{{ session()->get('user')->MinSalary }}"
                                        current-max-price="{{ session()->get('user')->MaxSalary }}"
                                        max-price="29999" />
                                </div>
                            </div>
                            <div class="col-md-12 py-2">
                                <button type="submit" class="account-btn">Save</button>
                            </div>
                        </form>
                        <h3>Educations</h3>
                        <form method="POST" action="{{route('UpdateUserEducation',app()->getLocale())}}" class="cadidate-others">
                            @csrf
                            <div class="row">
                                @foreach (session()->get('user')->Educations as $Education)
                                <input type="hidden" name="EducationId[]" value="{{$Education->id}}">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Education Name</label>
                                            <input name="EducationName[]" type="text"
                                                value="{{ $Education->EducationName }}" class="form-control"
                                                placeholder="Enter Education Name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Education Start Date</label>
                                            <input name="YearStart[]" type="number"
                                                value="{{ $Education->YearStart }}" class="form-control"
                                                placeholder="Enter Education Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Education End Date</label>
                                            <input name="YearEnd[]" type="number"
                                                value="{{ $Education->YearEnd }}" class="form-control"
                                                placeholder="Enter Education End Date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Education Level</label>
                                            <select name="EducationLevel[]" class="form-control">
                                                @foreach ($education_levels as $Level)
                                                    <option value="{{ $Level->id }}"
                                                        {{ $Level->id == $Education->EducationLevel_Id ? 'Selected' : '' }}>
                                                        {{ $Level->EducationLevelLang->EducationLevelName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="col-md-12">
                                @endforeach
                                <div class="col-md-12">
                                    <button type="submit" class="account-btn">Save</button>
                                </div>
                            </div>
                        </form>

                        <h3>Links</h3>
                        <form class="candidates-sociak">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Github</label>
                                        <input type="text" class="form-control" placeholder="www.Github.com/user">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="account-btn">Edit</button>
                                    <button type="submit" class="account-btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Area End -->

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
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL"
                            required autocomplete="off">

                        <button class="default-btn sub-btn" type="submit">
                            Subscribe
                        </button>

                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->

    @include('FrontEnd.Component.Footer')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();


            if ($(".js-range-slider").length > 0) {
                let currentMinPrice = $(".js-range-slider").attr("current-min-price");
                let maxPrice = $(".js-range-slider").attr("max-price");
                let minPrice = $(".js-range-slider").attr("min-price");
                let currentMaxPrice = $(".js-range-slider").attr("current-max-price");
                $(".js-range-slider").ionRangeSlider({
                    type: "double",
                    min: minPrice,
                    max: maxPrice,
                    from: currentMinPrice,
                    to: currentMaxPrice,
                    grid: 0,

                    onStart: function(data) {
                        $("#flefilter_price_min").val(data.from);
                        $("#flefilter_price_max").val(data.to);
                    },
                    onChange: function(data) {
                        $("#flefilter_price_min").val(data.from);
                        $("#flefilter_price_max").val(data.to);
                    },
                });
                $("#flefilter_price_min").on("change", function() {
                    let value = $(this).val();
                    let maxPrice = $("#flefilter_price_max").val();
                    value = parseInt(value);
                    minPrice = parseInt(minPrice);
                    if (value > maxPrice) {
                        value = maxPrice;
                        $(this).val(value);
                    }
                    $(".js-range-slider").data("ionRangeSlider").update({
                        from: value,
                    });
                });
                $("#flefilter_price_max").on("change", function() {
                    let value = $(this).val();
                    let minPrice = $("#flefilter_price_min").val();
                    value = parseInt(value);
                    minPrice = parseInt(minPrice);
                    if (value < minPrice) {
                        value = minPrice;
                        $(this).val(value);
                    }
                    $(".js-range-slider").data("ionRangeSlider").update({
                        to: value,
                    });
                });
                $("#module-flefilter input,#module-flefilter select").on(
                    "change",
                    function() {
                        $("#module-flefilter-submit").removeClass("d-none");
                    }
                );
            }
        });
    </script>

</html>
