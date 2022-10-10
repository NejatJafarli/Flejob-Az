<!doctype html>
<html lang="zxx">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('FrontEnd.Component.cdn')
    <style>
        .right-filter {
            background: #FFFFFF;
            padding: 16px;
            opacity: 0.91;
            border-radius: 23px;
            margin-bottom: 36px;
        }

        .right-filter h6 {
            font-weight: 800;
            font-size: 24px;
            line-height: 29px;
            color: #1C1C1E;
        }

        .right-filter .select-price {
            display: block;
            margin-top: 24px;
        }

        .right-filter .select-price li {
            display: inline-block;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .right-filter .select-price li:last-child {
            margin-right: 0;
            margin-bottom: 0;
        }

        .right-filter .form-check {
            padding: 0;
        }

        .right-filter .form-check input {
            display: none;
        }

        .right-filter .form-check input:checked+label {
            background: #005EB8;
            color: #fff;
            border-color: #005EB8;
        }

        .right-filter .form-check label {
            padding: 4px 6px;
            background: #FFFFFF;
            border: 2px solid #D1D1D6;
            border-radius: 28px;
            cursor: pointer;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            color: #1C1C1E;
        }

        .right-filter .price {
            border-bottom: 1px solid #D1D1D6;
            padding-bottom: 32px;
        }

        .right-filter .price .tofrom {
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .right-filter .price .tofrom .to {
            height: 56px;
            display: flex;
            align-items: center;
            padding: 16px;
            border: 3px solid #D1D1D6;
            border-radius: 13px 0px 0 13px;
            transition: all 0.3s ease;
        }

        .right-filter .price .tofrom .to:hover {
            border-color: #005EB8;
        }

        .right-filter .price .tofrom .to span {
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #000000;
            margin-right: 8px;
        }

        .right-filter .price .tofrom .to input {
            border: none;
            width: 100%;
            font-weight: 500;
            font-size: 20px;
            line-height: 24px;
            color: #000000;
            outline: none;
            box-shadow: none;
        }

        .right-filter .price .tofrom .from {
            height: 56px;
            display: flex;
            align-items: center;
            padding: 16px;
            border: 3px solid #D1D1D6;
            border-radius: 0 13px 13px 0;
        }

        .right-filter .price .tofrom .from:hover {
            border-color: #005EB8;
        }

        .right-filter .price .tofrom .from span {
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #000000;
            margin-right: 8px;
        }

        .right-filter .price .tofrom .from input {
            border: none;
            width: 100%;
            font-weight: 500;
            font-size: 20px;
            line-height: 24px;
            color: #000000;
            outline: none;
            box-shadow: none;
        }

        .right-filter .brend {
            border-bottom: 1px solid #D1D1D6;
            padding-bottom: 32px;
            padding-top: 32px;
        }

        .right-filter .brend .form-select {
            outline: none;
            box-shadow: none;
            margin-top: 16px;
            padding: 16px;
            border: 2px solid #D1D1D6;
            border-radius: 13px;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            color: #1C1C1E;
        }

        .right-filter .brend .form-select option {
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            color: #1C1C1E;
        }

        .right-filter .discount {
            border-bottom: 1px solid #D1D1D6;
            padding-bottom: 32px;
            padding-top: 32px;
        }

        .right-filter .filter-btn {
            margin-top: 32px;
        }

        .right-filter .filter-btn button {
            display: block;
            padding: 16px 32px;
            width: 100%;
            border-radius: 18px;
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            line-height: 24px;
        }

        .right-filter .filter-btn .btn-submit {
            background: #005EB8;
            color: #FFFFFF;
            border: 1px solid #005EB8;
        }

        .right-filter .filter-btn .btn-clear {
            margin-top: 8px;
            background-color: #FFFFFF;
            color: #8E8E93;
            border: 1px solid #D1D1D6;
        }
    </style>
</head>

<body>

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
                                <a href="about.html" class="nav-link">About</a>
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
                                <a href="#" class="nav-link dropdown-toggle active">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="company.html" class="nav-link">Company</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pricing.html" class="nav-link">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link dropdown-toggle active">Profile</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a href="account.html" class="nav-link">Account</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link dropdown-toggle active">Member</a>

                                                <ul class="dropdown-menu">
                                                    <li class="nav-item">
                                                        <a href="sign-in.html" class="nav-link">Sign In</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="sign-up.html" class="nav-link active">Sign Up</a>
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
                        </ul>

                        <div class="other-option">
                            <a href="{{ route('Signup', app()->getLocale()) }}" class="signup-btn">Sign Up</a>
                            <a href="{{ route('Signin', app()->getLocale()) }}" class="signin-btn">Sign In</a>
                        </div>
                        @include('FrontEnd.Component.MultiLang')
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg13">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Sign Up</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Sign Up</li>
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

    <!-- Sign up Section Start -->
    <div class="signup-section ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-9 ">
                    <form method="POST" action="{{ route('RegisterUser', app()->getLocale()) }}"
                        enctype="multipart/form-data" class="signup-form" id="SignupForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="FirstName" class="form-control"
                                        placeholder="Enter First Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="LastName" class="form-control"
                                        placeholder="Enter Last Name" required>
                                </div>
                            </div>
                            {{-- father name --}}
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Father Name</label>
                                    <input type="text" name="FatherName" class="form-control"
                                        placeholder="Enter Father Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BirthDate</label>
                                    <input name="BirthDate" type="date" class="form-control"
                                        placeholder="Enter BirthDate" required>
                                </div>
                            </div>
                            {{-- UserName --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="Username" type="text" class="form-control"
                                        placeholder="Enter Username" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                {{-- Password --}}
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="Password" type="password" class="form-control"
                                        placeholder="Enter Password" required>
                                </div>
                            </div>
                            {{-- Password Confirmation --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password Confirmation</label>
                                    <input name="Password_confirmation" type="password" class="form-control"
                                        placeholder="Enter Password Confirmation" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control"
                                        placeholder="Enter Email" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select City</label>
                                    <select name="City" class="form-control">
                                        @foreach ($cities as $City)
                                            <option value="{{ $City->id }}">{{ $City->city_lang->CityName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Phone --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Format: +994xxxxxxxxx</label>
                                    <input value="+994" name="phone" type="text" class="form-control"
                                        placeholder="Enter Phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profile Picture (Types jpeg,png,jpg,gif,svg Max 2Mb) </label>
                                    <input class="form-control" name="image" type="file" style="padding: 5px 20px; height: 50px;"
                                        placeholder="Enter Profile Picture" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Married</label>
                                    <select name="Married" class="form-control">
                                        <option value="0">Single</option>
                                        <option value="1">Married</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="Description" style="height: 250px;" cols="30" rows="10" class="form-control"
                                        placeholder="Enter Description" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Skills</label>
                                    <textarea name="Skills" style="height: 250px;" cols="30" rows="10" class="form-control"
                                        placeholder="Enter Skills" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Languages</label>
                                <select class="js-example-basic-multiple form-control" name="Languages[]"
                                    multiple="multiple">
                                    @foreach ($languages as $Language)
                                        <option value="{{ $Language->id }}">{{ $Language->LanguageName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Categories</label>
                                <select class="js-example-basic-multiple form-control" name="Categories[]"
                                    multiple="multiple">
                                    @foreach ($categories as $Category)
                                        <option value="{{ $Category->id }}">
                                            {{ $Category->Category_lang->CategoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tofrom col-md-6 my-5">
                                <span>Min Salary ₼</span>
                                <div class="form-group">
                                    <label></label>
                                    <input name="MinSalary" type="number" class="form-control"
                                        placeholder="Enter Min Salary" id="flefilter_price_min">
                                </div>
                            </div>
                            <div class="from col-md-6 my-5">
                                <span>Max Salary ₼</span>
                                <div class="form-group">
                                    <label></label>
                                    <input name="MaxSalary" type="number" class="form-control"
                                        placeholder="Enter Max Salary" id="flefilter_price_max">
                                </div>
                            </div>
                            <div class="price-filter">
                                <input type="text" class="js-range-slider" value="" min-price="1"
                                    current-min-price="1" current-max-price="29999" max-price="29999" />
                            </div>
                            <div class="col-md-6">
                                <label>Company Experince</label>
                                {{-- add + Button --}}
                                <div class="form-group d-flex justify-content-center">
                                    <button onclick="MyFunc1()" style="width: 75%" type="button"
                                        class="btn btn-primary" id="add1">+</button>
                                </div>
                                {{--  add border to div --}}
                                <div id="CompanyExp">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Education</label>
                                {{-- add + Button --}}
                                <div class="form-group d-flex justify-content-center">
                                    @php
                                        
                                        $name = [];
                                        $id = [];
                                        foreach ($education_levels as $value) {
                                            $name[] = $value->EducationLevel_lang->EducationLevelName;
                                            $id[] = $value->id;
                                        }
                                        
                                        $name = implode(',', $name);
                                        // add start and end "
                                        $name = '"' . str_replace(',', '","', $name) . '"';
                                        $id = implode(',', $id);
                                    @endphp


                                    <button onclick="MyFunc2([{{ $name }}],[{{ $id }}])"
                                        style="width: 75%" type="button" class="btn btn-primary "
                                        id="add2">+</button>
                                </div>
                                {{--  add border to div --}}
                                <div id="Education">

                                </div>
                            </div>
                            {{-- // add links with names --}}
                            <div class="col-md-12">
                                <label>Links</label>
                                {{-- add + Button --}}
                                <div class="form-group d-flex justify-content-center">
                                    <button onclick="MyFunc3()" style="width: 75%" type="button"
                                        class="btn btn-primary" id="add3">+</button>
                                </div>
                                {{--  add border to div --}}
                                <div id="Links"></div>
                                <div class="signup-btn text-center">
                                    <button type="button"
                                        onclick="Signup('{{ route('SignUpControllerAjax', app()->getLocale()) }}')">Sign
                                        Up</button>
                                </div>

                                <div class="other-signup text-center">
                                    <div class="create-btn text-center">
                                        <p>
                                            Have an Account?
                                            <a href="{{ route('Signin', app()->getLocale()) }}">
                                                Sign In
                                                <i class='bx bx-chevrons-right bx-fade-right'></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                                        <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                                        <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up Section End -->
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
    </section> --}}
    <!-- Subscribe Section End -->
    <script src="/assets2/js/Script.js"></script>
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
    @include('FrontEnd.Component.Footer')
