<!doctype html>
<html lang="zxx">

<head>


    @php
        use App\Models\CompanyUser;
        use App\Models\Category;
        use App\Models\lang;
        use App\Models\Vacancy;
        use App\Models\City;
        
        $Category = request()->get('Category');
        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;
        if (isset($Category) && $Category != 'All') {
            $Category = Category::where('id', $Category)->first();
            //merge with category lang
        
            $Category = $Category
                ->category_langs()
                ->where('lang_id', $lang_id)
                ->first();
        
            echo "<meta name='Title' content='$Category->MetaTitle'>";
            echo "<meta name='Description' content='$Category->MetaDescription'>";
            echo "<meta name='Keywords' content='$Category->MetaKeywords'>";
        }
        
    @endphp
    @php
        
        $MyJobs = $Jobs;
        
        //Merge Vacancies with Owner Company User
        $MyJobs = $MyJobs->map(function ($Vacancy) {
            $Vacancy->Owner = CompanyUser::where('id', $Vacancy->CompanyUser_id)->first();
            return $Vacancy;
        });
        
        //merge vacancies with category
        $MyJobs = $MyJobs->map(function ($Vacancy) use ($lang_id) {
            $cat = Category::where('id', $Vacancy->Category_id)->first();
            $Vacancy->Category = $cat
                ->category_langs()
                ->where('lang_id', $lang_id)
                ->first();
            $Vacancy->Category->StyleClass = $cat->StyleClass;
            $Vacancy->Category->SortOrder = $cat->SortOrder;
        
            return $Vacancy;
        });
        
        // merge vacancies with city
        $MyJobs = $MyJobs->map(function ($Vacancy) use ($lang_id) {
            $city = City::where('id', $Vacancy->City_id)->first();
            $Vacancy->City = $city
                ->cityLang()
                ->where('lang_id', $lang_id)
                ->first();
            return $Vacancy;
        });
        
    @endphp
    @include('FrontEnd.Component.cdn')
</head>

