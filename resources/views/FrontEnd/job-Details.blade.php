<!doctype html>
<html>

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    {{-- nav bar start --}}
    @include('FrontEnd.Component.Navbar')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('JobDetails');
            Hom.classList.add('active');
        });
    </script>
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg6">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Job Details</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Job Details</li>
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

    <!-- Job Details Section Start -->
    <section class="job-details ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job-details-text">
                                <div class="job-card">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <div class="company-logo">
                                                <img src="/VacanciesPicture/{{ $vac->Photo }}" alt="logo">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="job-info">
                                                <h3>{{ $vac->VacancyName }}</h3>
                                                <ul>
                                                    <li>
                                                        <i class='bx bx-location-plus'></i>
                                                        {{ $vac->City->CityLang->CityName }}
                                                    </li>
                                                    <li>
                                                        <i class='bx bx-filter-alt'></i>
                                                        {{ $vac->Category->Category_lang->CategoryName }}
                                                    </li>
                                                    @php
                                                        
                                                        $expired = false;
                                                        if ($vac->EndDate < date('Y-m-d')) {
                                                            $expired = true;
                                                        }
                                                        
                                                    @endphp
                                                    <span>
                                                        <i class='bx bx-paper-plane'></i>
                                                        Apply Before: {{ $vac->EndDate }}

                                                        {{-- write this vacancy has been expired --}}
                                                        @if ($expired)
                                                            <span class="badge badge-danger">Expired</span>
                                                        @endif
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="details-text">
                                    <h3>Description</h3>
                                    @php
                                        $desc = nl2br($vac->VacancyDescription);
                                        echo $desc;
                                    @endphp
                                </div>

                                <div class="details-text">
                                    <h3>Requirements</h3>
                                    @php
                                        $req = nl2br($vac->VacancyRequirements);
                                        echo $req;
                                    @endphp
                                </div>

                                <div class="details-text">
                                    <h3>Job Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>Company :</span></td>
                                                        <td>{{ $vac->CompanyUser->CompanyName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Email :</span></td>
                                                        <td><a href="mailto:{{ $vac->Email }}">{{ $vac->Email }}</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><span>Location :</span></td>
                                                        <td>{{ $vac->City->CityLang->CityName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Salary :</span></td>
                                                        <td>{{ $vac->VacancySalary }}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $userApplied = false;
                                    
                                    $userApplied = session()
                                        ->get('user')
                                        ->AppliedVacancies->contains($vac->id);
                                    
                                @endphp

                                <div class="theme-btn">
                                    <button
                                        onclick="ApplyVac(this,'{{ route('ApplyVacancy', ['language' => app()->getLocale(), 'id' => $vac->id]) }}')"
                                        type="button" class="default-btn" data-toggle="modal">
                                        {{ $userApplied ? 'UnApply Now' : 'Apply Now' }}</button>
                                </div>
                                <div class="my-5">
                                    <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                                    <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                                    <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="job-sidebar">
                        <h3>Posted By</h3>
                        <div class="posted-by">
                            <img src="/CompanyLogos/{{ $vac->CompanyUser->CompanyLogo }}" alt="client image">
                            <h4>{{ $vac->CompanyUser->CompanyName }}</h4>
                        </div>
                    </div>
                    {{-- <div class="job-sidebar">
                        <h3>Keywords</h3>
                        <ul>
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                        </ul>
                    </div> --}}
                    {{-- 
                        <div class="job-sidebar social-share">
                            <h3>Share In</h3>
                            <ul>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-pinterest"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
    </section>
    <!-- Job Details Section End -->

    <!-- Job Section End -->
    <section class="job-style-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Jobs You May Be Interested In</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>
            </div>

            <div class="row">
                {{-- Same categoried Vacancies --}}

                {{-- <div class="col-lg-12">
                    <div class="job-card-two">
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <div class="company-logo">
                                    <a href="job-details.html">
                                        <img src="assets/img/company-logo/1.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="job-info">
                                    <h3>
                                        <a href="#">Web Designer, Graphic Designer, UI/UX Designer </a>
                                    </h3>
                                    <ul>
                                        <li>
                                            <i class='bx bx-briefcase'></i>
                                            Graphics Designer
                                        </li>
                                        <li>
                                            <i class='bx bx-briefcase'></i>
                                            $35000-$38000
                                        </li>
                                        <li>
                                            <i class='bx bx-location-plus'></i>
                                            Wellesley Rd, London
                                        </li>
                                        <li>
                                            <i class='bx bx-stopwatch'></i>
                                            9 days ago
                                        </li>
                                    </ul>

                                    <span>Full Time</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="theme-btn text-end">
                                    <a href="#" class="default-btn">
                                        Browse Job
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Job Section End -->
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
