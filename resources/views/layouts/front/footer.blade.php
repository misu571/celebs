<!-- Footer -->
<footer class="page-footer font-small special-color-dark">
    <div class="oplly-background">
        <div class="container-fluid px-md-5">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                    <h4 class="mb-0">Get connected with us on social networks!</h4>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-7 text-center text-md-right">

                    @foreach ($socialinks as $item)
                        @if ($item->link != '0')
                            <a href="{{$item->link}}">
                                @switch($item->type)
                                    @case('Facebook')
                                        <i class="fab fa-facebook-f text-white ml-4"></i>
                                        @break
                                    @case('Twitter')
                                        <i class="fab fa-twitter text-white ml-4"></i>
                                        @break
                                    @case('Instagram')
                                        <i class="fab fa-instagram text-white ml-4"></i>
                                        @break
                                    @default
                                        <i class="fab fa-linkedin-in text-white ml-4"></i>
                                @endswitch
                            </a>
                        @endif
                    @endforeach
                    {{-- <!-- Facebook -->
                    <a href="https://facebook.com/opllyapp">
                        <i class="fab fa-facebook-f white-text ml-4"> </i>
                    </a>
                    <!-- Twitter -->
                    <a href="https://twitter.com/opllyapp">
                        <i class="fab fa-twitter white-text ml-4"> </i>
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/opllyapp">
                        <i class="fab fa-instagram white-text ml-4"> </i>
                    </a>
                    <!-- Linkedin -->
                    <a href="https://www.linkedin.com/opllyapp">
                        <i class="fab fa-linkedin-in white-text ml-4"> </i>
                    </a> --}}

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->

        </div>
    </div>

    <!-- Footer Links -->
    <div class="container-fluid px-md-5 mt-4">

        <!-- Content -->
        <div class="mb-2">
            <img src="{{asset('images/logo.png')}}" height="35" alt="Oplly logo">
            {{-- <p class="mb-0 h3 logo">{{ config('app.name') }}</p> --}}
        </div>
        <hr class="deep-purple accent-2 mb-3 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <!-- Grid row -->
        <div class="row mb-4">

            <!-- Grid column -->
            <div class="col-md-4 mr-auto">

                <p class="h6 mb-2">Subscribe for updates on new talent & features</p>
                <div class="input-group input-group-lg mb-3">
                    <input type="text" class="form-control" placeholder="Your email">
                    <div class="input-group-append">
                        <button class="btn btn-lg btn-elegant rounded-right m-0 px-3 py-2 z-depth-0 waves-effect" type="button" id="button-addon2">
                            <i class="fas fa-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 pl-md-5 my-3">
                <!-- Links -->
                {{-- <div>
                    <h6 class="text-uppercase font-weight-bold m-0">Useful links</h6>
                    <hr class="deep-purple accent-2 mb-1 mt-0 d-inline-block mx-auto" style="width: 60px;">
                </div> --}}
                <div class="mb-2">
                    <a class="btn-link" href="{{route('about')}}"><b>About Us</b></a>
                    <span class="mx-2"><b>|</b></span>
                    <a class="btn-link" href="{{route('tos')}}"><b>Terms</b></a>
                    <span class="mx-2"><b>|</b></span>
                    <a class="btn-link" href="{{route('ppy')}}"><b>Privacy</b></a>
                    <span class="mx-2"><b>|</b></span>
                    <a class="btn-link" href="{{route('faq')}}"><b>FAQ</b></a>
                    <span class="mx-2"><b>|</b></span>
                    <a class="btn-link" href="{{route('career')}}"><b>Career</b></a>
                    <span class="mx-2"><b>|</b></span>
                    <a class="btn-link" role="button" href="#" data-toggle="modal" data-target="#contact_us"><b>Contact Us</b></a>
                    <!-- Modal -->
                    <div class="modal fade" id="contact_us" tabindex="-1" role="dialog" aria-labelledby="contactUsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content unique-color-dark text-light">
                                <div class="modal-header">
                                <h5 class="modal-title" id="contactUsModalLabel">Contact Us</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Default form contact -->
                                    <form class="text-center p-2" action="{{route('inquiry')}}" method="POST">
                                        @csrf

                                        <div class="form-group mb-4">
                                            <input type="text" name="contact_name" id="contact_name" class="form-control @error('contact_name') is-invalid @enderror" placeholder="Name" value="{{ old('contact_name') }}">
                                            @error('contact_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <input type="email" name="contact_email" id="contact_email" class="form-control @error('contact_email') is-invalid @enderror" placeholder="E-mail" value="{{ old('contact_email') }}">
                                            @error('contact_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <input type="text" name="contact_subject" id="contact_subject" class="form-control @error('contact_subject') is-invalid @enderror" placeholder="Subject" value="{{ old('contact_subject') }}">
                                            @error('contact_subject')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control rounded-0 @error('contact_message') is-invalid @enderror" name="contact_message" id="contact_message" rows="3" placeholder="Message">{{ old('contact_message') }}</textarea>
                                            @error('contact_message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <button class="btn btn-info btn-block mt-5" type="submit">Send</button>
                                    </form>
                                    <!-- Default form contact -->
                                </div>
                                {{-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div>
                    <p class="h6 mb-0">
                        <span class="mr-2">Payment Secured by :</span>
                        <img class="w-33" src="{{asset('images/sslcommerz_logo.png')}}" alt="sslcommerz_logo">
                    </p>
                </div> --}}
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 text-md-right ml-auto">
                <p class="h4 mb-3">Want to be a talent on <span class="logo">{{config('app.name')}}</span></p>
                <a href="{{ route('talent.register') }}" role="button" class="join btn btn-lg btn-special gcolor rounded-lg text-capitalize m-0">
                    <i class="fas fa-heart pr-2" aria-hidden="true"></i>Join with us
                </a>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <i class="far fa-copyright"></i> 2020 Copyright: <a class="logo" href="#">{{ config('app.name') }}</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->