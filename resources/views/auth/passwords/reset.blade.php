@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card rounded-lg">
                <div class="card-header oplly-background text-center h2 py-3">{{ __('Reset Password') }}</div>

                <div class="card-body special-color p-0">
                    <form class="text-center px-5 py-4" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-4 pb-2">
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4 pb-2">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4 pb-2">
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                        </div>

                        <button class="btn aqua-gradient btn-block my-3" type="submit"><p class="h6 text-dark m-0">{{ __('Reset Password') }}</p></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
