<!doctype html>
<html lang="zxx">

<head>
    {{-- include cdn --}}
    @include('FrontEnd.cdn')
</head>

<body>
    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
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
                <h2>Candidates</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Candidates</li>
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
                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/1.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Mibraj Alex</a>
                            </h3>
                            <ul>
                                <li>
                                    Web Developer
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/2.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Felica Kareon</a>
                            </h3>
                            <ul>
                                <li>
                                    PHP Developer
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/3.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Malisa Petel</a>
                            </h3>
                            <ul>
                                <li>
                                    Business Consultant
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/4.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Quence Joes</a>
                            </h3>
                            <ul>
                                <li>
                                    Graphics Designer
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/5.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Mary Mainor</a>
                            </h3>
                            <ul>
                                <li>
                                    Technical Writter
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/6.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Jack Hallock</a>
                            </h3>
                            <ul>
                                <li>
                                    Marketing Expert
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/7.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Lucas Mason</a>
                            </h3>
                            <ul>
                                <li>
                                    UX Designer
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="candidate-card">
                        <div class="candidate-img">
                            <img src="assets/img/candidate/8.jpg" alt="candidate image">
                        </div>
                        <div class="candidate-text">
                            <h3>
                                <a href="candidate-details.html">Jerry Hudson</a>
                            </h3>
                            <ul>
                                <li>
                                    Video Editor
                                </li>
                            </ul>
                        </div>

                        <div class="candidate-social">
                            <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Candidates Section End -->

    <!-- Subscribe Section Start -->
    <section class="subscribe-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Get New Job Notifications</h2>
                        <p>Subscribe & get all related jobs notification</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL"
                            required autocomplete="off">

                        <button class="default-btn sub-btn" type="submit">
                            Subscribe
                        </button>

                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->

    <!-- Footer Section Start -->
    <footer class="footer-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="assets/img/logo.png" alt="logo">
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
                        <h3>For Candidate</h3>
                        <ul>
                            <li>
                                <a href="job-grid.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Browse Jobs
                                </a>
                            </li>
                            <li>
                                <a href="account.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Account
                                </a>
                            </li>
                            <li>
                                <a href="catagories.html">
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
                                <a href="sign-up.html">
                                    <i class='bx bx-chevrons-right bx-tada'></i>
                                    Sign Up
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget pl-60">
                        <h3>Quick Links</h3>
                        <ul>
                            <li>
                                <a href="index.html">
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
                        <h3>Information</h3>
                        <ul>
                            <li>
                                <span>
                                    <i class='bx bxs-phone'></i>
                                    Phone:
                                </span>
                                <a href="tel:882569756">
                                    +101 984 754
                                </a>
                            </li>

                            <li>
                                <span>
                                    <i class='bx bxs-envelope'></i>
                                    Email:
                                </span>
                                <a href="mailto:info@jovie.com">
                                    info@jovie.com
                                </a>
                            </li>

                            <li>
                                <span>
                                    <i class='bx bx-location-plus'></i>
                                    Address:
                                </span>
                                123, Denver, USA
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright-text text-center">
        <p>Copyright @2021 Jovie. All Rights Reserved By <a href="https://hibootstrap.com/"
                target="_blank">HiBootstrp.com</a></p>
    </div>
    <!-- Footer Section End -->

    <!-- Back To Top Start -->
    <div class="top-btn">
        <i class='bx bx-chevrons-up bx-fade-up'></i>
    </div>
    <!-- Back To Top End -->

    <!-- jQuery first, then Bootstrap JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Subscriber Form JS -->
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <!-- Form Velidation JS -->
    <script src="assets/js/form-validator.min.js"></script>
    <!-- Contact Form -->
    <script src="assets/js/contact-form-script.js"></script>
    <!-- Meanmenu JS -->
    <script src="assets/js/meanmenu.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/custom.js"></script>
</body>

</html>
