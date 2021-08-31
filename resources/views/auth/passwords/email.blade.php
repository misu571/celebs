@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card rounded-lg">
                <div class="card-header oplly-background text-center h2 py-3">{{ __('Reset Password') }}</div>

                <div class="card-body special-color p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="text-center px-5 py-4" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-4 pb-2">
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{(request()->get('email')) ?? old('email')}}" placeholder="E-mail" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn aqua-gradient btn-block my-3" type="submit"><p class="h6 text-dark m-0">{{ __('Send Password Reset Link') }}</p></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
