<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    <!-- Pre-loader End -->

    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('account');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
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
                            <img class="img-fluid" src="/CompanyLogos/{{ session()->get('CompanyUser')->CompanyLogo }}"
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

                <div class="col-md-9 account-details">
                    <div>
                        <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                        <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                        <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                    </div>
                    @php
                        
                        use App\Models\lang;
                        use App\Models\Vacancy;
                        use App\Models\Category;
                        use App\Models\City;
                        
                        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;
                        $MyAppliedVacancies = $Vacancies->map(function ($AppliedVacancy) use ($lang_id) {
                            $AppliedVacancy->Vacancy = Vacancy::where('id', $AppliedVacancy->id)->first();
                            $AppliedVacancy->Vacancy->Category = Category::where('id', $AppliedVacancy->Vacancy->Category_id)->first();
                            $AppliedVacancy->Vacancy->Category->CategoryLang = $AppliedVacancy->Vacancy->Category
                                ->category_langs()
                                ->where('lang_id', $lang_id)
                                ->first();
                            $AppliedVacancy->Vacancy->City = City::where('id', $AppliedVacancy->Vacancy->City_id)->first();
                            $AppliedVacancy->Vacancy->City->CityLang = $AppliedVacancy->Vacancy->City
                                ->cityLang()
                                ->where('lang_id', $lang_id)
                                ->first();
                            return $AppliedVacancy;
                        });
                        
                    @endphp
                    @foreach ($MyAppliedVacancies as $temp)
                        @php
                            $vac = $temp->Vacancy;
                        @endphp

                        <div class="col-lg-12 " style="border: 1px solid black">
                            <div class="job-card-two">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <div class="company-logo">
                                            <a href="job-details.html"></a>
                                            <img style="max-width:87px" src="VacanciesPicture/" alt="logo">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="job-info">
                                            <h3>
                                                <a
                                                    href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}">{{ $vac->VacancyName }}</a>
                                            </h3>
                                            <ul>
                                                <li>
                                                    <i class='bx bx-briefcase'></i>
                                                    {{ $vac->Category->CategoryLang->CategoryName }}
                                                </li>
                                                <li>
                                                    <i class='bx bx-briefcase'></i>
                                                    {{ $vac->VacancySalary . ' AZN' }}
                                                </li>
                                                <li>
                                                    <i class='bx bx-location-plus'></i>
                                                    {{ $vac->City->CityLang->CityName }}
                                                </li>
                                                <li>
                                                    <i class='bx bx-stopwatch'></i>
                                                    {{ $vac->created_at->diffForHumans() }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="theme-btn text-end">
                                            <a href="{{ route('AppliedCandidates', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                class="btn btn-primary">Show Applied Users</a>
                                            <a href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                class="btn btn-primary mx-5 my-3">View</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $Vacancies->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- Account Area End -->
    <script>
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
