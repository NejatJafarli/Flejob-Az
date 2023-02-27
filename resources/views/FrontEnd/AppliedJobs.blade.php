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
    @include('FrontEnd.Component.Preloader')
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('AppliedJobs');
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
                <h2>{{__("AppliedJob.Account")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("AppliedJob.Home")}}</a>
                    </li>
                    <li>{{__("AppliedJob.Account")}}</li>
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
                            <img class="img-fluid" src="/CandidatesPicture/{{ session()->get('user')->image }}"
                                alt="account holder image"
                                style="max-width: 200px; height:200px;border-radius: 0; width:100%;object-fit:cover">
                            <h3>{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</h3>
                            {{-- category List --}}
                            @foreach (session()->get('user')->Categories as $category)
                                <p>{{ $category->Category_lang->CategoryName }}</p>
                            @endforeach
                        </div>
                        @include('FrontEnd.Component.AccountSideBar')
                        <script>
                            $(document).ready(function() {
                                var account = document.getElementById('AppliedJobs');
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
                        use App\Models\CompanyUser;
                        use App\Models\City;
                        
                        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;
                        $MyAppliedVacancies = $AppliedVacancies->map(function ($AppliedVacancy) use ($lang_id) {
                            $AppliedVacancy->Vacancy = Vacancy::where('id', $AppliedVacancy->Vacancy_id)->first();
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
                                //get owner
                            $AppliedVacancy->Vacancy->Owner =  CompanyUser::where('id', $AppliedVacancy->Vacancy->CompanyUser_id)->first(); 
                            return $AppliedVacancy;
                        });
                    @endphp
                    @foreach ($MyAppliedVacancies as $temp)
                        @php
                            $vac = $temp->Vacancy;
                        @endphp
                        <div class="col-lg-12">
                            <div class="job-card-two">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <div class="company-logo">
                                           
                                            <a href="{{ route('vacancyDetails', ['language' => app()->getLocale(),"categorySlug"=>$vac->Category->slug,'slug' => $vac->slug]) }}">
                                            <img style="max-width:87px" src="/CompanyLogos/{{ $vac->Owner->CompanyLogo }}" alt="logo">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="job-info">
                                            <h3>
                                                <a
                                                    href="{{ route('vacancyDetails', ['language' => app()->getLocale(),"categorySlug"=>$vac->Category->slug,'slug' => $vac->slug]) }}">{{ $vac->VacancyName }}</a>
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
                                        @php
                                            $userApplied = false;
                                            foreach ($AppliedVacancies as $temp2) {
                                                if ($temp2->User_id == session()->get('user')->id) {
                                                    $userApplied = true;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <div class="theme-btn text-end">
                                            <button
                                                onclick="ApplyVac(this,'{{ route('ApplyVacancy', ['language' => app()->getLocale(), 'id' => $vac->id]) }}')"
                                                type="button" class="btn btn-primary" data-toggle="modal">
                                                {{ $userApplied ? __('AppliedJob.UnApply Now') : __('AppliedJob.Apply Now') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $AppliedVacancies->links() }}
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
                        event.innerHTML = "{{ __('AppliedJob.UnApply Now') }}";

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
                        event.innerHTML = "{{ __('AppliedJob.Apply Now') }}";
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
