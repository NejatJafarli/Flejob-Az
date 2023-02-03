<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('Company');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>
    <!-- Page Title Start -->
    <section class="page-title title-bg9">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{__("Companies.Company")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("Companies.Home")}}</a>
                    </li>
                    <li>{{__("Companies.Company")}}</li>
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

    <!-- Companies Section Start -->
    <section class="company-section company-style-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>{{__("Companies.Premium Companies")}}</h2>
            </div>
            <div class="row">
                @foreach ($PreComps as $com)
                    <div class="col-lg-3 col-sm-6 mb-3">
                        <div class="company-card @if($com->PremiumEndDate!=null)premium-company-card @endif" style="height: 100%">
                            <div class="company-logo" style="height: 100%">
                                <img style="width: 100px; height:100px" src="/CompanyLogos/{{ $com->CompanyLogo }}"
                                    alt="company logo">
                                <span class="badge-pro">Premium</span>
                            </div>
                            <div class="company-text">
                                <h3 style="word-break: break-word;">{{ $com->CompanyName }}</h3>
                                {{-- <p>
                                    <i class="bx bx-location-plus"></i>
                                    {{ $com->CompanyAddress }}
                                </p> --}}
                                <a href="{{ route('FindAJob', app()->getLocale()) }}?Company={{ $com->id }}"
                                    class="company-btn">
                                    {{ $com->VacanciesCount }}{{__("Companies.Open Position")}}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="section-title text-center">
                <h2>{{__("Companies.Top Companies")}}</h2>
            </div>
            <div class="row">
                @foreach ($CompanyUsers as $com)
                    <div class="col-lg-3 col-sm-6 mb-3">
                        <div class="company-card @if($com->PremiumEndDate!=null)premium-company-card @endif" style="height: 100%">
                            <div class="company-logo" style="height: 100%">
                                    <img style="width: 100px; height:100px" src="/CompanyLogos/{{ $com->CompanyLogo }}"
                                        alt="company logo">
                                        @if($com->PremiumEndDate!=null)
                                        <span class="badge-pro">Premium</span>
                                        @endif
                            </div>
                            <div class="company-text">
                                <h3 style="word-break: break-word;">{{ $com->CompanyName }}</h3>
                                {{-- <p>
                                    <i class="bx bx-location-plus"></i>
                                    {{ $com->CompanyAddress }}
                                </p> --}}
                                <a href="{{ route('FindAJob', app()->getLocale()) }}?Company={{ $com->id }}"
                                    class="company-btn">
                                    {{ $com->VacanciesCount }}{{__("Companies.Open Position")}}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $Companies->onEachSide(1)->links() }}
                </div>
            </div>
    </section>
    <!-- Companies Section End -->

    @include('FrontEnd.Component.Footer')

</html>
