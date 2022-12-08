<!doctype html>
<html lang="zxx">

<head>

    @include('FrontEnd.Component.cdn')
</head>

<body>

    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('Hom');
            Hom.classList.add('active');
        });
    </script>
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
                                <form class="find-form" action="{{ route('FindAJob', app()->getLocale()) }}"
                                    method="GET">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <label>Job Title <i class="bx bx-search-alt"></i></label>
                                            <div class="form-group">
                                                <input name="VacancyName"
                                                    value="{{ request()->get('VacancyName') ? request()->get('VacancyName') : '' }}"
                                                    type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Job Title or Keyword">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Cities <i class="bx bx-location-plus"></i></label>
                                            <select name="City" class="form-select" id="City"
                                                style="height: 60px;border-radius: 10px; padding: 5px 20px 10px;">
                                                <option value="All">All Cities</option>
                                                @foreach ($Cities as $city)
                                                    @php
                                                        $selected = '';
                                                        if ($city->id == request()->get('City')) {
                                                            $selected = 'selected';
                                                        }
                                                    @endphp
                                                    <option value="{{ $city->id }}" {{ $selected }}>
                                                        {{ $city->CityLang->CityName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Categories <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 25 25">
                                                    <path
                                                        d="M10 3H4C3.447 3 3 3.447 3 4v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1V4C11 3.447 10.553 3 10 3zM9 9H5V5h4V9zM20 3h-6c-.553 0-1 .447-1 1v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1V4C21 3.447 20.553 3 20 3zM19 9h-4V5h4V9zM10 13H4c-.553 0-1 .447-1 1v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1v-6C11 13.447 10.553 13 10 13zM9 19H5v-4h4V19zM17 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4S19.206 13 17 13zM17 19c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2S18.103 19 17 19z" />
                                                </svg></label>
                                            <select name="Category" class="category form-select"
                                                style="height: 60px;border-radius: 10px; padding: 5px 20px 10px;">
                                                <option value="All">All Categories</option>
                                                @foreach ($Categories as $cat)
                                                    @php
                                                        $selected = '';
                                                        if ($cat->id == request()->get('Category')) {
                                                            $selected = 'selected';
                                                        }
                                                    @endphp
                                                    <option value="{{ $cat->id }}" {{ $selected }}>
                                                        {{ $cat->Category_lang->CategoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="tofrom col-md-2 my-5">
                                            <span>Min Salary ₼</span>
                                            <div class="form-group">

                                                <label></label>
                                                <input name="MinSalary" type="number" class="form-control"
                                                    placeholder="Enter Min Salary" id="flefilter_price_min">
                                            </div>
                                        </div>
                                        <div class="from col-md-2 my-5">
                                            <span>Max Salary ₼</span>
                                            <div class="form-group">
                                                <label></label>
                                                <input name="MaxSalary" type="number" class="form-control"
                                                    placeholder="Enter Max Salary" {{-- value="{{ request()->get('MaxSalary') ? request()->get('MaxSalary') : '' }}" --}}
                                                    id="flefilter_price_max">
                                            </div>
                                        </div>
                                        <div class="price-filter col-md-8 my-5">
                                            <input type="text" class="js-range-slider" value="" min-price="1"
                                                current-min-price="{{ request()->get('MinSalary') ? request()->get('MinSalary') : 1 }}"
                                                current-max-price="{{ request()->get('MaxSalary') ? request()->get('MaxSalary') : 29999 }}"
                                                max-price="29999" />
                                        </div>
                                        <div class="col-lg-12">
                                            <label> </label>
                                            <div class="jobs-btn" style="text-align: right">
                                                <button type="submit" class="find-btn"
                                                    style="width: auto; padding:16px 100px">
                                                    Find A Job
                                                    <i class='bx bx-search'></i>
                                                </button>
                                            </div>
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
                        <a href="{{ route('FindAJob', app()->getLocale()) }}?Category={{ $cat->id }}">
                            <div class="category-card" style="height: 280px">
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
                <div>
                    <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                    <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                    <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                </div>
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
                                        <a
                                            href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">
                                            <img style="height: 50px; width:50px"
                                                src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}" alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="job-info">
                                        <h3>
                                            <a
                                                href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">{{ $vac->VacancyName }}</a>
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
                                        @if (session()->get('user'))
                                            @php
                                                $userApplied = false;
                                                if (session()->get('user')) {
                                                    foreach (session()->get('user')->AppliedVacancies as $UserVac) {
                                                        if ($UserVac->Vacancy_id == $vac->id) {
                                                            $userApplied = true;
                                                            break;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <button
                                                onclick="ApplyVac(this,'{{ route('ApplyVacancy', ['language' => app()->getLocale(), 'id' => $vac->id]) }}')"
                                                type="button" class="btn btn-primary" data-toggle="modal">
                                                {{ $userApplied ? 'UnApply Now' : 'Apply Now' }}</button>
                                        @endif
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
                        <div class="company-card" style="height: 300px">
                            <div class="thumb-img">
                                <img style="height: 70px; width:70px" src="/CompanyLogos/{{ $user->CompanyLogo }}"
                                    alt="company logo">
                            </div>
                            <div class="company-text">
                                <h3>
                                    <span>{{ $user->CompanyName }}</span>
                                </h3>
                                <p>
                                    <i class="bx bx-location-plus"></i>
                                    {{ $user->CompanyAddress }}
                                </p>
                                <a href="{{ route('FindAJob', app()->getLocale()) }}?Company={{ $user->id }}"
                                    class="company-btn">
                                    {{ $user->VacanciesCount }} Open Position
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Companies Section End -->
    {{-- 
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
    </section> --}}
    <!-- Why Choose Section End -->

    {{-- 
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
    </section> --}}
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
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-card">
                            <div class="blog-img" >
                                <a href="{{route('BlogDetail',['language'=>app()->getLocale(),'id'=> $blog->id])}}">
                                    <img src="/BlogsPicture/{{$blog->Image}}" alt="blog image" style="object-fit:cover;
                                    ">
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
                                        {{ $blog->created_at->DiffForHumans() }}
                                    </li>
                                </ul>
                                <h3>
                                    <a href="{{route('BlogDetail',['language'=>app()->getLocale(),'id'=> $blog->id])}}">
                                        {{ $blog->Title }}
                                    </a>
                                </h3>
                                @php
                                    //get first 30 characters
                                    $str = substr($blog->Description, 0, 40)."...";
                                @endphp
                                <p>{{ $str }}</p>

                                <a href="{{route('BlogDetail',['language'=>app()->getLocale(),'id'=> $blog->id])}}" class="blog-btn">
                                    Read More
                                    <i class='bx bx-plus bx-spin'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Blog Section End -->

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
    <script>
        //document ready
        $(document).ready(function() {

        });

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
