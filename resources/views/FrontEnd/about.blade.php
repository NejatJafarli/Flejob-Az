<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>


<body>
    @include('FrontEnd.Component.Navbar')
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('About');
            Hom.classList.add('active');
        });
    </script>
    @include('FrontEnd.Component.Preloader')
    <!-- Page Title Start -->
    <section class="page-title title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>About Us</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>About Us</li>
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
                <div class="col-lg-6">
                    <div class="about-text">
                        @php
                            use App\Models\config;
                            $lang = app()->getLocale();
                        @endphp
                        <div class="section-title">
                            @php
                                $title = config::where('key', 'about_title_' . $lang)->first()->value;

                                echo $title;
                            @endphp
                        </div>
                        @php
                            $desc = config::where('key', 'about_description_' . $lang)->first()->value;
                            echo $desc;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->
    @include('FrontEnd.Component.Footer')
