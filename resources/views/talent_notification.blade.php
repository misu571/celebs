@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5">
        <div class="card text-white special-color-dark rounded-lg texture mb-4">
            <div class="card-header border-bottom">
                <h4 class="m-0">Client Request List - <span class="badge badge-light rounded-lg"><i>Pending</i></span></h4>
            </div>
            <div class="card-body px-4 pb-0">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-sm text-white mb-0" id="dtBasicExample-10">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $data)
                                @if ($data->status == 'Pending')
                                <tr>
                                    <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1">
                                        <div class="avatar d-flex justify-content-between align-items-center">
                                            <img src="{{($data->uavatar) ? asset('storage/content/avatar/' . $data->uavatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="45" height="45">
                                            <p class="mb-0 ml-3"><b>By: {{$data->uname}}</b></p>
                                            <p class="mb-0 ml-3"><b><i>Occasion: {{$data->occasion}}</i></b></p>
                                        </div>
                                        <div class="text-right">
                                            <a role="button" class="btn btn-mdb-color rounded-pill text-capitalize px-4" data-toggle="modal" data-target="#seeReq{{$data->id}}"><i class="fas fa-info-circle mr-2"></i>Details</a>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                <!-- Modal -->
                                <div class="modal fade" id="seeReq{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content text-white special-color-dark rounded-lg">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Request Details</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span class="" aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card elegant-color p-1">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <img src="{{($data->uavatar) ? asset('storage/content/avatar/' . $data->uavatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="130" height="130">
                                                                <p class="h5 text-center my-2">{{$data->uname}}</p>
                                                            </div>
                                                            <div class="col-7">
                                                                <h5 class="mb-1">From: {{$data->from}}</h5>
                                                                <i class="fas fa-sort-down fa-2x"></i>
                                                                <h5 class="mb-0 mt-2">Wish to: {{$data->to}}</h5>
                                                                <p class="h5 mt-4 mb-0"><i>Occasion: {{$data->occasion}}</i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body pb-0">
                                                        <div><i class="fas fa-quote-left mr-2"></i>{{$data->instruction}}</div>
                                                        <div class="mt-5">
                                                            <a class="btn btn-light text-dark text-capitalize rounded-pill py-2 px-4 mx-0 mb-3" data-toggle="collapse" href="#collapseExample-12" role="button" aria-expanded="false" aria-controls="collapseExample-12">
                                                                <p class="h6 mb-0"><i class="fas fa-upload mr-2" data-toggle="tooltip" data-placement="top" title="Upload Video"></i>Upload</p>
                                                            </a>
                                                            <div class="collapse pb-2" id="collapseExample-12">
                                                                <div class="card card-body text-white special-color-dark my-0 p-0">
                                                                    <form method="POST" action="{{url('user/request/'. $data->id .'/video-upload')}}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="video" name="video" required>
                                                                                <label class="custom-file-label" for="video">Choose file</label>
                                                                            </div>
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-md btn-dark rounded-right m-0 px-3 py-2 z-depth-0 waves-effect" type="submit">Upload</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <form class="mt-3" action="{{url('user/request/'. $data->id .'/reject')}}" method="post">
                                                                @csrf
                                                                <button class="btn btn-danger text-light text-capitalize rounded-pill py-2 px-4 mx-0 mb-3" type="submit">Reject</button>
                                                            </form>
                                                        </div>
                                                    </div>
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
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col mb-4">
                <div class="card text-white special-color-dark rounded-lg texture mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="m-0">Client Request List - <span class="badge badge-success rounded-lg"><i>Submitted</i></span></h4>
                    </div>
                    <div class="card-body px-4 pb-0">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-sm text-white mb-0" id="dtBasicExample-11">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($requests as $data)
                                    @if ($data->status == 'Submitted')
                                    <tr>
                                        <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1">
                                            <div class="avatar d-flex justify-content-between align-items-center">
                                                <img src="{{($data->uavatar) ? asset('storage/content/avatar/' . $data->uavatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="45" height="45">
                                                <p class="mb-0 ml-3"><b>By: {{$data->uname}}</b></p>
                                                <p class="mb-0 ml-3"><b><i>Occasion: {{$data->occasion}}</i></b></p>
                                            </div>
                                            <div class="text-right">
                                                {{-- <a role="button" class="btn btn-mdb-color rounded-pill text-capitalize px-4" data-toggle="modal" data-target="#seeReq{{$data->id}}"><i class="fas fa-upload mr-2"></i>Upload</a> --}}
                                                <h4 class="m-0"><span class="badge badge-success rounded-pill px-3 py-3"><i>{{$data->status}}</i></span></h4>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card text-white special-color-dark rounded-lg texture mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="m-0">Client Request List - <span class="badge badge-danger rounded-lg"><i>Rejected</i></span></h4>
                    </div>
                    <div class="card-body px-4 pb-0">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-sm text-white mb-0" id="dtBasicExample-12">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($requests as $data)
                                    @if ($data->status == 'Rejected')
                                    <tr>
                                        <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1">
                                            <div class="avatar d-flex justify-content-between align-items-center">
                                                <img src="{{($data->uavatar) ? asset('storage/content/avatar/' . $data->uavatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="45" height="45">
                                                <p class="mb-0 ml-3"><b>By: {{$data->uname}}</b></p>
                                                <p class="mb-0 ml-3"><b><i>Occasion: {{$data->occasion}}</i></b></p>
                                            </div>
                                            <div class="text-right">
                                                <h4 class="m-0"><span class="badge badge-danger rounded-pill px-3 py-3"><i>{{$data->status}}</i></span></h4>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
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