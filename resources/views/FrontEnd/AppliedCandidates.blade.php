<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>
    <!-- Pre-loader End -->
    @php
        use App\Models\lang;
        
        $Langs = lang::all();
        
        $route = Route::current()->getName();
        
        $locale = app()->getLocale();
        
        //UpperCase First Char of LangCode
        $langCode = strtoupper($locale);
        
    @endphp
   
   @include('FrontEnd.Component.Navbar')
    @include('FrontEnd.Component.Preloader')

    <!-- Navbar Area End -->
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('JobDetails');
            Hom.classList.add('active');
        });
    </script>
    <!-- Navbar Area End -->

    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{__("ShowAppliedUsers.Account")}}
                </h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("ShowAppliedUsers.Home")}}</a>
                    </li>
                    <li>{{__("ShowAppliedUsers.Account")}}</li>
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
                            <img class="img-fluid"
                                src="/CompanyLogos/{{ session()->get('CompanyUser')->CompanyLogo }}"
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
                                var account = document.getElementById('Vacancies');
                                account.classList.add('active');
                            });
                        </script>
                    </div>
                </div>

                <div class="col-md-9 account-details row">
                    @foreach ($myCandidates as $can)
                        <div class="col-md-4">
                            <div class="candidate-card " style="height: 380px">
                                <div class="candidate-img">
                                    <img src="/CandidatesPicture/{{ $can->image }}" class="img-fluid"
                                        alt="candidate image ">
                                </div>
                                <div class="candidate-text m-0">
                                    <h3>
                                        <a
                                            href="{{ route('CandidateDetails', ['language' => app()->getLocale(), 'id' => $can->id]) }}">{{ $can->FirstName . ' ' . $can->LastName }}</a>
                                    </h3>
                                    <ul>
                                        <li>
                                            <button onclick="GetUserIdAndSendModalForm('{{ $can->id }}')"
                                                type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                {{__("ShowAppliedUsers.Send Message To Candidate")}}
                                            </button>
                                            {{-- <a href="{{ route('SendMessageCandidate', ['language' => app()->getLocale(), 'id' => $can->id]) }}" --}}
                                            {{-- class="btn btn-primary">Send Message</a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $Candidates->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="MyAlert-box Mysuccess">Successful Alert !!!</div>
                    <div class="MyAlert-box Myfailure">Failure Alert !!!</div>
                    <div class="MyAlert-box Mywarning">Warning Alert !!!</div>
                    <form method="POST" action="{{ route('SendMessagePost', app()->getLocale()) }}"
                        enctype="multipart/form-data" class="basic-info" id="SendMessage">
                        @csrf
                        <input type="hidden" name="UserId" id="UserId" />
                        <input type="hidden" name="VacId" value="{{ $vac->id }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="MessageTitle"> Message Title</label>
                                    <input type="text" class="form-control" id="MessageTitle" name="MessageTitle"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="Message"> Message</label>
                                <textarea style="height: 250px" class="form-control" id="Message" name="Message" rows="10" cols="30"
                                    required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="CloseModal()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="SubmitForm('{{ route('SendMessagePost', app()->getLocale()) }}')"
                        class="btn btn-primary">Send Message To Candidate</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Area End -->
    <script>
        function CloseModal() {
            //set defaults
            // MessageTitle get elementby id
            document.getElementById('MessageTitle').value = '';
            let msg = document.getElementById('Message');
            msg.value = "";
            msg.style['height'] = '250px';


            //close modal
            setTimeout(function() {
                $('div.Myfailure').html("");
                $('div.Mysuccess').html("");
                $('#exampleModal').modal('hide');
            }, 800)

        }

        function GetUserIdAndSendModalForm(id) {
            document.getElementById('UserId').value = id;
        }


        function SubmitForm(url) {

            FData = new FormData(document.getElementById('SendMessage'))

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: url,
                type: 'POST',
                data: FData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data)
                    if (data.hasOwnProperty('errors')) {
                        let errValues = Object.values(data.errors)
                        let errStr = ''

                        for (let i = 0; i < data.errors.length; i++)
                            errStr += errValues[i] + '<br>'

                        $('div.Myfailure').html(errStr)
                        $('div.Myfailure')
                            .fadeIn(300)
                            .delay(5000)
                            .fadeOut(400)


                    } else if (data.hasOwnProperty('success')) {
                        $('div.Mysuccess').html(data.success)
                        $('div.Mysuccess')
                            .fadeIn(300)
                            .delay(5000)
                            .fadeOut(400)

                        CloseModal();
                    }
                },
                error: function(data) {
                    console.log(data)
                    let errKeys = Object.keys(data.responseJSON.errors)
                    let errValues = Object.values(data.responseJSON.errors)
                    let errStr = ''
                    for (let i = 0; i < errKeys.length; i++) {
                        errStr += errKeys[i] + ' : ' + errValues[i][0] + '<br>'
                    }
                    $('div.Myfailure').html(errStr)
                    $('div.Myfailure')
                        .fadeIn(300)
                        .delay(5000)
                        .fadeOut(400)
                }
            })
        }
    </script>
    @include('FrontEnd.Component.Footer')

</html>
