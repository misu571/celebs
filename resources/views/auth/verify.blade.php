@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-lg">
                <div class="card-header oplly-background text-center h2 py-3">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body special-color">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <h5 class="mb-4">
                        Before proceeding, please check your email for a verification link. If you did not receive the email please click the button to request another.
                    </h5>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary rounded-lg m-0 text-capitalize align-baseline">Send new request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
