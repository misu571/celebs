@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5 px-5">
        <!-- Privacy Policy -->
        <div class="text-center mb-4">
            <h1 class="color_b rounded-lg text-dark py-2 px-3 my-0">About Us</h1>
        </div>

        <div class="text-light">
            {!! ($companyData && $companyData->about != '0') ? $companyData->about : '' !!}
        </div>
    </div>
</section>
@endsection