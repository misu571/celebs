@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5">
        <div class="card text-white special-color-dark rounded-lg texture">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                <h3 class="m-0">Video Archive</h3>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-6">
                    @forelse ($userSocialVid as $item)
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="modal fade" id="introVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content unique-color-dark text-light">
                                            <div class="modal-header d-flex justify-content-end align-items-center py-2">
                                                <a class="btn btn-link p-0 m-0" data-dismiss="modal">
                                                    <i class="fas fa-times fa-2x"></i>
                                                </a>
                                            </div>
                                            <div class="modal-body mb-0 p-0">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <video class="video-fluid z-depth-1" controls>
                                                        <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $item->video)}}">
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a role="button" data-toggle="modal" data-target="#introVideo">
                                    <div class="embed-responsive embed-responsive-16by9 rounded-lg">
                                        <video class="video-fluid z-depth-1">
                                            <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $item->video)}}">
                                        </video>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="px-3 mb-0"><b>No video uploaded.</b></p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection