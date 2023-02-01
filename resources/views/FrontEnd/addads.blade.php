<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>


<body>
    @include('FrontEnd.Component.Navbar')
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('ads');
            Hom.classList.add('active');
        });
    </script>
    @include('FrontEnd.Component.Preloader')
    <!-- Page Title Start -->
    <section class="page-title title-bg876">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{__("Ads.Ads")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("About.Home")}}</a>
                    </li>
                    <li>{{__("Ads.Ads")}}</li>
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

    <!-- About Section Start -->
    <section class="about-section ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="about-text">
                        @php
                            use App\Models\config;
                            $lang = app()->getLocale();
                        @endphp
                        <div class="section-title">
                            @php
                                $title = config::where('key', 'ads_title_' . $lang)->first()->value;

                                echo $title;
                            @endphp
                        </div>
                        @php
                            $desc = config::where('key', 'ads_description_' . $lang)->first()->value;
                            echo $desc;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->
    @include('FrontEnd.Component.Footer')
