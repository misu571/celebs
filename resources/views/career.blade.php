@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5 px-md-5">
        <!-- FAQ -->
        <div class="card">
            <div class="card-header text-dark text-center text-white color_b h4">Join With Us</div>
            <div class="card-body px-md-5 py-4">
                <h4 class="text-dark">Job List :</h4>
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="careerAccordion" role="tablist" aria-multiselectable="true">
                    @forelse ($vacancies as $key => $vacancy)
                        <!-- Accordion card -->
                        <div class="card border border-left border-right border-light rounded-lg @if($key != 0) mt-3 @endif">
                            <!-- Card header -->
                            <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingOne{{ $key }}">
                                <a data-toggle="collapse" data-parent="#careerAccordion" href="#collapseOne{{ $key }}" aria-expanded="true" aria-controls="collapseOne{{ $key }}">
                                    <h5 class="text-white font-weight-normal mb-0">
                                        {{ $vacancy->position }}
                                        <i class="fas fa-angle-down rotate-icon float-right"></i>
                                    </h5>
                                </a>
                            </div>

                            <!-- Card body -->
                            <div id="collapseOne{{ $key }}" class="collapse blue-grey lighten-4" role="tabpanel" aria-labelledby="headingOne{{ $key }}" data-parent="#careerAccordion">
                                <div class="card-body px-md-4 text-dark">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="d-flex align-items-center"><p class="mb-0 h5">{{ $vacancy->position }}</p></div>
                                            <div>
                                                <button type="button" class="btn btn-sm purple-gradient m-0">Apply</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {!! $vacancy->details !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion card -->
                    @empty
                        <p class="h6 text-dark mb-0"><i>No available vacancy.</i></p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection