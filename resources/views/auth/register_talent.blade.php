@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card rounded-lg">
                <div class="card-header oplly-background text-center h2 py-3">{{ __('Talent Register') }}</div>

                <div class="card-body special-color p-0">
                    <form class="text-center px-4 px-md-5 py-4" method="POST" action="{{ route('talent.register') }}">
                        @csrf
                        
                        <div class="row mb-4 pb-2">
                            <div class="col">
                                <!-- Name -->
                                <div class="form-group mb-0">
                                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full name" required autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 pb-2">
                            <div class="col">
                                <!-- Email -->
                                <div class="form-group mb-0">
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <!-- Phone -->
                                <div class="form-group mb-0">
                                    <input id="phone" type="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 pb-2">
                            <div class="col">
                                <!-- Password -->
                                <div class="form-group mb-0">
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <!-- Confirm password -->
                                <div class="form-group mb-0">
                                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        
                        <h5 class="text-left">Add a social account</h5>
                        <div class="form-group mb-4 pb-2">
                            <select id="handler_name" name="handler_name" class="form-control form-control-lg @error('handler_name') is-invalid @enderror" required>
                                <option selected disabled>Social account</option>
                                @foreach ($socialPlatforms as $item)
                                    <option class="text-dark" value="{{$item->platform}}">{{$item->platform}}</option>
                                @endforeach
                            </select>
                            @error('handler_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4 pb-2">
                            <input id="handler_id" type="text" class="form-control form-control-lg @error('handler_id') is-invalid @enderror" name="handler_id" value="{{ old('handler_id') }}" placeholder="Your social ID" required>
                            @error('handler_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <input id="followers" type="number" class="form-control form-control-lg @error('followers') is-invalid @enderror" name="followers" value="{{ old('followers') }}" placeholder="Number of follower" required>
                            @error('followers')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <button class="btn aqua-gradient btn-block mb-2" type="submit"><p class="h6 text-dark m-0">{{ __('Register') }}</p></button>
                        <p>
                            By signing up, you agree to {{config('app.name')}}'s <span class="font-weight-bold"><a class="text-white" href="{{route('tos')}}">Terms of Service</a></span>, including Additional Terms, and <span class="font-weight-bold"><a class="text-white" href="{{route('ppy')}}">Privacy Policy</a></span>
                        </p>
                        <p class="text-left mb-0">
                            <i><b>Note: you are not automatically enrolled on {{config('app.name')}}.</b> If you meet the eligibility requirements, a talent representative will contact you within a few days to finish onboarding.</i>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
