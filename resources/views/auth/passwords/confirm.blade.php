@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card rounded-lg">
                <div class="card-header oplly-background text-center h2 py-3">{{ __('Confirm Password') }}</div>

                <div class="card-body special-color p-0">
                    {{ __('Please confirm your password before continuing.') }}

                    <form class="text-center px-5 py-4" method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group mb-4 pb-2">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn aqua-gradient btn-block my-3" type="submit"><p class="h6 text-dark m-0">{{ __('Confirm Password') }}</p></button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
