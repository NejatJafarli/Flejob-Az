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
            var Hom = document.getElementsByClassName('Messages');
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
    @php
        use App\Models\lang;
        use App\Models\Vacancy;
        use App\Models\Category;
        use App\Models\CompanyUser;
        use App\Models\City;
        use App\Models\Message;
    @endphp
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
                                var account = document.getElementById('Messages');
                                account.classList.add('active');
                            });
                        </script>
                    </div>
                </div>
                <div class="col-md-9 account-details">
                    @php
                        
                        $Messages = Message::where('UserId', session()->get('user')->id)->paginate(10);
                        $i = 1;
                        
                        $MyMessages = $Messages;
                        foreach ($MyMessages as $key) {
                            $key->Vacancy = Vacancy::where('id', $key->Vacancy_id)->first();
                            $key->Vacancy->Company = CompanyUser::where('id', $key->Vacancy->CompanyUser_id)->first();
                        }
                        
                        $lang_id = lang::where('LanguageCode', app()->getLocale())->first()->id;
                    @endphp
                    <div class="accordion" id="accordionExample">
                        @foreach ($MyMessages as $mes)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $i }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $i }}" aria-expanded="false"
                                        aria-controls="collapse{{ $i }}">
                                        Message From {{ $mes->Vacancy->Company->CompanyName }} Named Company
                                    </button>
                                </h2>
                                <div id="collapse{{ $i }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $i }}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @php
                                            
                                            $vac = $mes->Vacancy;
                                            
                                            $vac->Category = Category::where('id', $vac->Category_id)->first();
                                            $vac->Category->CategoryLang = $vac->Category
                                                ->category_langs()
                                                ->where('lang_id', $lang_id)
                                                ->first();
                                            $vac->City = City::where('id', $vac->City_id)->first();
                                            $vac->City->CityLang = $vac->City
                                                ->cityLang()
                                                ->where('lang_id', $lang_id)
                                                ->first();
                                            $vac->Company = CompanyUser::where('id', $vac->CompanyUser_id)->first();
                                            
                                        @endphp
                                        <div class="col-lg-12 ">
                                            <div class="job-card-two">
                                                <div class="row align-items-center">
                                                    <div class="col-md-1">
                                                        <div class="company-logo">
                                                            <a
                                                                href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"></a>
                                                            <img style="max-width:87px"
                                                                src="CompanyLogos/{{ $vac->Company->CompanyLogo }}"
                                                                alt="logo">
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
                                                    <div class="col-md-3">
                                                        <div class="theme-btn text-end">
                                                            {{-- @php
                                                            
                                                            //get count of notifications
                                                            $count = App\Models\NotificationForCompanyUser::where('Vacancy_id', $vac->id)
                                                                ->where('Status', 0)
                                                                ->count();
                                                            
                                                            if ($count != 0) {
                                                                $msg = "$count";
                                                            } else {
                                                                $msg = '';
                                                            }
                                                        @endphp --}}
                                                            {{-- <a style="width: max-content"
                                                            href="{{ route('AppliedCandidates', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                            class="btn btn-primary">Show Applied Users <span
                                                                class="badge bg-danger"
                                                                style="font-size: 15px;">{{ $msg }}</span></a> --}}
                                                            <a href="{{ route('JobDetails', ['language' => app()->getLocale(), 'id' => $vac->id]) }}"
                                                                class="btn btn-primary mx-5 my-3">View</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="candidate-info-text text-center">
                                            <h3>{{ $mes->Title }}</h3>
                                            <p>{{ $mes->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                    {{ $Messages->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- Account Area End -->

    @include('FrontEnd.Component.Footer')

</html>
