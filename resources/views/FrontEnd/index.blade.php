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
                    <div class="banner-content text-center ">
                        <div class="row">
                            <div class="col-12">
                                <p>{{ __('home.Find Jobs, Employment & Career Opportunities') }}</p>
                                <h1>{{ __('home.Drop Resume & Get Your Desire Job!') }}</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="find-section pb-100 py-5 col-md-8" style="background: white; border-radius:0px">
                                <form class="find-form" style="margin: 0; box-shadow:0;-webkit-box-shadow:0 !important;"
                                    action="{{ route('FindAJob', app()->getLocale()) }}" method="GET">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 mb-5">
                                                    <label>{{ __('home.Job Title') }}<i
                                                            class="bx bx-search-alt"></i></label>
                                                    <div class="form-group">
                                                        <input name="VacancyName"
                                                            value="{{ request()->get('VacancyName') ? request()->get('VacancyName') : '' }}"
                                                            type="text" class="form-control" id="exampleInputEmail1"
                                                            placeholder="{{ __('home.Job Title or Keyword') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-5">
                                                    <label>{{ __('home.Categories') }} <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 25 25">
                                                            <path
                                                                d="M10 3H4C3.447 3 3 3.447 3 4v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1V4C11 3.447 10.553 3 10 3zM9 9H5V5h4V9zM20 3h-6c-.553 0-1 .447-1 1v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1V4C21 3.447 20.553 3 20 3zM19 9h-4V5h4V9zM10 13H4c-.553 0-1 .447-1 1v6c0 .553.447 1 1 1h6c.553 0 1-.447 1-1v-6C11 13.447 10.553 13 10 13zM9 19H5v-4h4V19zM17 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4S19.206 13 17 13zM17 19c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2S18.103 19 17 19z" />
                                                        </svg></label>
                                                    <select name="Category" class="category form-select"
                                                        style="height: 60px;border-radius: 10px; padding: 5px 20px 10px;">
                                                        <option value="All">{{ __('home.All Categories') }}
                                                        </option>
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
                                                <div class="col-md-6 mb-5">
                                                    <label>{{ __('home.Cities') }} <i
                                                            class="bx bx-location-plus"></i></label>
                                                    <select name="City" class="form-select" id="City"
                                                        style="height: 60px;border-radius: 10px; padding: 5px 20px 10px;">
                                                        <option value="All">{{ __('home.All Cities') }}</option>
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

                                                <div class="col-md-6 mb-5">
                                                    <div class="row">
                                                        <div class="tofrom col-md-6">
                                                            <span> {{ __('home.Min Salary') }} </span>
                                                            <div class="form-group">

                                                                {{-- <label></label> --}}
                                                                <input min="0" name="MinSalary" type="number"
                                                                    class="form-control"
                                                                    placeholder="{{ __('home.Enter Min Salary') }}"
                                                                    id="flefilter_price_min">
                                                            </div>
                                                        </div>
                                                        <div class="from col-md-6">
                                                            <span>{{ __('home.Max Salary') }} </span>
                                                            <div class="form-group">
                                                                {{-- <label></label> --}}
                                                                <input min="0" name="MaxSalary" type="number"
                                                                    class="form-control"
                                                                    placeholder="{{ __('home.Enter Max Salary') }}"
                                                                    {{-- value="{{ request()->get('MaxSalary') ? request()->get('MaxSalary') : '' }}" --}} id="flefilter_price_max">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label> </label>
                                                    <div class="jobs-btn"
                                                        style="text-align: right; display:grid; width:100%">
                                                        <button type="submit" class="find-btn"
                                                            style="width: auto; 
                                                        ">
                                                            {{ __('home.Find A Job') }}
                                                            <i class='bx bx-search'></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4"></div> --}}
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4 py-5 pb-100 " style="background: white;border-radius:0px">

                                @php
                                    
                                    //use models config
                                    use App\Models\config;
                                    // site-ads-static-1
                                    $site_ads_static_1 = config::where('key', 'site-ads-static-1')->first()->value;
                                    $SiteOneLink = config::where('key', 'site-links-1')->first()->value;
                                    
                                @endphp
                                <a href="{{ $SiteOneLink }}" target="_blank">
                                    <div class="ads-banner">
                                        <img class="img-fluid" src="/AdsImages/{{ $site_ads_static_1 }}"
                                            alt="">
                                    </div>
                                </a>
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
                <h2>{{ __('home.Choose Your Category') }}</h2>
            </div>

            <div class="row">
                {{-- categories --}}
                @foreach ($Categories as $cat)
                    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ route('FindAJob', app()->getLocale()) }}?Category={{ $cat->id }}">
                            <div class="category-card" style="height: 280px">
                                @php
                                    echo $cat->StyleClass;
                                @endphp
                                <h3>{{ $cat->Category_lang->CategoryName }}</h3>
                                <p>{{ $cat->VacanciesCount }} {{ __('home.Open Position') }}</p>
                            </div>
                        </a>
                    </div> --}}

                    <div class="col-lg-3 col-md-4 col-sm-6" style="padding:10px;">
                        <div class="category-items-home" style="height: 100%;">
                            <a
                                href="{{ route('vacancyCategories', ['language' => app()->getLocale(), 'categorySlug' => $cat->slug]) }}">
                                <h3>{{ $cat->Category_lang->CategoryName }}</h3>
                                <p>{{ $cat->MinSalary }} - {{ $cat->MaxSalary }} Azn </p>
                                <p class="mt-3">{{ $cat->VacanciesCount }} {{ __('home.Open Position') }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Category Section End -->
    @php
        $Ads = config::where('key', 'like', 'site-ads-dynamic%');
        //get count of ads
        $AdsCount = $Ads->count();
        //conver to array
        $Ads = $Ads->get()->toArray();
        //get random ads
        $random = rand(0, $AdsCount - 1);
        $AdsOne = $Ads[$random]['value'];
        //split -
        $word = explode('-', $Ads[$random]['key']);
        //get last word
        $word = $word[count($word) - 1];
        //get site-links-$word
        $AdsOneLink = config::where('key', 'site-links-' . $word)->first()->value;
        
        $random = rand(0, $AdsCount - 1);
        $AdsTwo = $Ads[$random]['value'];
        
        $word = explode('-', $Ads[$random]['key']);
        //get last word
        $word = $word[count($word) - 1];
        //get site-links-$word
        $AdsTwoLink = config::where('key', 'site-links-' . $word)->first()->value;
        
        $random = rand(0, $AdsCount - 1);
        $AdsThree = $Ads[$random]['value'];
        $word = explode('-', $Ads[$random]['key']);
        //get last word
        $word = $word[count($word) - 1];
        //get site-links-$word
        $AdsThreeLink = config::where('key', 'site-links-' . $word)->first()->value;
        
        $random = rand(0, $AdsCount - 1);
        $AdsFour = $Ads[$random]['value'];
        $word = explode('-', $Ads[$random]['key']);
        //get last word
        $word = $word[count($word) - 1];
        //get site-links-$word
        $AdsFourLink = config::where('key', 'site-links-' . $word)->first()->value;
        
        $random = rand(0, $AdsCount - 1);
        $AdsFive = $Ads[$random]['value'];
        $word = explode('-', $Ads[$random]['key']);
        //get last word
        $word = $word[count($word) - 1];
        //get site-links-$word
        $AdsFiveLink = config::where('key', 'site-links-' . $word)->first()->value;
        
        $random = rand(0, $AdsCount - 1);
        $AdsFix = $Ads[$random]['value'];
        $word = explode('-', $Ads[$random]['key']);
        //get last word
        $word = $word[count($word) - 1];
        //get site-links-$word
        $AdsFixLink = config::where('key', 'site-links-' . $word)->first()->value;
        
    @endphp
    {{-- Ads Section Start --}}
    <section class="ads-banner-sections">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <a href="{{ $AdsOneLink }}" target="_blank">
                        <div class="ads-img-block">
                            <img class="img-fluid" src="/AdsImages/{{ $AdsOne }}" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <a href="{{ $AdsTwoLink }}" target="_blank">

                        <div class="ads-img-block">
                            <img class="img-fluid" src="/AdsImages/{{ $AdsTwo }}" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <a href="{{ $AdsThreeLink }}" target="_blank">
                        <div class="ads-img-block">
                            <img class="img-fluid" src="/AdsImages/{{ $AdsThree }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- Ads Section End --}}

    <!-- Jobs Section Start -->
    <section class="job-section pb-70">
        <div class="container">
            <div class="section-title text-center">
                <p>{{ __('home.Jobs You May Be Interested In') }}</p>
            </div>

            <div class="row">
                @foreach ($PremiumVacancies as $vac)
                    <div class="col-sm-4 mb-3">
                        <div class="job-card premium-job-card">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="thumb-img">
                                        <a
                                            href="{{ route('vacancyDetails', ['language' => app()->getLocale(), 'categorySlug' => $vac->Category->slug, 'slug' => $vac->slug]) }}">
                                            <img class="img-fluid" src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}"
                                                alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="job-info">
                                        <p class="textone">
                                            <a
                                                href="{{ route('vacancyDetails', ['language' => app()->getLocale(), 'categorySlug' => $vac->Category->slug, 'slug' => $vac->slug]) }}">{{ $vac->VacancyName }}
                                            </a>
                                        </p>
                                        <ul>
                                            <li> <a
                                                    href="{{ route('CompanyVacancies', ['language' => app()->getLocale(), 'CompanySlug' => $vac->Owner->slug]) }}">{{ $vac->Owner->CompanyName }}
                                                </a></li>
                                            {{-- <li>
                                                <i class='bx bx-location-plus'></i>
                                                {{ $vac->City->CityName }}
                                            </li> --}}
                                            <li>
                                                {{-- <i class='bx bx-filter-alt'></i> --}}
                                                {{ $vac->Category->CategoryName }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3">
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
                                                {{ $userApplied ? __('home.UnApply Now') : __('home.Apply Now') }}</button>
                                        @endif
                                        <p>
                                            <i class='bx bx-stopwatch'></i>
                                            {{ $vac->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="icons-crown">
                                <i class="fa-solid fa-crown"></i>
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
                <p>{{ __('home.Top Companies') }}</p>
            </div>

            <div class="row">
                {{-- company Users List With Vacancy Count Top  Four --}}
                @php
                    
                    //sort companyUsers With Vacancy Count
                    // $MyCompanyUsers = $CompanyUsers->sortByDesc('VacanciesCount');
                @endphp
                @foreach ($CompanyUsers as $user)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="company-card premium-company-card" style="height: 100%;">
                            <div class="thumb-img">
                                <img style="height: 70px; width:70px" src="/CompanyLogos/{{ $user->CompanyLogo }}"
                                    alt="company logo">
                                <span class="badge-pro">Premium</span>
                            </div>
                            <div class="company-text">
                                <p style="textone">
                                    <span>{{ $user->CompanyName }}</span>
                                </p>
                                {{-- <p>
                                    <i class="bx bx-location-plus"></i>
                                    {{ $user->CompanyAddress }}
                                </p> --}}
                                <a href="{{ route('CompanyVacancies', ['language' => app()->getLocale(), 'CompanySlug' => $user->slug]) }}"
                                    class="company-btn">
                                    {{ $user->VacanciesCount }} {{ __('home.Open Position') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Companies Section End -->

    {{-- Ads Section Start --}}
    <section class="ads-banner-sections">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <a href="{{ $AdsFourLink }}" target="_blank">
                        <div class="ads-img-block">
                            <img class="img-fluid" src="/AdsImages/{{ $AdsFour }}" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <a href="{{ $AdsFiveLink }}" target="_blank">
                        <div class="ads-img-block">
                            <img class="img-fluid" src="/AdsImages/{{ $AdsFive }}" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <a href="{{ $AdsFixLink }}" target="_blank">
                        <div class="ads-img-block">
                            <img class="img-fluid" src="/AdsImages/{{ $AdsFix }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- Ads Section End --}}

    <!-- Jobs Section Start -->
    <section class="job-section pb-70">
        <div class="container">
            <div class="section-title text-center">
                <div>
                    <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                    <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                    <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                </div>
                <p>{{ __('home.Jobs You May Be Interested In2') }}</p>
            </div>

            <div class="row">
                @foreach ($Vacancies as $vac)
                    <div class="col-sm-4 mb-3">
                        <div class="job-card" style="background: none">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="thumb-img">
                                        <a
                                            href="{{ route('vacancyDetails', ['language' => app()->getLocale(), 'categorySlug' => $vac->Category->slug, 'slug' => $vac->slug]) }}">
                                            <img class="img-fluid" src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}"
                                                alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="job-info">
                                        <p class="textone">
                                            <a
                                                href="{{ route('vacancyDetails', ['language' => app()->getLocale(), 'categorySlug' => $vac->Category->slug, 'slug' => $vac->slug]) }}">{{ $vac->VacancyName }}
                                            </a>
                                        </p>
                                        <ul>
                                            <li> <a
                                                    href="{{ route('CompanyVacancies', ['language' => app()->getLocale(), 'CompanySlug' => $vac->Owner->slug]) }}">{{ $vac->Owner->CompanyName }}
                                                </a></li>
                                            <li>
                                                {{ $vac->Category->CategoryName }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <style>
        .job-info>.textone {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .job-info>.textone a {
            color: #000;
            transition: all 0.3s ease;
        }

        .job-info>.textone a:hover {
            color: #fd1616;
        }
    </style>

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
                        event.innerHTML = "{{ __('home.UnApply Now') }}";
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
                        event.innerHTML = "{{ __('home.Apply Now') }}";
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
