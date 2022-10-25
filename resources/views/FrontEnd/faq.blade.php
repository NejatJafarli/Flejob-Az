<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('faq');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>

    <!-- Page Title Start -->
    <section class="page-title title-bg17">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>FAQ</h2>
                <ul>
                    <li>
                        <a href="{{route("Hom",app()->getLocale())}}">Home</a>
                    </li>
                    <li>FAQ</li>
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

    <!-- Faq Section Start -->
    <section class="faq-section pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="accordions">
                        <div class="accordion-item">
                            <div class="accordion-title" data-tab="item1">
                                <h2>How To Find A Job?<i class='bx bx-chevrons-right down-arrow'></i></h2>
                            </div>
                            <div class="accordion-content" id="item1">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-title" data-tab="item2">
                                <h2>How Many Companies Can I Applied?<i class='bx bx-chevrons-right down-arrow'></i>
                                </h2>
                            </div>
                            <div class="accordion-content" id="item2">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-title" data-tab="item3">
                                <h2>How Can I Applied for Job?<i class='bx bx-chevrons-right down-arrow'></i></h2>
                            </div>
                            <div class="accordion-content" id="item3">
                                <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-title" data-tab="item4">
                                <h2>How can I Pay?<i class='bx bx-chevrons-right down-arrow'></i></h2>
                            </div>
                            <div class="accordion-content" id="item4">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-title" data-tab="item5">
                                <h2>How Can I Connect with a Company?<i class='bx bx-chevrons-right down-arrow'></i>
                                </h2>
                            </div>
                            <div class="accordion-content" id="item5">
                                <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo.
                                </p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-title" data-tab="item6">
                                <h2>How Can I Create an Account?<i class='bx bx-chevrons-right down-arrow'></i></h2>
                            </div>
                            <div class="accordion-content" id="item6">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Faq Section End -->

    <!-- Footer Section Start -->
    @include('Frontend.Component.Footer')
</html>
