<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

{{-- <h1>{{dd(session()->get('user'))}}</h1> --}}

<body>
    <!-- Pre-loader End -->

    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')
    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('Account');
            Hom.classList.add('active');
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
                        <a href="{{ route('Hom', app()->getLocale()) }}">Home</a>
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
                            <img class="img-fluid" src="/CandidatesPicture/{{ session()->get('user')->image }}"
                                alt="account holder image"
                                style="max-width: 200px; height:200px;border-radius: 0; width:100%;object-fit:cover">
                            <h3>{{ session()->get('user')->FirstName . ' ' . session()->get('user')->LastName }}</h3>
                            {{-- category List --}}
                            @foreach (session()->get('user')->Categories as $category)
                                <p>{{ $category->Category_lang->CategoryName }}</p>
                            @endforeach
                        </div>
                        @include('FrontEnd.Component.AccountSideBar')
                        <script>
                            $(document).ready(function() {
                                var account = document.getElementById('account');
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
                        <form method="POST" action="{{ route('UpdateUser', app()->getLocale()) }}"
                            enctype="multipart/form-data" class="basic-info" id="EditAccountForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="FirstName" type="text"
                                            value="{{ session()->get('user')->FirstName }}" class="form-control"
                                            placeholder="Enter Your First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="LastName" type="text"
                                            value="{{ session()->get('user')->LastName }}" class="form-control"
                                            placeholder="Enter Your Last Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input name="Username" type="text"
                                            value="{{ session()->get('user')->Username }}" class="form-control"
                                            placeholder="Enter Your Username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input name="FatherName" type="text"
                                            value="{{ session()->get('user')->FatherName }}" class="form-control"
                                            placeholder="Enter Your Father Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email"
                                            value="{{ session()->get('user')->email }}" class="form-control"
                                            placeholder="Enter Your Email">
                                    </div>
                                </div>

                                {{-- add City select --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select name="City" class="form-control">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($city->id == session()->get('user')->City_id) selected @endif>
                                                    {{ $city->CityLang->CityName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- BirthDate --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input name="BirthDate" type="date"
                                            value="{{ session()->get('user')->BirthDate }}" class="form-control"
                                            placeholder="Enter Your Birth Date" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text"
                                            value="{{ session()->get('user')->phone }}" class="form-control"
                                            placeholder="Your Phone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Maried</label>
                                        <select name="Married" class="form-control">
                                            <option value="1">Maried</option>
                                            <option value="0">Not Maried</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- change image --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>if You Want Change Image Upload New Image</label>
                                        <input name="image" type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="Description" style="height: 250px;" cols="30" rows="10" class="form-control"
                                            placeholder="Enter Description">{{ session()->get('user')->Description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Skills</label>
                                        <textarea name="Skills" style="height: 250px;" cols="30" rows="10" class="form-control"
                                            placeholder="Enter Skills">{{ session()->get('user')->Skills }}</textarea>
                                    </div>
                                </div>
                                {{-- add User Know languages and categories --}}
                                <div class="col-md-6">
                                    <label>Categories</label>
                                    <select class="js-example-basic-multiple form-control" name="Categories[]"
                                        multiple="multiple">
                                        @foreach ($categories as $Category)
                                            <option value="{{ $Category->id }}"
                                                {{ $Category->Selected ? 'Selected' : '' }}>
                                                {{ $Category->CategoryLang->CategoryName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Categories</label>
                                    <select class="js-example-basic-multiple form-control" name="Languages[]"
                                        multiple="multiple">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                {{ $language->Selected ? 'Selected' : '' }}>
                                                {{ $language->LanguageName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="tofrom col-md-6 my-5">
                                    <span>Min Salary ₼ {{ session()->get('user')->MaxSalary }}</span>
                                    <div class="form-group">
                                        <label></label>
                                        <input name="MinSalary" value="{{ session()->get('user')->MinSalary }}"
                                            type="number" class="form-control" placeholder="Enter Min Salary"
                                            id="flefilter_price_min">
                                    </div>
                                </div>
                                <div class="from col-md-6 my-5">
                                    <span>Max Salary ₼</span>
                                    <div class="form-group">
                                        <label></label>
                                        <input name="MaxSalary" value="{{ session()->get('user')->MaxSalary }}"
                                            type="number" class="form-control" placeholder="Enter Max Salary"
                                            id="flefilter_price_max">
                                    </div>
                                </div>
                                <div class="price-filter col-md-12">
                                    <input type="text" class="js-range-slider" value="" min-price="1"
                                        current-min-price="{{ session()->get('user')->MinSalary }}"
                                        current-max-price="{{ session()->get('user')->MaxSalary }}"
                                        max-price="29999" />
                                </div>
                            </div>
                            <div class="col-md-12 py-2">
                                <button type="submit" class="account-btn">Save</button>
                            </div>
                        </form>
                        <h3>Educations</h3>
                        <form method="POST" action="{{ route('UpdateUserEducation', app()->getLocale()) }}"
                            class="cadidate-others">
                            @csrf
                            <div class="row" id="EducationRow">
                                @foreach (session()->get('user')->Educations as $Education)
                                    <input type="hidden" name="EducationId[]" value="{{ $Education->id }}">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Education Name</label>
                                            <input name="EducationName[]" type="text"
                                                value="{{ $Education->EducationName }}" class="form-control"
                                                placeholder="Enter Education Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input name="YearStart[]" type="number"
                                                value="{{ $Education->YearStart }}" class="form-control"
                                                placeholder="Enter Education Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input name="YearEnd[]" type="number" value="{{ $Education->YearEnd }}"
                                                class="form-control" placeholder="Enter Education End Date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Education Level</label>
                                            <select name="EducationLevel[]" class="form-control">
                                                @foreach ($education_levels as $Level)
                                                    <option value="{{ $Level->id }}"
                                                        {{ $Level->id == $Education->EducationLevel_Id ? 'Selected' : '' }}>
                                                        {{ $Level->EducationLevelLang->EducationLevelName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Delete </label>
                                        <br />
                                        <button
                                            onclick="EducationDelete('{{ route('DeleteUserEducation', app()->getLocale()) }}','{{ $Education->id }}')"
                                            type="button" class="btn btn-danger btn-sm delete-company">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </div>
                                    <hr class="col-md-12">
                                @endforeach
                                <div class="col-md-12" id="EducationButtons">
                                    {{-- add new education button --}}
                                    @php
                                        $name = [];
                                        $id = [];
                                        foreach ($education_levels as $value) {
                                            $name[] = $value->EducationLevelLang->EducationLevelName;
                                            $id[] = $value->id;
                                        }
                                        
                                        $name = implode(',', $name);
                                        // add start and end "
$name = '"' . str_replace(',', '","', $name) . '"';
$id = implode(',', $id);
                                    @endphp
                                    <button onclick="AddNewEducation([{{ $name }}],[{{ $id }}])"
                                        type="button" class="account-btn" id="add-education">Add New
                                        Education</button>
                                    <button type="submit" class="account-btn">Save</button>
                                </div>
                            </div>
                        </form>
                        <h3>Worked Companies</h3>
                        <form method="POST" action="{{ route('UpdateUserCompany', app()->getLocale()) }}"
                            class="cadidate-others">
                            @csrf
                            <div class="row" id="CompanyRow">
                                @foreach (session()->get('user')->Companies as $Company)
                                    <input type="hidden" name="CompanyId[]" value="{{ $Company->id }}">
                                    <div class="form-group col-md-3">
                                        <label>Company Name</label>
                                        <input name="companyname[]" type="text" class="form-control"
                                            value="{{ $Company->CompanyName }}" placeholder="Enter Company Name"
                                            required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Employer Rank</label>
                                        <input name="companyrank[]" type="text" class="form-control"
                                            value="{{ $Company->Rank }}" placeholder="Enter Employee Rank" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Start Date</label>
                                        <input name="companyStartdate[]" style="padding:10px 10px" type="date"
                                            class="form-control" value="{{ $Company->DateStart }}"
                                            placeholder="Enter Company End Date" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>End Date</label>
                                        <input name="companyEnddate[]" style="padding:10px 10px" type="date"
                                            class="form-control" value="{{ $Company->DateEnd }}"
                                            placeholder="Enter Company End Date" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Delete </label>
                                        <br />
                                        <button
                                            onclick="CompanyDelete('{{ route('DeleteUserCompany', app()->getLocale()) }}','{{ $Company->id }}')"
                                            type="button" class="btn btn-danger btn-sm delete-company">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                                <div class="col-md-12" id="CompanyButtons">
                                    <button onclick="AddNewCompany()" type="button" class="account-btn"
                                        id="add-education">Add New
                                        Company</button>
                                    <button type="submit" class="account-btn">Save</button>
                                </div>
                            </div>
                        </form>

                        <h3>Links</h3>
                        <form method="POST" action="{{ route('UpdateUserCompany', app()->getLocale()) }}"
                            class="candidates-sociak">
                            <div class="row " id="LinksRow">
                                @foreach (session()->get('user')->Links as $Link)
                                    <div class="form-group col-md-5">
                                        <label>Enter Link Name</label>
                                        <input name="linkname[]" type="text" class="form-control"
                                            value="{{ $Link->LinkName }}" placeholder="Enter Your LinkName">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>Enter Link</label>
                                        <input name="link[]" type="text" class="form-control"
                                            value="{{ $Link->Link }}" placeholder="Enter Link">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Delete </label>
                                        <br />
                                        <button
                                            onclick="LinkDelete('{{ route('DeleteUserLink', app()->getLocale()) }}','{{ $Link->id }}')"
                                            type="button" class="btn btn-danger btn-sm delete-Link">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                                <div class="col-md-12" id="LinkButtons">

                                    <button onclick="AddNewLink()" type="button" class="account-btn"
                                        id="add-education">Add New
                                        Link</button>

                                    <button type="submit" class="account-btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Area End -->
    @include('FrontEnd.Component.Footer')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();


            if ($(".js-range-slider").length > 0) {
                let currentMinPrice = $(".js-range-slider").attr("current-min-price");
                let maxPrice = $(".js-range-slider").attr("max-price");
                let minPrice = $(".js-range-slider").attr("min-price");
                let currentMaxPrice = $(".js-range-slider").attr("current-max-price");
                $(".js-range-slider").ionRangeSlider({
                    type: "double",
                    min: minPrice,
                    max: maxPrice,
                    from: currentMinPrice,
                    to: currentMaxPrice,
                    grid: 0,

                    onStart: function(data) {
                        $("#flefilter_price_min").val(data.from);
                        $("#flefilter_price_max").val(data.to);
                    },
                    onChange: function(data) {
                        $("#flefilter_price_min").val(data.from);
                        $("#flefilter_price_max").val(data.to);
                    },
                });
                $("#flefilter_price_min").on("change", function() {
                    let value = $(this).val();
                    let maxPrice = $("#flefilter_price_max").val();
                    value = parseInt(value);
                    minPrice = parseInt(minPrice);
                    if (value > maxPrice) {
                        value = maxPrice;
                        $(this).val(value);
                    }
                    $(".js-range-slider").data("ionRangeSlider").update({
                        from: value,
                    });
                });
                $("#flefilter_price_max").on("change", function() {
                    let value = $(this).val();
                    let minPrice = $("#flefilter_price_min").val();
                    value = parseInt(value);
                    minPrice = parseInt(minPrice);
                    if (value < minPrice) {
                        value = minPrice;
                        $(this).val(value);
                    }
                    $(".js-range-slider").data("ionRangeSlider").update({
                        to: value,
                    });
                });
                $("#module-flefilter input,#module-flefilter select").on(
                    "change",
                    function() {
                        $("#module-flefilter-submit").removeClass("d-none");
                    }
                );
            }
        });


        let LinkCounter = 1;

        function AddNewLink() {
            //create variable
            let element = document.getElementById('LinksRow')
            let elementBtn = document.getElementById('LinkButtons')

            let linkName = document.getElementsByName('linkname[]')
            let linkUrl = document.getElementsByName('link[]')

            let names = []
            let urls = []
            if (linkName.length && linkUrl.length) {
                for (let i = 0; i < linkName.length; i++) {
                    names.push(linkName[i].value)
                    urls.push(linkUrl[i].value)
                }
            }

            // set div all child elements value linkName , linkUrl
            let isTrue = true
            for (let i = 0; i < linkName.length; i++)
                if (linkName[i].value == '' || linkUrl[i].value == '') {
                    isTrue = false
                    break
                }

            if (!isTrue) {
                alert('Please fill all fields')
                return
            }


            //remove elementBtn From element
            element.removeChild(elementBtn)
            let str = `
            <div class="form-group col-md-5 NewLink${LinkCounter}">
                <label>Enter Link Name</label>
                <input name="Newlinkname[]" type="text" class="form-control"
                    placeholder="Enter Your LinkName">
            </div>
            <div class="form-group col-md-5 NewLink${LinkCounter}">
                <label>Enter Link</label>
                <input name="Newlink[]" type="text" class="form-control"
                    placeholder="Enter Link">
            </div>
            <div class="form-group col-md-2 NewLink${LinkCounter}">
                <label>Delete </label>
                <br />
                <button
                    onclick="DeleteElement('NewLink${LinkCounter}')"
                    type="button" class="btn btn-danger btn-sm delete-Link">
                    <i class="fa fa-trash"></i>
                </button>
            </div>`
            //append variable to div
            element.innerHTML += str
            LinkCounter++;
            if (names.length && urls.length) {
                for (let i = 0; i < names.length; i++) {
                    linkName[i].value = names[i]
                    linkUrl[i].value = urls[i]
                }
            }
            //append elementBtn to div
            element.appendChild(elementBtn)

        }


        let CompanyCounter = 1

        function AddNewCompany() {
            let element = document.getElementById('CompanyRow')
            let elementBtn = document.getElementById('CompanyButtons')


            var CompanyName = document.getElementsByName('Newcompanyname[]');
            var CompanyRank = document.getElementsByName('Newcompanyrank[]');
            var CompanyStartdate = document.getElementsByName('NewcompanyStartdate[]');
            var CompanyEnddate = document.getElementsByName('NewcompanyEnddate[]');


            let names = []
            let ranks = []
            let datesStart = []
            let datesEnd = []

            if (
                CompanyName.length &&
                CompanyRank.length &&
                CompanyStartdate.length &&
                CompanyEnddate.length
            ) {
                for (let i = 0; i < CompanyName.length; i++) {
                    names.push(CompanyName[i].value)
                    ranks.push(CompanyRank[i].value)
                    datesStart.push(CompanyStartdate[i].value)
                    datesEnd.push(CompanyEnddate[i].value)
                }
            }

            let isTrue = true
            for (let i = 0; i < CompanyName.length; i++)
                if (
                    CompanyName[i].value == '' ||
                    CompanyRank[i].value == '' ||
                    CompanyStartdate[i].value == '' ||
                    CompanyEnddate[i].value == ''
                ) {
                    isTrue = false
                    break
                }

            if (!isTrue) {
                alert('Please fill all New Company fields')
                return
            }

            element.removeChild(elementBtn)

            let str = `
            <div class="form-group col-md-3 NewCompany${CompanyCounter}">
                <label>Company Name</label>
                <input name="Newcompanyname[]" type="text" class="form-control"
                    placeholder="Enter Company Name"
                    required>
            </div>
            <div class="form-group col-md-3 NewCompany${CompanyCounter}">
                <label>Employer Rank</label>
                <input name="Newcompanyrank[]" type="text" class="form-control"
                    placeholder="Enter Employee Rank" required>
            </div>
            <div class="form-group col-md-2 NewCompany${CompanyCounter}">
                <label>Start Date</label>
                <input name="NewcompanyStartdate[]" style="padding:10px 10px" type="date" class="form-control"
                    placeholder="Enter Company End Date"
                    required>
            </div>
            <div class="form-group col-md-2 NewCompany${CompanyCounter}">
                <label>End Date</label>
                <input name="NewcompanyEnddate[]" style="padding:10px 10px" type="date" class="form-control"
                    placeholder="Enter Company End Date"
                    required>
            </div>
            <div class="form-group col-md-2 NewCompany${CompanyCounter}">
                <label>Delete </label>
                <br />
                <button
                    onclick="DeleteElement('NewCompany${CompanyCounter}')"
                    type="button" class="btn btn-danger btn-sm delete-company">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
            `

            element.innerHTML += str;
            CompanyCounter++;

            element.appendChild(elementBtn)
            if (names.length && ranks.length && datesStart.length && datesEnd.length) {
                for (let i = 0; i < names.length; i++) {
                    CompanyName[i].value = names[i]
                    CompanyRank[i].value = ranks[i]
                    CompanyStartdate[i].value = datesStart[i]
                    CompanyEnddate[i].value = datesEnd[i]
                }
            }

        }

        let EducationCounter = 1

        function AddNewEducation(educationLevelNameArr, educationLevelIdArr) {

            let element = document.getElementById('EducationRow')
            let elementBtn = document.getElementById('EducationButtons')


            let NewEducationName = document.getElementsByName('NewEducationName[]')
            let NewYearStart = document.getElementsByName('NewYearStart[]')
            let NewYearEnd = document.getElementsByName('NewYearEnd[]')
            let NewEducationLevel = document.getElementsByName('NewEducationLevel[]')

            let names = []
            let yearsStart = []
            let yearsEnd = []
            let levels = []

            if (
                NewEducationName.length &&
                NewEducationLevel.length &&
                NewYearStart.length &&
                NewYearEnd.length
            ) {
                for (let i = 0; i < NewEducationName.length; i++) {
                    names.push(NewEducationName[i].value)
                    yearsStart.push(NewYearStart[i].value)
                    yearsEnd.push(NewYearEnd[i].value)
                    levels.push(NewEducationLevel[i].value)
                }
            }

            let isTrue = true
            for (let i = 0; i < NewEducationName.length; i++)
                if (
                    NewEducationName[i].value == '' ||
                    NewYearStart[i].value == '' ||
                    NewYearEnd[i].value == '' ||
                    NewEducationLevel[i].value == ''
                ) {
                    isTrue = false
                    break
                }

            if (!isTrue) {
                alert('Please fill all Education fields')
                return
            }
            //remove ElementBtn From element after add again
            element.removeChild(elementBtn)

            let str = `
            <div class="col-md-3 NewEducation${EducationCounter}" >
                <div class="form-group">
                    <label>Education Name</label>
                    <input name="NewEducationName[]" type="text"
                    class="form-control"
                        placeholder="Enter Education Name">
                </div>
            </div>
            <div class="col-md-2 NewEducation${EducationCounter}">
                <div class="form-group">
                    <label>Start Date</label>
                    <input name="NewYearStart[]" type="number"
                    class="form-control"
                        placeholder="Enter Education Start Date">
                </div>
            </div>
            <div class="col-md-2 NewEducation${EducationCounter}">
                <div class="form-group">
                    <label>End Date</label>
                    <input name="NewYearEnd[]" type="number" 
                        class="form-control" placeholder="Enter Education End Date">
                </div>
            </div>
            <div class="col-md-3 NewEducation${EducationCounter}">
                <div class="form-group">
                    <label>Education Level</label>
                    <select name="NewEducationLevel[]" class="form-control">`
            for (let i = 0; i < educationLevelNameArr.length; i++)
                str += `<option value="${educationLevelIdArr[i]}">${educationLevelNameArr[i]}</option>`
            str += `
                    </select>
                </div>
            </div>
            <div class="form-group col-md-2 NewEducation${EducationCounter}">
                <label>Delete</label>
                <br/>
                    <button onclick="DeleteElement('NewEducation${EducationCounter}')" type="Button" class="btn btn-danger btn-sm delete-company">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </div>
            `

            element.innerHTML += str
            EducationCounter++;

            //add elementBtn to element after add new element
            element.appendChild(elementBtn)

            if (names.length && yearsStart.length && levels.length && yearsEnd.length) {
                for (let i = 0; i < names.length; i++) {
                    NewEducationName[i].value = names[i]
                    NewYearStart[i].value = yearsStart[i]
                    NewYearEnd[i].value = yearsEnd[i]
                    NewEducationLevel[i].value = levels[i]
                }
            }
        }



        function EducationDelete(url, EducationId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    EducationId: EducationId,
                },
                success: function(data) {
                    location.reload()
                },
            })
        }

        function CompanyDelete(url, CompanyId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    CompanyId: CompanyId,
                },
                success: function(data) {
                    location.reload()
                },
            })
        }

        function LinkDelete(url, LinkId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    LinkId: LinkId,
                },
                success: function(data) {
                    location.reload()
                },
            })


        }

        //create function delete element
        function DeleteElement(className) {
            //remove all element with class
            let elements = document.getElementsByClassName(className)
            //remove all element with class
            while (elements.length > 0)
                elements[0].parentNode.removeChild(elements[0]);
        }
    </script>

</html>
