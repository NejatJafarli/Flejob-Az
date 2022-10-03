<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Panel Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body class="account-body accountbg"
    style="background-image:url('/assets/images/bg-1.jpg');background-size: cover;
background-position: center center;">

    <!-- Log In page -->
    <div class="row">
        <div class="col-lg-4">
            @if (isset($fail))
                {
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                    </button>
                    <strong>{{ $fail }}</strong>
                </div>
                }
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                        </button>
                        <strong>{{ $error }}</strong>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row vh-100 align-content-center justify-content-center">
        <div class="col-lg-3  pr-0">
            <div class="card mb-0 shadow-none">
                <div class="card-body">
                    <div class="px-3">
                        <div class="media">
                            {{-- get error and list --}}
                            {{-- <a href="index.html" class="logo logo-admin"><img src="/assets/images/logo-sm.png" --}}
                            {{-- height="55" alt="logo" class="my-3"></a> --}}
                            <div class="media-body ml-3 align-self-center">
                                <h4 class="mt-0 mb-1">Login on Admin</h4>
                            </div>
                        </div>
                        <form action="{{ route('LoginAdmin', app()->getLocale()) }}" class="form-horizontal my-4"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="mdi mdi-account-outline font-16"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Enter username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="mdi mdi-key font-16"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" id="userpassword"
                                        placeholder="Enter password">
                                </div>
                            </div>
                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary btn-block waves-effect waves-light"
                                        type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Log In page -->


    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metisMenu.min.js"></script>
    <script src="/assets/js/waves.min.js"></script>
    <script src="/assets/js/jquery.slimscroll.min.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.js"></script>

</body>

</html>
