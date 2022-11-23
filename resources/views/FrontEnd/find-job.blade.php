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
        if (isset($Category)) {
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
    <section class="page-title title-bg2">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Find a Job</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Find a Job</li>
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

    <!-- Find Section Start -->
    <div class="find-section pb-100 py-5">
        <div class="container">
            <form class="find-form" action="{{ route('FindAJob', app()->getLocale()) }}" method="GET">
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
                        <label>Categories <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 25 25">
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
                                    {{ $cat->CategoryLang->CategoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tofrom col-md-2 my-5">
                        <span>Min Salary ₼</span>
                        <div class="form-group">

                            <label></label>
                            <input name="MinSalary" type="number" class="form-control" placeholder="Enter Min Salary"
                                id="flefilter_price_min">
                        </div>
                    </div>
                    <div class="from col-md-2 my-5">
                        <span>Max Salary ₼</span>
                        <div class="form-group">
                            <label></label>
                            <input name="MaxSalary" type="number" class="form-control" placeholder="Enter Max Salary"
                                {{-- value="{{ request()->get('MaxSalary') ? request()->get('MaxSalary') : '' }}" --}} id="flefilter_price_max">
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
                            <button type="submit" class="find-btn" style="width: auto; padding:16px 100px">
                                Find A Job
                                <i class='bx bx-search'></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Find Section End -->

    <!-- Job Category Section Start -->
    <div class="category-style-two pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Popular Jobs Category</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus</p>
            </div>

            <div class="row">
                @php
                    
                    $MyCategories = Category::orderBy('SortOrder', 'desc')
                        ->take(10)
                        ->get();
                    //merge categories with category_langs
                    $MyCategories = $MyCategories->map(function ($Category) use ($lang_id) {
                        $Category->Category_lang = $Category
                            ->category_langs()
                            ->where('lang_id', $lang_id)
                            ->first();
                        return $Category;
                    });
                    
                    //count vacancies in each category
                    $MyCategories = $MyCategories->map(function ($Category) {
                        $Category->VacanciesCount = Vacancy::where('Category_id', $Category->id)
                            ->where('status', 1)
                            ->count();
                        return $Category;
                    });
                @endphp
                @foreach ($MyCategories as $cat)
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('FindAJob', app()->getLocale()) }}?Category={{ $cat->id }}">
                            <div class="category-item">
                                @php
                                    echo $cat->StyleClass;
                                @endphp
                                <h3>{{ $cat->Category_lang->CategoryName }}</h3>
                                <p>{{ $cat->VacanciesCount }} Active Job</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Job Category Section End -->

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
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus</p>
            </div>

            <div class="row">
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
                @foreach ($MyJobs as $vac)
                    <div class="col-sm-6">
                        <div class="job-card">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="thumb-img">
                                        <a
                                            href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">
                                            <img style="height: 50px; width:50px;"
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
                                            <li>
                                                <i class='bx bx-briefcase'></i>
                                                {{ $vac->VacancySalary }}
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
                {{ $Jobs->links() }}
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
