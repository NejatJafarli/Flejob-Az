<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    <!-- Pre-loader End -->

    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('Vacancies');
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
                <h2>{{__("Vacancies.Account")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("Vacancies.Home")}}</a>
                    </li>
                    <li>{{__("Vacancies.Account")}}</li>
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
                        use App\Models\CompanyUser;
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
                        
                            $AppliedVacancy->Vacancy->Company = CompanyUser::where('id', $AppliedVacancy->Vacancy->CompanyUser_id)->first();

                            return $AppliedVacancy;
                        });
                        
                    @endphp
                    @foreach ($MyAppliedVacancies as $temp)
                        @php
                            $vac = $temp->Vacancy;
                        @endphp

                        <div class="col-lg-12 ">
                            <div class="job-card-two">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="company-logo">
                                            <a
                                                href="{{ route('vacancyDetails', ['language' => app()->getLocale(),"categorySlug"=>$vac->Category->slug,'slug' => $vac->slug]) }}"></a>
                                            <img style="border-radius:50%;"
                                                src="/CompanyLogos/{{ $vac->Company->CompanyLogo }}" alt="logo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="job-info">
                                            <h3>
                                                <a
                                                    href="{{ route('vacancyDetails', ['language' => app()->getLocale(),"categorySlug"=>$vac->Category->slug,'slug' => $vac->slug]) }}">{{ $vac->VacancyName }}</a>
                                            </h3>
                                            <ul>
                                                <li>
                                                    <i class='bx bx-filter-alt'></i>
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
                                    <div class="col-md-4">
                                        <div class="theme-btn text-end">
                                            @php
                                                
                                                //get count of notifications
                                                $count = App\Models\NotificationForCompanyUser::where('Vacancy_id', $vac->id)
                                                    ->where('Status', 0)
                                                    ->count();
                                                
                                                if ($count != 0) {
                                                    $msg = "$count";
                                                } else {
                                                    $msg = '';
                                                }
                                            @endphp
                                            <a 
                                                href="{{ route('AppliedCandidates', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                class="btn btn-danger mb-3">{{__("Vacancies.Show Applied Users")}} <span class="badge bg-danger"
                                                    style="font-size: 15px; ">{{ $msg }}</span></a>
                                            <a href="{{ route('EditAJob', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                class="btn btn-danger mb-3">{{__("Vacancies.View")}}</a>
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
    @include('FrontEnd.Component.Footer')

</html>
