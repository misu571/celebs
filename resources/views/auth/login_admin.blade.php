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
                <div class="card-header oplly-background text-center h2 py-3">Admin Login</div>

                <div class="card-body special-color p-0">
                    <div class="text-center px-4 px-md-5 py-4">
                        <!-- Default form login -->
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf

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
                            <div class="form-group mb-3">
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <div class="custom-control custom-checkbox">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Remember me</label>
                                    </div>
                                </div>
                                {{-- <div class="col-md">
                                    @if (Route::has('password.request'))
                                        <a class="text-white" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div> --}}
                            </div>
                            {{-- <div class="d-flex justify-content-around">
                                <div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Remember me</label>
                                    </div>
                                </div>
                                <div>
                                    @if (Route::has('password.request'))
                                        <a class="text-white" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div> --}}

                            <!-- Sign in button -->
                            <button class="btn aqua-gradient btn-block my-4" type="submit"><p class="h6 text-dark m-0">Sign in</p></button>
                        </form>
                        <!-- Default form login -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
