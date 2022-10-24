<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>

    @include('FrontEnd.Component.Navbar')
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('Categories');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>

    <!-- Page Title Start -->
    <section class="page-title title-bg18">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Categories</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Categories</li>
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

    <!-- Category Section Start -->
    <section class="categories-section category-style-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Choose Your Category</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
            </div>

            <div class="row">
                {{-- categories --}}
                @php
                    
                    use App\Models\lang;
                    use App\Models\Vacancy;

					$lang_id = lang::where('LanguageCode',app()->getLocale())->first()->id;

                    
                    //merge categories with category_langs
                    $MyCategories = $Categories->map(function ($Category) use ($lang_id) {
                        $Category->Category_lang = $Category
                            ->category_langs()
                            ->where('lang_id', $lang_id)
                            ->first();
                        return $Category;
                    });
                    
                    //count vacancies in each category
                    $MyCategories = $Categories->map(function ($Category) {
                        $Category->VacanciesCount = Vacancy::where('Category_id', $Category->id)
                            ->where('status', 1)
                            ->count();
                        return $Category;
                    });
                    
                @endphp
                @foreach ($MyCategories as $cat)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{route('FindAJob',app()->getLocale())}}?Category={{$cat->id}}">
                            <div class="category-card">
                                @php
                                    echo $cat->StyleClass;
                                @endphp
                                <h3>{{ $cat->Category_lang->CategoryName }}</h3>
                                <p>{{ $cat->VacanciesCount }} Open position</p>
                            </div>
                        </a>
                    </div>
                @endforeach
                {{ $Categories->links() }}
            </div>
            {{-- <div class="row">
				@foreach ($Categories as $cat)
				
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="#">
                        <div class="category-card">
                            <i class='flaticon-accounting'></i>
                            <h3>{{$cat->CategoryLang->CategoryName}}</h3>
                            <p>301 open position</p>
                        </div>
                    </a>
                </div>

				@endforeach
				
            </div> --}}
        </div>
    </section>
    <!-- Category Section End -->
    @include('FrontEnd.Component.Footer')

</html>
