@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5">
        <div class="card text-white special-color-dark rounded-lg texture">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                <h3 class="m-0">User Requests</h3>
            </div>
            <div class="card-body pb-0">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-sm text-white mb-0" id="dtBasicExample-11">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $data)
                                @if (request()->get('request_id'))
                                    @if ($data->id == request()->get('request_id'))
                                        <tr>
                                            <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1">
                                                <div class="avatar d-flex justify-content-between align-items-center">
                                                    <img src="{{($data->avatar) ? asset('storage/content/avatar/' . $data->avatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="45" height="45">
                                                    <p class="mb-0 ml-3"><b>By: {{$data->name}}</b></p>
                                                </div>
                                                <div>
                                                    @if ($data->status == 'Pending')
                                                        <a role="button" class="btn btn-primary rounded-pill text-capitalize m-0" data-toggle="modal" data-target="#uploadReqVid{{$data->id}}"><i class="fas fa-file-upload mr-2"></i>Submit Video</a>
                                                        <a role="button" class="btn btn-link my-0 mr-0 ml-2 p-0" data-toggle="modal" data-target="#rejectedRequest{{$data->id}}"><i class="far fa-times-circle fa-3x text-danger mr-2" data-toggle="tooltip" data-placement="top" title="Reject"></i></a>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="uploadReqVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content text-white special-color-dark rounded-lg">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-white">Upload video</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span class="text-white" aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{route('user.video_upload', ['reqid' => $data->id])}}" method="post" enctype="multipart/form-data">
                                                                            @csrf

                                                                            <div class="input-group">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" name="video" id="video" aria-describedby="file_upload">
                                                                                    <label class="custom-file-label" for="video">Choose file</label>
                                                                                </div>
                                                                                <div class="input-group-append">
                                                                                    <button class="btn btn-md btn-info m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="file_upload">Upload</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="rejectedRequest{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content text-white special-color-dark rounded-lg">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-white">Rejected request</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span class="text-white" aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{route('user.video_reject', ['reqid' => $data->id])}}" method="post">
                                                                            @csrf

                                                                            <p class="h5 d-flex align-items-center justify-content-between mb-0">
                                                                                Are you sure to reject?
                                                                                <button type="submit" class="btn btn-danger btn-sm float-right m-0">Reject</button>
                                                                            </p>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal -->
                                                    @else
                                                        @if ($data->video != '0' && $data->status == 'Submitted')
                                                            <a role="button" class="btn btn-link m-0 p-0" data-toggle="modal" data-target="#editVid{{$data->id}}"><i class="far fa-edit text-dark fa-2x" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                            <a role="button" class="btn btn-success rounded-pill text-capitalize my-0 mr-0 ml-2" data-toggle="modal" data-target="#watchVid{{$data->id}}"><i class="fas fa-play mr-2"></i>Play</a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="watchVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content unique-color-dark text-light">
                                                                        <div class="modal-header d-flex justify-content-end align-items-center py-2">
                                                                            <a class="btn btn-link p-0 m-0" data-dismiss="modal">
                                                                                <i class="fas fa-times fa-2x"></i>
                                                                            </a>
                                                                        </div>
                                                                        <div class="modal-body mb-0 p-0">
                                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                                <video class="video-fluid z-depth-1" controls>
                                                                                    <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $data->video)}}">
                                                                                </video>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="editVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content text-white special-color-dark rounded-lg">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title text-white">Edit video</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('user.video_edit', ['reqid' => $data->id])}}" method="post" enctype="multipart/form-data">
                                                                                @csrf
            
                                                                                <div class="input-group">
                                                                                    <div class="custom-file">
                                                                                        <input type="file" class="custom-file-input" name="video_edit" id="video_edit" aria-describedby="file_upload">
                                                                                        <label class="custom-file-label" for="video_edit">Choose file</label>
                                                                                    </div>
                                                                                    <div class="input-group-append">
                                                                                        <button class="btn btn-md btn-info m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="file_upload">Upload</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                        @else
                                                            <h4 class="m-0"><span class="badge badge-danger rounded-pill px-3 py-3"><i>Rejected</i></span></h4>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1">
                                            <div class="avatar d-flex justify-content-between align-items-center">
                                                <img src="{{($data->avatar) ? asset('storage/content/avatar/' . $data->avatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="45" height="45">
                                                <p class="mb-0 ml-3"><b>By: {{$data->name}}</b></p>
                                            </div>
                                            <div>
                                                @if ($data->status == 'Pending')
                                                    <a role="button" class="btn btn-primary rounded-pill text-capitalize m-0" data-toggle="modal" data-target="#uploadReqVid{{$data->id}}"><i class="fas fa-file-upload mr-2"></i>Submit Video</a>
                                                    <a role="button" class="btn btn-link my-0 mr-0 ml-2 p-0" data-toggle="modal" data-target="#rejectedRequest{{$data->id}}"><i class="far fa-times-circle fa-3x text-danger mr-2" data-toggle="tooltip" data-placement="top" title="Reject"></i></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="uploadReqVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content text-white special-color-dark rounded-lg">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-white">Upload video</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span class="text-white" aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{route('user.video_upload', ['reqid' => $data->id])}}" method="post" enctype="multipart/form-data">
                                                                        @csrf

                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" name="video" id="video" aria-describedby="file_upload">
                                                                                <label class="custom-file-label" for="video">Choose file</label>
                                                                            </div>
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-md btn-info m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="file_upload">Upload</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="rejectedRequest{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content text-white special-color-dark rounded-lg">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-white">Rejected request</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span class="text-white" aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{route('user.video_reject', ['reqid' => $data->id])}}" method="post">
                                                                        @csrf

                                                                        <p class="h5 d-flex align-items-center justify-content-between mb-0">
                                                                            Are you sure to reject?
                                                                            <button type="submit" class="btn btn-danger btn-sm float-right m-0">Reject</button>
                                                                        </p>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal -->
                                                @else
                                                    @if ($data->video != '0' && $data->status == 'Submitted')
                                                        <a role="button" class="btn btn-link m-0 p-0" data-toggle="modal" data-target="#editVid{{$data->id}}"><i class="far fa-edit text-dark fa-2x" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                        <a role="button" class="btn btn-success rounded-pill text-capitalize my-0 mr-0 ml-2" data-toggle="modal" data-target="#watchVid{{$data->id}}"><i class="fas fa-play mr-2"></i>Play</a>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="watchVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content unique-color-dark text-light">
                                                                    <div class="modal-header d-flex justify-content-end align-items-center py-2">
                                                                        <a class="btn btn-link p-0 m-0" data-dismiss="modal">
                                                                            <i class="fas fa-times fa-2x"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="modal-body mb-0 p-0">
                                                                        <div class="embed-responsive embed-responsive-16by9">
                                                                            <video class="video-fluid z-depth-1" controls>
                                                                                <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $data->video)}}">
                                                                            </video>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="editVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content text-white special-color-dark rounded-lg">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-white">Edit video</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span class="text-white" aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{route('user.video_edit', ['reqid' => $data->id])}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
        
                                                                            <div class="input-group">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" name="video_edit" id="video_edit" aria-describedby="file_upload">
                                                                                    <label class="custom-file-label" for="video_edit">Choose file</label>
                                                                                </div>
                                                                                <div class="input-group-append">
                                                                                    <button class="btn btn-md btn-info m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="file_upload">Upload</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal -->
                                                    @else
                                                        <h4 class="m-0"><span class="badge badge-danger rounded-pill px-3 py-3"><i>Rejected</i></span></h4>
                                                    @endif
                                                @endif
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
</section>
@endsection