@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5">
        <div class="row row-cols-1 row-cols-md-2 mb-4">
            <div class="col mb-4">
                <div class="card text-white special-color-dark rounded-lg texture">
                    <div class="card-header border-bottom">
                        <h3 class="m-0">Requested Videos</h3>
                    </div>
                    <div class="card-body pb-0">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-sm text-white mb-0" id="dtBasicExample-11">
                                <thead><tr><th></th></tr></thead>
                                <tbody>
                                    @foreach ($response as $data)
                                    <tr id="response{{$data->id}}">
                                        <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1" data-toggle="modal" data-target="#seeResponse{{$data->id}}">
                                            <div class="avatar d-flex justify-content-between align-items-center">
                                                <img src="{{($data->tavatar) ? asset('storage/content/avatar/' . $data->tavatar) : asset('images/avatar.png')}}"
                                                    class="rounded-circle z-depth-1 img-fluid" width="40" height="40">
                                                <p class="mb-0 ml-3"><b>{{$data->tname}}</b></p>
                                            </div>
                                            <div class="text-right mr-2">
                                                <p class="h6 mb-0"><i><span class="badge badge-dark rounded-pill px-3 py-2"><i class="fas fa-play mr-2"></i>Play Video</span></i></p>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="seeResponse{{$data->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="talentSigninLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content text-white special-color-dark rounded-lg">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{$data->occasion}}</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span class="" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <video class="video-fluid z-depth-1" controls>
                                                            <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $data->reqvideo)}}">
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection