@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card rounded-lg">
                <div class="card-header oplly-background text-center h2 py-3">{{ __('Register') }}</div>

                <div class="card-body special-color p-0">
                    <form class="text-center px-5 py-4" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Social login -->
                        <p class="mb-1">Social Registration</p>
                        {{-- <a href="{{url('login/facebook')}}" class="btn btn-block rounded-lg blue-gradient mb-2" role="button"><p class="h5 text-capitalize text-dark m-0"><i class="fab fa-facebook-f mr-2"></i>Facebook</p></a> --}}
                        <a href="{{url('login/google')}}" class="btn btn-block rounded-lg peach-gradient mb-4" role="button"><p class="h5 text-capitalize text-dark m-0"><i class="fab fa-google mr-2"></i>Google</p></a>
                        
                        <!-- Name -->
                        <p class="mb-1">Or Register manually</p>
                        <div class="form-group mb-4 pb-2">
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full name" required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-4 pb-2">
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-4 pb-2">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm password -->
                        <div class="form-group mb-5">
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                        </div>

                        
                        <button class="btn aqua-gradient btn-block mb-2" type="submit"><p class="h6 text-dark m-0">{{ __('Register') }}</p></button>
                        <p class="mb-3">
                            By signing up, you agree to {{config('app.name')}}'s <span class="font-weight-bold"><a class="text-white" href="{{route('tos')}}">Terms of Service</a></span>, including Additional Terms, and <span class="font-weight-bold"><a class="text-white" href="{{route('ppy')}}">Privacy Policy</a></span>
                        </p>

                        @guest
                            <p class="mb-0">Or <a class="amber-text" href="{{ route('login') }}">{{ __('Login') }}</a> here</p>
                        @endguest

                        <!-- Social login -->
                        {{-- <p class="mb-1">or sign up with:</p>
                        <a href="{{url('login/facebook')}}" class="btn btn-block rounded-lg blue-gradient mb-3" role="button"><p class="h5 text-capitalize text-dark m-0"><i class="fab fa-facebook-f mr-2"></i>Facebook</p></a>
                        <a href="{{url('login/google')}}" class="btn btn-block rounded-lg peach-gradient" role="button"><p class="h5 text-capitalize text-dark m-0"><i class="fab fa-google mr-2"></i>Google</p></a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
