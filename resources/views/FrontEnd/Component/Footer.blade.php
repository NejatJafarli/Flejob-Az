<!-- Footer Section Start -->
<footer class="footer-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <div class="footer-logo">
                        <a href="{{ route('Hom', app()->getLocale()) }}">
                            <img src="/assets2/img/logo.png" alt="logo">
                        </a>
                    </div>

                    <p>{{ __('Footer.content') }}</p>
                    @php
                        use App\Models\config;
                        
                        $config = config::where('key', '=', 'infoPhone')->first();
                        $phone = $config->value;
                        $config = config::where('key', '=', 'infoEmail')->first();
                        $email = $config->value;
                        $config = config::where('key', '=', 'infoAddress')->first();
                        $address = $config->value;
                        $instagram = config::where('key', '=', 'instagram')->first()->value;
                        $facebook = config::where('key', '=', 'facebook')->first()->value;
                        $linkedin = config::where('key', '=', 'linkedin')->first()->value;
                        $telegram = config::where('key', '=', 'telegram')->first()->value;
                    @endphp
                    <div class="footer-social">
                         <a href="{{$telegram}}" target="_blank"><i class='bx bxl-telegram'></i></a>
                        <a href="{{$instagram}}" target="_blank"><i class='bx bxl-instagram'></i></a>
                        <a href="{{$facebook}}" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="{{$linkedin}}" target="_blank"><i class='bx bxl-linkedin'></i></a>
                
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget pl-60">
                    <h3 class="for-candidate-text-mobil">{{ __('Footer.ForCandidate') }}</h3>
                    <ul class="footer-ul-centre-mobile">
                        <li>
                            <a href="{{ route('FindAJob', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                {{ __('Footer.BrowseJobs') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Categories', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                {{ __('Footer.BrowseCategories') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Companies', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                {{ __('Footer.BrowseCompany') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget pl-60">
                    <h3 class="quick-links-text-mobile">{{__("Footer.QuickLinks")}}</h3>
                    <ul class="footer-ul-centre-mobile">
                        <li>
                            <a href="{{ route('About', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                {{__("Footer.About")}}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                {{__("Footer.terms")}}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Contact', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                {{__("Footer.ContactUs")}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget footer-info">
                    <h3 class="information-text-mobil">{{__("Footer.Information")}}</h3>
                   
                    <ul class="footer-ul-centre-mobile">
                        <li>
                            <span>
                                <i class='bx bxs-phone'></i>
                                {{__("Footer.Phone")}}
                                :
                            </span>
                            <a href="tel:{{ $phone }}">
                                {{ $phone }}
                            </a>
                        </li>
                        <li>
                            <span>
                                <i class='bx bxs-envelope'></i>
                                {{__("Footer.Email")}}
                                :
                            </span>
                            <a href="mailto:{{ $email }}">
                                {{ $email }}
                            </a>
                        </li>
                        <li>
                            <span>
                                <i class='bx bx-location-plus'></i>
                                {{__("Footer.Address")}}
                                :
                            </span>
                            {{ $address }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
{{-- Hacizade Farid --}}
</footer>
<div class="copyright-text text-center">
    <!-- Front end By Sahib Akbarov-->
    <p>Developed @2022 <a class="devText" href="https://flegri.com/">Flegri</a></p>
    <!-- Developed By Hacizade Farid-->
</div>
<!-- Footer Section End -->

<!-- Back To Top Start -->
<div class="top-btn">
    <i class='bx bx-chevrons-up bx-fade-up'></i>
</div>
<!-- Back To Top End -->

<!-- jQuery first, then Bootstrap JS -->
<script src="/assets2/js/bootstrap.bundle.min.js"></script>

<!-- Owl Carousel JS -->
<script src="/assets2/js/owl.carousel.min.js"></script>
<script src="/assets2/js/vendor/ion.rangeSlider.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!-- Nice Select JS -->
{{-- <script src="/assets2/js/jquery.nice-select.min.js"></script> --}}
<!-- Magnific Popup JS -->
<script src="/assets2/js/jquery.magnific-popup.min.js"></script>
<!-- Subscriber Form JS -->
<script src="/assets2/js/jquery.ajaxchimp.min.js"></script>
<!-- Form Velidation JS -->
<script src="/assets2/js/form-validator.min.js"></script>
<!-- Contact Form -->
<script src="/assets2/js/contact-form-script.js"></script>
<!-- Meanmenu JS -->
<script src="/assets2/js/meanmenu.js"></script>
<!-- Custom JS -->
<script src="/assets2/js/custom.js"></script>

</body>

</html>
