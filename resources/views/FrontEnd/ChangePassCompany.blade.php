<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <!-- Pre-loader End -->

    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementsByClassName('ChangePass');
            for (let index = 0; index < Hom.length; index++) {
                Hom[index].classList.add('active');
            }
        });
    </script>
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{__("ChangePassword.Account")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("ChangePassword.Home")}}</a>
                    </li>
                    <li>{{__("ChangePassword.Account")}}</li>
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

    <!-- Account Area Start -->
    <section class="account-section ptb-100">
        <div class="container" style="">
            <div class="row">
                <div class="col-md-3">
                    <div class="account-information">
                        <div class="profile-thumb">
                            <img class="img-fluid" src="/CompanyLogos/{{ session()->get('CompanyUser')->CompanyLogo }}"
                                alt="account holder image"
                                style="max-width: 200px; height:200px;border-radius: 0; width:100%;object-fit:cover">
                            <h3>{{ session()->get('CompanyUser')->CompnayName }}</h3>
                            {{-- category List --}}
                            @foreach (session()->get('CompanyUser')->Categories as $category)
                                <p>{{ $category->Category_lang->CategoryName }}</p>
                            @endforeach
                        </div>
                        @include('FrontEnd.Component.AccountSideBarCompany')
                        <script>
                            $(document).ready(function() {
                                var account = document.getElementById('ChangePass');
                                account.classList.add('active');
                            });
                        </script>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="account-details">
                        <h3>{{__("ChangePassword.Change Password")}}</h3>
                        {{-- show errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('UpdateCompanyUserPassword', app()->getLocale()) }}"
                            enctype="multipart/form-data" class="basic-info" id="EditAccountForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>{{__("ChangePassword.Enter Your Current Password")}}</label>
                                        <input name="password" type="password" class="form-control"
                                            placeholder="{{__("ChangePassword.Current Password")}}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>{{__("ChangePassword.Enter Your New Password")}}</label>
                                        <input name="newpassword" type="password" class="form-control"
                                            placeholder="{{__("ChangePassword.New Password")}}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>{{__("ChangePassword.Enter Your New Password Again")}}</label>
                                        <input name="confirmpassword" type="password" class="form-control"
                                            placeholder="{{__("ChangePassword.New Password Again")}}">
                                    </div>
                                </div>
                                <div class="col-md-12 py-2">
                                    <button type="submit" class="account-btn">{{__("ChangePassword.Save")}}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Area End -->
    @include('FrontEnd.Component.Footer')

</html>
