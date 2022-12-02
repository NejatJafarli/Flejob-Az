<!doctype html>
<html lang="zxx">

<head>
    @include('Frontend.Component.cdn')
</head>

<body>
    @include('Frontend.Component.Preloader')
    @include('Frontend.Component.Navbar')

    <!-- Page Title Start -->
    <section class="page-title title-bg14">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Confirm Password</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Confirm Password</li>
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
                    {{-- //show errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('EnterNewPasswordPost', app()->getLocale()) }}" method="POST"
                        class="reset-form">
                        @csrf
                        <div class="form-group">
                            <label>Enter Code </label>
                            <input name="Code" type="number" class="form-control" placeholder="Enter Code" required>
                            <label>Enter New Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Enter New Password"
                                required>
                            <label>Confirm New Password</label>
                            <input name="confirmPassword" type="password" class="form-control"
                                placeholder="Confirm Password" required>
                            <input type="hidden" name="reqId" value="{{ $id }}">
                        </div>
                        <div class="reset-btn text-center">
                            <button type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Section Start -->
    @include('FrontEnd.Component.Footer')
