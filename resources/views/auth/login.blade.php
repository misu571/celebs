@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if (session('loginError'))
    <div aria-live="polite" aria-atomic="true" style="position: relative;">
        <div class="toast rounded-lg bg-danger" style="position: absolute; top: 0; right: 0;" data-animation="true"
            data-delay="10000" data-autohide="true">
            <div class="toast-body text-white d-flex align-items-center">
                <span><b>{{session('loginError')}}</b></span>
                <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card rounded-lg">
                <div class="card-header oplly-background text-center h2 py-3">{{ __('Login') }}</div>

                <div class="card-body special-color p-0">
                    <!-- Default form login -->
                    <form class="text-center px-4 px-md-5 py-4" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Social login -->
                        <p class="mb-1">Social Login/Signup</p>
                        {{-- <a href="{{url('login/facebook')}}" class="btn btn-block rounded-lg blue-gradient mb-2" role="button"><p class="h5 text-capitalize text-dark m-0"><i class="fab fa-facebook-f mr-2"></i>Facebook</p></a> --}}
                        <a href="{{url('login/google')}}" class="btn btn-block rounded-lg peach-gradient mb-4" role="button"><p class="h5 text-capitalize text-dark m-0"><i class="fab fa-google mr-2"></i>Google</p></a>
                        
                        <!-- Email -->
                        <p class="mb-1">Or Login manually</p>
                        <div class="form-group mb-4 pb-2">
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-around mb-5">
                            <div>
                                <!-- Remember me -->
                                <div class="custom-control custom-checkbox">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Remember me</label>
                                </div>
                            </div>
                            <div>
                                <!-- Forgot password -->
                                @if (Route::has('password.request'))
                                    <a class="text-white" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Sign in button -->
                        <button class="btn aqua-gradient btn-block mt-3 mb-2" type="submit"><p class="h6 text-dark m-0">Sign in</p></button>
                        <p class="mb-3">
                            By signing up, you agree to {{config('app.name')}}'s <span class="font-weight-bold"><a class="text-white" href="{{route('tos')}}">Terms of Service</a></span>, including Additional Terms, and <span class="font-weight-bold"><a class="text-white" href="{{route('ppy')}}">Privacy Policy</a></span>
                        </p>

                        <!-- Register -->
                        @if (Route::has('register'))
                        <p>Not a member?
                            <a class="amber-text" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </p>
                        @endif

                        <!-- Talent login -->
                        {{-- <p class="h4 mt-4 mb-0">Or go to Talent <a class="text-dark" href="{{route('talent.login')}}">Login</a></p> --}}
                    </form>
                    <!-- Default form login -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
