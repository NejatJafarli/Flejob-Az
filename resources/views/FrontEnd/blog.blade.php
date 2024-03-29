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
            var Hom = document.getElementsByClassName('Blog');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>

    <!-- Page Title Start -->
    <section class="page-title title-bg21">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{ __('Blog.Blog') }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{ __('Blog.Home') }}</a>
                    </li>
                    <li>{{ __('Blog.Blog') }}</li>
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

    <!-- Blog Section Start -->
    <section class="blog-section blog-style-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>{{ __('Blog.News, Tips & Articles') }}</h2>
            </div>

            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-card">
                            <div class="blog-img">
                                <a href="{{ route('BlogDetail', ['language' => app()->getLocale(), 'id' => $blog->id]) }}">
                                    <img style="width: 510px; height:410px; object-fit:cover;"
                                        src="/BlogsPicture/{{ $blog->Image }}" alt="blog image">
                                </a>
                            </div>
                            <div class="blog-text">
                                <ul>
                                    <li>
                                        <i class='bx bxs-user'></i>
                                        Admin
                                    </li>
                                    <li>
                                        <i class='bx bx-calendar'></i>
                                        {{ $blog->created_at->DiffForHumans() }}
                                    </li>
                                </ul>
                                <h3>
                                    <a
                                        href="{{ route('BlogDetail', ['language' => app()->getLocale(), 'id' => $blog->id]) }}">
                                        {{ $blog->Title }}
                                    </a>
                                </h3>
                                <a href="{{ route('BlogDetail', ['language' => app()->getLocale(), 'id' => $blog->id]) }}"
                                    class="blog-btn">
                                    Read More
                                    <i class='bx bx-plus bx-spin'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $blogs->links() }}
            </div>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class='bx bx-chevrons-left bx-fade-left'></i>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link active" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class='bx bx-chevrons-right bx-fade-right'></i>
                        </a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Subscribe Section Start -->
    <!-- <section class="subscribe-section">
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
                            <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required autocomplete="off">
    
                            <button class="default-btn sub-btn" type="submit">
                                Subscribe
                            </button>
    
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section> -->
    <!-- Subscribe Section End -->

    <!-- Footer Section Start -->
    @include('FrontEnd.Component.Footer')
