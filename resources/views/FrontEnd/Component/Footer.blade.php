<!-- Footer Section Start -->
<footer class="footer-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <div class="footer-logo">
                        <a href="index.html">
                            <img src="/assets2/img/logo.png" alt="logo">
                        </a>
                    </div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut
                        labore et dolore magna. Sed eiusmod tempor incididunt ut.</p>

                    <div class="footer-social">
                        <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                        <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                        <a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget pl-60">
                    <h3 class="for-candidate-text-mobil">For Candidate</h3>
                    <ul class="footer-ul-centre-mobile">
                        <li>
                            <a href="job-grid.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Browse Jobs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Account', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Account
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Categories', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Browse Categories
                            </a>
                        </li>
                        <li>
                            <a href="resume.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Resume
                            </a>
                        </li>
                        <li>
                            <a href="job-list.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Job List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Signup', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Sign Up
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget pl-60">
                    <h3 class="quick-links-text-mobile">Quick Links</h3>
                    <ul class="footer-ul-centre-mobile">
                        <li>
                            <a href="{{ route('Hom', app()->getLocale()) }}">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="about.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                About
                            </a>
                        </li>
                        <li>
                            <a href="faq.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a href="pricing.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Pricing
                            </a>
                        </li>
                        <li>
                            <a href="privacy.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Privacy
                            </a>
                        </li>
                        <li>
                            <a href="contact.html">
                                <i class='bx bx-chevrons-right bx-tada'></i>
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget footer-info">
                    <h3 class="information-text-mobil">Information</h3>
                    @php
                        use App\Models\Config;
                        
                        $config = Config::where('key', '=', 'infoPhone')->first();
                        $phone = $config->value;
                        $config = Config::where('key', '=', 'infoEmail')->first();
                        $email = $config->value;
                        $config = Config::where('key', '=', 'infoAddress')->first();
                        $address = $config->value;
                    @endphp
                    <ul class="footer-ul-centre-mobile">
                        <li>
                            <span>
                                <i class='bx bxs-phone'></i>
                                Phone:
                            </span>
                            <a href="tel:{{ $phone }}">
                                {{ $phone }}
                            </a>
                        </li>

                        <li>
                            <span>
                                <i class='bx bxs-envelope'></i>
                                Email:
                            </span>
                            <a href="mailto:{{ $email }}">
                                {{ $email }}
                            </a>
                        </li>

                        <li>
                            <span>
                                <i class='bx bx-location-plus'></i>
                                Address:
                            </span>
                            {{ $address }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright-text text-center">
    <p>Copyright @2022 Flegri</p>
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
