<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    @include('FrontEnd.Component.Preloader')
    @include('FrontEnd.Component.Navbar')

    <!-- Page Title Start -->
    <section class="page-title title-bg14">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{__("EnterNewPassword.Confirm Password")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("EnterNewPassword.Home")}}</a>
                    </li>
                    <li>{{__("EnterNewPassword.Confirm Password")}}</li>
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
                            <label>{{__("EnterNewPassword.Enter Code")}} </label>
                            <input name="Code" type="number" class="form-control" placeholder="Enter Code" required>
                            <label>{{__("EnterNewPassword.Enter New Password")}}</label>
                            <input name="password" type="password" class="form-control" placeholder="{{__("EnterNewPassword.Enter New Password")}}"
                                required>
                            <label>{{__("EnterNewPassword.Confirm New Password")}}</label>
                            <input name="confirmPassword" type="password" class="form-control"
                                placeholder="{{__("EnterNewPassword.Confirm Password")}}" required>
                            <input type="hidden" name="reqId" value="{{ $id }}">
                        </div>
                        <div class="reset-btn text-center">
                            <button type="submit">{{__("EnterNewPassword.Change Password")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Section Start -->
    @include('FrontEnd.Component.Footer')
