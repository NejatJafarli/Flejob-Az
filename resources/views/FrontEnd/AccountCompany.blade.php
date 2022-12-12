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
            var Hom = document.getElementsByClassName('account');
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
                <h2>Account</h2>
                <ul>
                    <li>
                        <a href="{{ route('Account', app()->getLocale()) }}">Home</a>
                    </li>
                    <li>Account</li>
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
                            <h3>{{ session()->get('CompanyUser')->CompanyName }}</h3>
                            {{-- category List --}}
                            @foreach (session()->get('CompanyUser')->Categories as $category)
                                <p>{{ $category->Category_lang->CategoryName }}</p>
                            @endforeach
                        </div>
                        @include('FrontEnd.Component.AccountSideBarCompany')
                        <script>
                            $(document).ready(function() {
                                var account = document.getElementById('Profile');
                                account.classList.add('active');
                            });
                        </script>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="account-details">
                        <h3>Information</h3>
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
                        <form method="POST" action="{{ route('UpdateCompanyUser', app()->getLocale()) }}"
                            enctype="multipart/form-data" class="basic-info" id="EditAccountForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- CompanyName --}}
                                    <div class="form-group">
                                        <label for="CompanyName">
                                            Company Name</label>
                                        <input type="text" class="form-control" id="CompanyName" name="CompanyName"
                                            value="{{ session()->get('CompanyUser')->CompanyName }}">
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="CompanyName">
                                            Company Username</label>
                                        <input type="text" class="form-control" id="CompanyUsername"
                                            name="CompanyUsername"
                                            value="{{ session()->get('CompanyUser')->CompanyUsername }}">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="CompanyEmail">
                                            Company Email</label>
                                        <input type="text" class="form-control" id="CompanyEmail" name="CompanyEmail"
                                            value="{{ session()->get('CompanyUser')->CompanyEmail }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="CompanyWebSiteLink">
                                            Company Web Site Link</label>
                                        <input type="text" class="form-control" id="CompanyWebSiteLink"
                                            name="CompanyWebSiteLink"
                                            value="{{ session()->get('CompanyUser')->CompanyWebSiteLink }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="CompanyAddress">
                                            Company Address</label>
                                        <input type="text" class="form-control" id="CompanyAddress"
                                            name="CompanyAddress"
                                            value="{{ session()->get('CompanyUser')->CompanyAddress }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="CompanyLogo">
                                            Company Logo  </label>
                                        <input type="file" class="form-control"name="CompanyLogo">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Company Categories</label>
                                        <br />
                                        <select style="width:100%" class="js-example-basic-multiple form-control"
                                            name="CompanyCategories[]" multiple="multiple">
                                            @foreach ($categories as $Category)
                                                <option value="{{ $Category->id }}"
                                                    {{ $Category->Selected ? 'Selected' : '' }}>
                                                    {{ $Category->CategoryLang->CategoryName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="CompanyDescription">
                                            Company Description</label>
                                        <textarea style="height: 250px" class="form-control" id="CompanyDescription" name="CompanyDescription" rows="10"
                                            cols="30">{{ session()->get('CompanyUser')->CompanyDescription }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        <h3>Company Phones</h3>
                        <form method="POST" action="{{ route('UpdateCompanyUserPhones', app()->getLocale()) }}"
                            enctype="multipart/form-data" class="basic-info
                            "
                            id="EditAccountForm">
                            @csrf
                            <div class="row">
                                <div class="row align-items-center  " id="Phones">
                                    @foreach (session()->get('CompanyUser')->CompanyPhones as $phone)
                                        <input type="hidden" name="PhoneId" value="{{ $phone->id }}">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" id="Phone"
                                                    name="CompanyPhone[]" value="{{ $phone->CompanyPhone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Delete </label>
                                            <br />
                                            <button
                                                onclick="DeletePhoneNumber('{{ route('DeletePhoneNumber', ['language' => app()->getLocale(), 'id' => $phone->id]) }}')"
                                                type="button" class="btn btn-danger btn-sm delete-company">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-12" id="EducationButtons">
                                    <button onclick="AddNewNumber()" type="button" class="account-btn"
                                        id="add-education">Add New
                                        Phone Number</button>
                                    <button type="submit" class="account-btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var NumberCounter = 1;

        function AddNewNumber() {

            let div = document.getElementById('Phones')
            let CompanyPhone = document.getElementsByName('NewCompanyPhone[]')
            let ComPhone = document.getElementsByName('CompanyPhone[]')

            let Phones = []
            if (CompanyPhone.length) {
                for (let i = 0; i < CompanyPhone.length; i++) {
                    Phones.push(CompanyPhone[i].value)
                }
            }

            // set div all child elements value linkName , linkUrl
            let isTrue = true
            for (let i = 0; i < CompanyPhone.length; i++) {
                if (CompanyPhone[i].length != 13) {
                    isTrue = false
                    break
                }
            }

            if (!isTrue) {
                alert('Please fill all fields')
                return
            }
            for (let i = 0; i < ComPhone.length; i++) {
                if (ComPhone[i].length != 13) {
                    isTrue = false
                    break
                }
            }
            if (!isTrue) {
                alert('Please fill all fields')
                return
            }
            let str = `<div class="col-md-10 NewNumber${NumberCounter}">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" id="Phone"
                                name="NewCompanyPhone[]" value="+994" >
                        </div>
                    </div>
                    <div class="form-group col-md-2 NewNumber${NumberCounter}">
                        <label>Delete </label>
                        <br />
                        <button
                            onclick="DeleteElement('NewNumber${NumberCounter}')"
                            type="button" class="btn btn-danger btn-sm delete-company">
                            <i class="fa fa-trash"></i>
                        </button>

                    </div>
                    <hr class="col-md-12 NewNumber${NumberCounter}">`
            //append variable to div
            div.innerHTML += str
            if (Phones.length) {
                for (let i = 0; i < Phones.length; i++) {
                    CompanyPhone[i].value = Phones[i]
                }
            }
            NumberCounter++;
        }

        function DeleteElement(className) {
            //remove all element with class
            let elements = document.getElementsByClassName(className)
            //remove all element with class
            while (elements.length > 0)
                elements[0].parentNode.removeChild(elements[0]);
        }

        function DeletePhoneNumber(url) {
            console.log(url);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    location.reload()
                },
            })
        }
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <!-- Account Area End -->
    @include('FrontEnd.Component.Footer')

</html>
