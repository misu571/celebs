@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5">
        <div class="card text-white special-color-dark rounded-lg texture">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                <h3 class="m-0">My Videos</h3>
            </div>
            <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-sm text-white mb-0" id="dtBasicExample-11">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $data)
                                @if (request()->get('booking_id'))
                                    @if ($data->id == request()->get('booking_id'))
                                        <tr>
                                            <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1">
                                                <div class="avatar d-flex justify-content-between align-items-center">
                                                    <img src="{{($data->avatar) ? asset('storage/content/avatar/' . $data->avatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="45" height="45">
                                                    <p class="mb-0 ml-3"><b>To: {{$data->to}}</b></p>
                                                    <p class="mb-0 ml-3"><b>From: {{($data->from == '0') ? 'Myself' : $data->from}}</b></p>
                                                    <p class="mb-0 ml-3"><b><i>Occasion: {{$data->occasion}}</i></b></p>
                                                </div>
                                                <div class="text-right">
                                                    @if ($data->status == 'Submitted')
                                                        <a role="button" class="btn btn-primary rounded text-capitalize mr-5" data-toggle="modal" data-target="#rateThis{{$data->id}}"><i>Rate this</i></a>
                                                        <a role="button" class="btn btn-dark rounded-pill text-capitalize px-4" data-toggle="modal" data-target="#watchVid{{$data->id}}"><i class="fas fa-play mr-2"></i><i>Play</i></a>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="watchVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                                <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $data->video)}}">
                                                                            </video>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal -->
                                                    @else
                                                        @if ($data->status == 'Pending')
                                                            <p class="h4 m-0"><span class="badge badge-warning rounded-pill px-3 py-3"><i><span class="text-dark">Pending</span></i></span></p>
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
                                                <p class="mb-0 ml-3"><b>To: {{$data->to}}</b></p>
                                                <p class="mb-0 ml-3"><b>From: {{($data->from == '0') ? 'Myself' : $data->from}}</b></p>
                                                <p class="mb-0 ml-3"><b><i>Occasion: {{$data->occasion}}</i></b></p>
                                            </div>
                                            <div class="text-right">
                                                @if ($data->status == 'Submitted')
                                                    <a role="button" class="mr-4" data-toggle="modal" data-target="#rateThis{{$data->id}}"><span class="text-capitalize badge badge-secondary rounded-lg p-2"><i>Rate this</i></span></a>
                                                    <a role="button" class="btn btn-dark rounded-pill text-capitalize px-4" data-toggle="modal" data-target="#watchVid{{$data->id}}"><i class="fas fa-play mr-2"></i><i>Play</i></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="rateThis{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content unique-color-dark text-light rounded-lg">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Give Rating</h5>
                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-left">
                                                                    <form action="{{route('rate.service', ['id' => $data->id])}}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" id="rateTalentValue" name="rateTalent" value="">
                                                                        {{-- @for ($i = 0; $i < 5; $i++)
                                                                            @if ($data->rate > $i)
                                                                                <i class="fas fa-star"></i>
                                                                            @else
                                                                                @if ($data->rate > ($i - 1) && $data->rate < $i)
                                                                                    <i class="fas fa-star-half-alt"></i>
                                                                                @else
                                                                                    <i class="far fa-star"></i>
                                                                                @endif
                                                                            @endif
                                                                        @endfor --}}
                                                                        <p class="h5">Rating: <span id="rateTalent" class="empty-stars" onclick="document.getElementsById('rateTalentValue').value = this.getAttribute('data-index');"></span></p>
                                                                        <div class="form-group green-border-focus">
                                                                            <textarea class="form-control" id="review_msg" name="review_msg" rows="3" maxlength="100" placeholder="Write comment (max 100 characters)" oninput="document.getElementById('revlimit').innerText = (100 - this.value.length)">@if($data->comment != '0') {{$data->comment}} @endif</textarea>
                                                                            <small><i>Left: <span id="revlimit">100</span></i></small>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-mdb-color text-capitalize rounded-lg mx-0 mb-0">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="watchVid{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                            <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $data->video)}}">
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal -->
                                                @else
                                                    @if ($data->status == 'Pending')
                                                        <p class="h4 m-0"><span class="badge badge-warning rounded-pill px-3 py-3"><i><span class="text-dark">Pending</span></i></span></p>
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