<body>
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')

    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('FindAJob');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>
    <!-- Page Title Start -->
    <section class="page-title custom-bnr title-bg2">
        <div class="d-table">
            <div class="d-table-cell">
                <h1 class="banner-title">{{ __('FindAJob.Find A Job') }}</h1>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{ __('FindAJob.Home') }}</a>
                    </li>
                    <li>{{ __('FindAJob.Find A Job') }}</li>
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
    {{-- {{ $cat->CategoryLang->CategoryName }}</option> --}}

    <!-- Find Section Start -->
    <div class="container">

        <div class="row">
            <div class="find-section custom-sections pb-100 py-5 col-md-8">
                <form class="find-form" style="margin: 0; box-shadow:0;-webkit-box-shadow:0 !important;"
                    action="{{ route('FindAJob', app()->getLocale()) }}" method="GET">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label>{{ __('home.Job Title') }}<i class="bx bx-search-alt"></i></label>
                                    <div class="form-group">
                                        <input name="VacancyName"
                                            value="{{ request()->get('VacancyName') ? request()->get('VacancyName') : '' }}"
                                            type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="{{ __('home.Job Title or Keyword') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label>{{ __('home.Categories') }} <svg xmlns="http://www.w3.org/2000/svg"
                                            width="20" height="20" viewBox="0 0 25 25">
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
                                                {{ $cat->CategoryLang->CategoryName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label>{{ __('home.Cities') }} <i class="bx bx-location-plus"></i></label>
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
                                            <span> {{ __('home.Min Salary') }}</span>
                                            <div class="form-group">


                                                <input name="MinSalary" type="number" class="form-control"
                                                    placeholder="{{ __('home.Enter Min Salary') }}"
                                                    id="flefilter_price_min">
                                            </div>
                                        </div>
                                        <div class="from col-md-6">
                                            <span>{{ __('home.Max Salary') }} </span>
                                            <div class="form-group">

                                                <input name="MaxSalary" type="number" class="form-control"
                                                    placeholder="{{ __('home.Enter Max Salary') }}"
                                                    {{-- value="{{ request()->get('MaxSalary') ? request()->get('MaxSalary') : '' }}" --}} id="flefilter_price_max">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label> </label>
                                    <div class="jobs-btn" style="text-align: right; display:grid; width:100%">
                                        <button type="submit" class="find-btn" style="width: auto; padding:16px 100px">
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

            <div class="text-center col-md-4 py-5 pb-90 pr-0 " style="background: white;border-radius:0px">

                @php
                                    
                //use models config
                use App\Models\config;
                // site-ads-static-1
                $site_ads_static_1 = config::where('key', 'site-ads-static-2')->first()->value;
                
            @endphp
                <div class="ads-banner">
                    <img class="img-fluid" src="/AdsImages/{{$site_ads_static_1}}" alt="">
                </div>

            </div>

        </div>
    </div>

    <!-- Job Category Section End -->

    <!-- Jobs Section Start -->
    <section class="job-section pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>{{ __('home.Jobs You May Be Interested In') }}</h2>
            </div>

            <div class="row">
                @foreach ($PremiumVacancies as $vac)
                    <div class="col-sm-4 mb-3">
                        <div class="job-card premium-job-card">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="thumb-img">
                                        <a
                                            href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">
                                            <img class="img-fluid" src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}"
                                                alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="job-info">
                                        <p class="word-break: break-word">
                                            <a class="word-break: normal !important;"
                                                href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">{{ $vac->VacancyName }}
                                            </a>
                                        </p>
                                        <ul>
                                            <li> <a href="#">{{ $vac->Owner->CompanyName }}
                                                </a></li>
                                            {{-- <li>
                                                <i class='bx bx-location-plus'></i>
                                                {{ $vac->City->CityName }}
                                            </li> --}}
                                            <li>
                                                {{-- <i class='bx bx-filter-alt'></i> --}}
                                                  @if ($vac->WithAgreement == 1)
                                                    {{ __('home.With Agreement') }}
                                                @else
                                                    {{ $vac->VacancySalary }}
                                                @endif
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
    <!-- Jobs Section Start -->
    <section class="job-section pb-70">
        <div class="container">
            <div class="section-title text-center">
                <div>
                    <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                    <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                    <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                </div>
                <h2>{{ __('FindAJob.Jobs You May Be Interested In') }}</h2>
            </div>

            <div class="row">

                @foreach ($MyJobs as $vac)
                    <div class="col-sm-4 mb-3">
                        <div class="job-card">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="thumb-img">
                                        <a class="d-block"
                                            href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">
                                            <img class="img-fluid" style="max-height: 75px"
                                                src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}" alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="job-info">
                                        <p>
                                            <a
                                                href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">{{ $vac->VacancyName }}</a>
                                        </p>
                                        <ul>
                                            <li><a href="#">{{ $vac->Owner->CompanyName }}</a></li>
                                            {{-- <li>
                                                <i class='bx bx-location-plus'></i>
                                                {{ $vac->City->CityName }}
                                            </li> --}}
                                            {{-- <li>
                                                <i class='bx bx-filter-alt'></i>
                                                {{ $vac->Category->CategoryName }}
                                            </li> --}}
                                            <li>
                                                <i class='bx bx-briefcase'></i>
                                                @if ($vac->WithAgreement == 1)
                                                    {{ __('home.With Agreement') }}
                                                @else
                                                    {{ $vac->VacancySalary }}
                                                @endif

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
                                                {{ $userApplied ? __('FindAJob.UnApply Now') : __('FindAJob.Apply Now') }}</button>
                                        @endif
                                        <p>
                                            <i class='bx bx-stopwatch'></i>
                                            {{ $vac->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $Jobs->onEachSide(0)->links() }}
            </div>
        </div>
    </section>
    <!-- Jobs Section End -->
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
                        event.innerHTML = "{{ __('FindAJob.UnApply Now') }}";
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
                        event.innerHTML = "{{ __('FindAJob.Apply Now') }}";
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

</html>
