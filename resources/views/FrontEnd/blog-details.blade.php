<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    {{-- //meta MetaTitle --}}
    <meta name="Title" content="{{ $blog->MetaTitle }}">
    {{-- //meta MetaKeywords --}}
    <meta name="keywords" content="{{ $blog->MetaKeywords }}">
    {{-- //meta MetaDescription --}}
    <meta name="description" content="{{ $blog->MetaDescription }}">

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
    <section class="page-title title-bg22">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{__("BlogDetail.Blog Details")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("BlogDetail.Home")}}</a>
                    </li>
                    <li>{{__("BlogDetail.Blog Details")}}</li>
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

    <!-- Blog Details Section Start -->
    <section class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-widget">
                        <h3>{{__("BlogDetail.Popular Post")}}</h3>
                        @foreach ($lastBlogs as $item)
                            <article class="popular-post">
                                <a href="{{ route('BlogDetail', ['language' => app()->getLocale(), 'id' => $item->id]) }}"
                                    class="blog-thumb">
                                    <img src="/BlogsPicture/{{ $item->Image }}" alt="blog image">
                                </a>
                                <div class="info">
                                    <time datetime="2021-04-08">{{ $item->created_at->format('d M Y') }}</time>
                                    <h4>
                                        <a
                                            href="{{ route('BlogDetail', ['language' => app()->getLocale(), 'id' => $item->id]) }}">{{ $item->Title }}</a>
                                    </h4>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    @if ($blog->MetaKeywords != null)
                        <div class="blog-widget blog-tags">
                            @php
                                $tags = explode(' ', $blog->MetaKeywords);
                            @endphp
                            <h3>{{__("BlogDetail.Tags")}}</h3>
                            <ul>
                                @foreach ($tags as $tag)
                                    <li>
                                        <a href="#">{{ $tag }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="col-lg-8">
                    <div class="blog-dedails-text">
                        <div class="blog-details-img">
                            <img style="width: 765px;height:500px;" src="/BlogsPicture/{{ $blog->Image }}"
                                alt="blog details image">
                        </div>

                        <div class="blog-meta">
                            <ul>
                                <li>
                                    <i class='bx bxs-user'></i>
                                    Admin
                                </li>
                                <li>
                                    <i class='bx bx-calendar'></i>
                                    {{ $blog->created_at->format('d M Y') }}
                                </li>
                            </ul>
                        </div>

                        <h3 class="post-title">{{ $blog->Title }}</h3>

                        <p style="word-break: break-word;">{{ $blog->Description }}</p>
                        @if ($blog->MetaKeywords != null)
                            <div class="details-tag">
                                <ul>
                                    <li>Tags:</li>
                                    @foreach ($tags as $tag)
                                        <li>
                                            <a href="#">{{ $tag }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- 
                        <form class="comment-form">
                            <h3>Leave a Reply</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Your Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Your Name">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea class="form-control comment-box" cols="30" rows="6" placeholder="Your Comment"></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="comment-btn">
                                Post a Comment
                            </button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Subscribe Section Start -->
    {{-- <section class="subscribe-section">
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
        </section> --}}

    <!-- Subscribe Section End -->
    @include('FrontEnd.Component.Footer')
