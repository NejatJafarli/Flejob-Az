<!doctype html>
<html lang="zxx">

<head>
    @include('FrontEnd.Component.cdn')
</head>

<body>


    <!-- Navbar Area Start -->
    @include('FrontEnd.Component.Navbar')
    <!-- Navbar Area End -->
    @include('FrontEnd.Component.Preloader')
    <script>
        $(document).ready(function() {
            var Hom = document.getElementById('Contact');
            Hom.classList.add('active');
        });
    </script>
    <!-- Page Title Start -->
    <section class="page-title title-bg23">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>{{__("Contact.Contact Us")}}</h2>
                <ul>
                    <li>
                        <a href="{{ route('Hom', app()->getLocale()) }}">{{__("Contact.Home")}}</a>
                    </li>
                    <li>{{__("Contact.Contact Us")}}</li>
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

    <!-- Contact Section Start -->
    <div class="contact-card-section ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="contact-card">
                                @php
                                    use App\Models\config;
                                    
                                    $config = config::where('key', '=', 'infoPhone')->first();
                                    $phone = $config->value;
                                    $config = config::where('key', '=', 'infoEmail')->first();
                                    $email = $config->value;
                                    $config = config::where('key', '=', 'infoAddress')->first();
                                    $address = $config->value;
                                @endphp
                                <i class='bx bx-phone-call'></i>
                                <ul>
                                    <li>
                                        <a href="tel:{{$phone}}">
                                            {{$phone}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="contact-card">
                                <i class='bx bx-mail-send'></i>
                                <ul>
                                    <li>
                                        <a href="mailto:{{ $email }}">
                                            {{ $email }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 offset-sm-3 offset-md-0">
                            <div class="contact-card">
                                <i class='bx bx-location-plus'></i>
                                <ul>
                                    <li>
                                        {{ $address }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->

    <!-- Contact Form Start -->
    <section class="contact-form-section pb-100">
        <div class="container">
            <div class="contact-area">
                <h3>{{__("Contact.Lets' Talk With Us")}}</h3>
                <form method="POST" action="{{ route('ContactUs', app()->getLocale()) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" required
                                    data-error="Please enter your name" placeholder="{{__("Contact.Your Name")}}">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" required
                                    data-error="Please enter your email" placeholder="{{__("Contact.Your Email")}}">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" id="number" class="form-control" required
                                    data-error="Please enter your phone number" placeholder="{{__("Contact.Phone Number")}}">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="subject" id="subject" class="form-control" required
                                    data-error="Please enter your subject" placeholder="{{__("Contact.Your Subject")}}">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control message-field" id="message" cols="30" rows="7" required
                                    data-error="Please type your message" placeholder="{{__("Contact.Write Message")}}"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 text-center">
                            <button type="submit" class="default-btn contact-btn">
                                {{__("Contact.Send Message")}}
                            </button>
                            <div id="msgSubmit" class="h3 alert-text text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Contact Form End -->

    @include('FrontEnd.Component.Footer')

</html>
