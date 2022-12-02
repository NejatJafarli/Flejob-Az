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
            var Hom = document.getElementsByClassName('term');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>
    <!-- Page Title Start -->
    <section class="page-title title-bg19">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Terms and Conditions</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Terms and Conditions</li>
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

    <!-- Terms Section Start -->
    <div class="terms-section pt-100 pb-100">
        <div class="container">
            <div class="terms-text">
                @php
                    use App\Models\config;
                    $lang = app()->getLocale();
                @endphp
                <div class="section-title">
                    @php
                        $title = config::where('key', 'terms_title_' . $lang)->first()->value;
                        
                        echo $title;
                    @endphp
                </div>
                @php
                    $desc = config::where('key', 'terms_description_' . $lang)->first()->value;
                    echo $desc;
                @endphp

            </div>
        </div>
    </div>
    <!-- Terms Section End -->

    @include('FrontEnd.Component.Footer')

</html>
