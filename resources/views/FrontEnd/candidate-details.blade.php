<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>


    @include('FrontEnd.Component.Preloader')
    @include('FrontEnd.Component.Navbar')
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('CandidateDetails');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>
    <!-- Navbar Area End -->


    <!-- Page Title Start -->
    <section class="page-title title-bg8">
        <div class="d-table">
            <div class="d-table-cell">
                <h2 class="banner-title">{{ __('candidateDetails.Candidates Details') }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{ __('candidateDetails.Home') }}</a>
                    </li>
                    <li>{{ __('candidateDetails.Candidates Details') }}</li>
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

    <!-- Candidate Details Start -->
    <section class="candidate-details pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="candidate-profile">
                        <img style="width: 250px;height:250px;object-fit:cover;border-radius:100%;"
                            src="/CandidatesPicture/{{ $can->image }}" alt="candidate image">
                        <h3> {{ $can->FirstName . ' ' . $can->LastName }}</h3>
                        @foreach ($can->Categories as $Category)
                            <span>{{ $Category->Category_lang->CategoryName }}</span>
                            <br />
                        @endforeach
                        <ul>
                            @if ($can->HideMyDetails == 0)
                                <li class="pt-2">
                                    <a href="tel:{{ $can->phone }}">
                                        <i class='bx bxs-phone'></i>
                                        {{ $can->phone }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="mailto: {{ $can->email }}">
                                    <i class='bx bxs-location-plus'></i>
                                    {{ $can->email }}
                                </a>
                            </li>
                        </ul>
                        {{-- show user linknames and links --}}
                        <ul>
                            @foreach ($can->Links as $link)
                                <li class="pt-2">
                                    <a href="{{ $link->Link }}">
                                        {{ $link->LinkName }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="candidate-info-text">
                        <h3>{{ __('candidateDetails.About Me') }}</h3>
                        <p>{{ $can->Description }}</p>
                    </div>
                    <div class="candidate-info-text candidate-education">
                        <h3>{{ __('candidateDetails.Educations') }}</h3>
                        @foreach ($can->Educations as $Education)
                            <div class="education-info">
                                <h4>{{ $Education->EducationName }}</h4>
                                <p>{{ $Education->EducationLevel->EducationLevelLang->EducationLevelName }}</p>
                                <span>{{ $Education->YearStart . '-' . $Education->YearEnd }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="candidate-info-text candidate-education">
                        <h3>{{ __('candidateDetails.Experiance') }}</h3>
                        @foreach ($can->Companies as $Companies)
                            <div class="education-info">
                                <h4>{{ $Companies->CompanyName }}</h4>
                                @php
                                    $DateStart = date_create($Companies->DateStart);
                                    $DateEnd = date_create($Companies->DateEnd);
                                    
                                    $DateStart = date_format($DateStart, 'Y');
                                    $DateEnd = date_format($DateEnd, 'Y');
                                @endphp
                                <span>{{ $DateStart . '-' . $DateEnd }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="candidate-info-text">
                        <h3>{{ __('candidateDetails.Skills') }}</h3>
                        <p>{{ $can->Skills }}</p>
                    </div>
                    <!--<div class="candidate-info-text text-center">
                        <div class="theme-btn">
                            <a href="#" class="default-btn">{{ __('candidateDetails.Download CV') }}</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Candidate Details End -->
    @include('FrontEnd.Component.Footer')

</html>
