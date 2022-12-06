<!doctype html>
<html lang="zxx">

<head>
    @include('Frontend.Component.cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"
        integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    @include('Frontend.Component.Preloader')
    @include('Frontend.Component.Navbar')

    <!-- Page Title Start -->
    <section class="page-title title-bg14">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Reset
                    @if ($Choice == 'Company')
                        Company
                    @else
                        User
                    @endif
                    Password
                </h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Reset Password</li>
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

    <!-- Reset Password Section Start -->
    <div class="reset-password ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 offset-md-2 offset-lg-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($Choice == 'User')
                        <form action="{{ route('ResetPasswordPostUser', app()->getLocale()) }}" method="POST"
                            class="reset-form">
                            @csrf
                            <div class="form-group">
                                <label>Enter Phone</label>
                                <input name="phone" type="tel" class="form-control"
                                    placeholder="Enter Your phone Number" required>
                            </div>
                            <div class="reset-btn text-center">
                                <button type="submit">Reset Password</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('ResetPasswordPostCompany', app()->getLocale()) }}" method="POST"
                            class="reset-form">
                            @csrf
                            <div class="form-group">
                                <label>Enter Company Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter Your Company Email" required>
                            </div>
                            <div class="reset-btn text-center">
                                <button type="submit">Reset Password</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('input[type="tel"]').inputmask("+\\9\\94999999999");
        });
    </script>
    <!-- Footer Section Start -->
    @include('FrontEnd.Component.Footer')