<!doctype html>
<html lang="zxx">

<head>
    {{-- include cdn --}}
    @include('FrontEnd.Component.cdn')
</head>

@php
    use App\Models\Category;
    use App\Models\lang;
@endphp

<body>
    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('Candidate');
            Hom.classList.add('active');
        });
    </script>
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg7">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{ __('candidate.Candidates') }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{ __('candidate.Home') }}</a>
                    </li>
                    <li>{{ __('candidate.Candidates') }}</li>
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

    <!-- Candidates Section Start -->
    <section class="candidate-style-two pt-100 pb-70">
        <div class="container">
            <div class="row">
                @php
                    
                    $candidates = [];
                    foreach ($users as $candidate) {
                        $candidate = App\Http\Controllers\HomeController::MergeUsersTable($candidate);
                        //push candidate to array
                        array_push($candidates, $candidate);
                    }
                @endphp
                @foreach ($candidates as $user)
                    <div class="col-lg-3 col-sm-6 mb-3">
                        <div class="candidate-card premium-cv-card">
                            <div class="candidate-img">
                                <a
                                    href="{{ route('CandidateDetails', ['language' => app()->getLocale(), 'id' => $user->id]) }}">
                                    <img style="padding: 20px" src="/CandidatesPicture/{{ $user->image }}"
                                        alt="candidate image">
                                </a>

                            </div>
                            <div class="candidate-text">
                                <h3>
                                    <a
                                        href="{{ route('CandidateDetails', ['language' => app()->getLocale(), 'id' => $user->id]) }}">{{ $user->FirstName . ' ' . $user->LastName }}</a>
                                </h3>
                                @php
                                    $cat = $user->Categories;
                                    
                                    $first = $cat->first()->category_langs();
                                    
                                    $lang = lang::where('LanguageCode', app()->getLocale())->first();
                                    $cat = $first->where('lang_id', $lang->id)->first();
                                @endphp
                                <p>{{ $cat->CategoryName }}</p>
                            </div>
                            {{-- <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-3">
                        <div class="candidate-card">
                            <div class="candidate-img">
                                <a
                                    href="{{ route('CandidateDetails', ['language' => app()->getLocale(), 'id' => $user->id]) }}">
                                    <img style="padding: 20px" src="/CandidatesPicture/{{ $user->image }}"
                                        alt="candidate image">
                                </a>

                            </div>
                            <div class="candidate-text">
                                <h3>
                                    <a
                                        href="{{ route('CandidateDetails', ['language' => app()->getLocale(), 'id' => $user->id]) }}">{{ $user->FirstName . ' ' . $user->LastName }}</a>
                                </h3>
                                @php
                                    $cat = $user->Categories;
                                    
                                    $first = $cat->first()->category_langs();
                                    
                                    $lang = lang::where('LanguageCode', app()->getLocale())->first();
                                    $cat = $first->where('lang_id', $lang->id)->first();
                                @endphp
                                <p>{{ $cat->CategoryName }}</p>
                            </div>
                            {{-- <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div> --}}
                        </div>
                    </div>
                @endforeach
                {{ $users->links() }}
            </div>
        </div>
    </section>
    <!-- Candidates Section End -->
    @include('FrontEnd.Component.Footer')

</html>
