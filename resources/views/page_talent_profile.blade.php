@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5 px-md-5">
        <!-- Modal -->
        <div class="modal fade" id="accActiveAlert" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content bg-danger">
                    <div class="modal-body text-center">
                        <p class="mb-0 h6 text-white">
                            <i class="fas fa-info-circle mr-2"></i>
                            Your account is not activated! Please contact with site admin.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="seeAllReview" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content unique-color-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reviews</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            @foreach ($ratings as $key => $item)
                                @if ($item->rate != '0')
                                    <button type="button" class="list-group-item list-group-item-action rounded-lg {{($key == 0) ? '' : 'mt-3'}}">
                                        <span><strong>{{$item->name}}</strong></span>
                                        <span class="float-right">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($item->rate > $i)
                                                    <i class="fas fa-star text-secondary"></i>
                                                @else
                                                    @if ($item->rate > ($i - 1) && $item->rate < $i)
                                                        <i class="fas fa-star-half-alt text-secondary"></i>
                                                    @else
                                                        <i class="far fa-star text-secondary"></i>
                                                    @endif
                                                @endif
                                            @endfor
                                        </span>
                                        @if ($item->comment != '0')
                                            <p class="text-break mt-2 mb-0">
                                                {{$item->comment}}
                                            </p>
                                        @endif
                                    </button>
                                @else
                                    <p class="mb-0"><i>No rating ...</i></p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="introVideo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered {{($talentInfo->intro_video ? 'modal-lg' : 'modal-sm')}}" role="document">
                <div class="modal-content unique-color-dark text-light">
                    <div class="modal-header d-flex justify-content-end align-items-center py-2">
                        <a class="btn btn-link p-0 m-0" data-dismiss="modal">
                            <i class="fas fa-times fa-2x"></i>
                        </a>
                    </div>
                    <div class="modal-body mb-0 p-0">
                        @if ($talentInfo->intro_video)
                            <div class="embed-responsive embed-responsive-16by9">
                                <video class="video-fluid z-depth-1" controls>
                                    <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $talentInfo->intro_video)}}">
                                </video>
                            </div>
                        @else
                            <div class="text-center">
                                <img class="img-fluid w-100" src="{{($talentInfo->avatar) ? asset('storage/content/avatar/' . $talentInfo->avatar) : asset('images/avatar.png')}}" alt="avatar">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        
        <div class="card border border-0">
            <div class="card-body special-color-dark py-0">
                <div class="row mb-3">
                    <div class="col text-left pl-0">
                        <a class="btn text-light special-color-dark rounded-pill m-0 px-3 py-2" href="@auth {{route('user.home')}} @else {{route('home')}} @endauth"><i class="fas fa-angle-left mr-2"></i>Back</a>
                    </div>
                    <div class="col text-right pr-0">
                        @auth
                            @if (!($talentInfo->id == auth()->user()->id))
                                <form action="{{url('user/talent-profile/'. $talentInfo->id . (($follow == 0) ? '/follow' : '/unfollow'))}}" method="post">
                                    @csrf

                                    <button class="btn text-light special-color-dark rounded-pill m-0 px-3 py-2" type="submit" value="{{$follow}}">@if ($follow == 0) <i class="far fa-star mr-2"></i>Follow @else <i class="fas fa-star mr-2"></i>Unfollow @endif</button>
                                </form>
                            @endif
                        @else
                            <a href="{{route('login')}}" class="btn text-light special-color-dark rounded-pill m-0 px-3 py-2"><i class="far fa-star mr-2"></i>Follow</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="card border border-0 mb-5">
            <div class="card-body special-color-dark py-0">
                <div class="row special-color-dark roundcard texture py-3">
                    <div class="col-md-4 text-center mb-md-0 mb-3">
                        <div class="avatar mb-3">
                            <a role="button" data-toggle="modal" data-target="#introVideo">
                                <img src="{{($talentInfo->avatar) ? asset('storage/content/avatar/' . $talentInfo->avatar) : asset('images/avatar.png')}}" class="rounded-circle img-fluid img-thumbnail color_b w-65" alt="Talent avatar">
                            </a>
                        </div>
                        <span class="mb-2">
                            @if (is_float($talentInfo->rating + 0))
                                @for ($i = 1; $i < 6; $i++)
                                    @if ($talentInfo->rating > $i)
                                        <i class="fas fa-star yellow-text"></i>
                                    @else
                                        @if ($talentInfo->rating > ($i - 1) && $talentInfo->rating < $i)
                                            <i class="fas fa-star-half-alt yellow-text"></i>
                                        @else
                                            <i class="far fa-star yellow-text"></i>
                                        @endif
                                    @endif
                                @endfor
                            @else
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($talentInfo->rating > $i)
                                        <i class="fas fa-star yellow-text"></i>
                                    @else
                                        @if ($talentInfo->rating > ($i - 1) && $talentInfo->rating < $i)
                                            <i class="fas fa-star-half-alt yellow-text"></i>
                                        @else
                                            <i class="far fa-star yellow-text"></i>
                                        @endif
                                    @endif
                                @endfor
                            @endif
                        </span>
                        <p class="h6 mb-0">
                            {{-- <a href="#" id="allReviewBtn" class="text-light" role="button" data="{{$talentInfo->id}}">See all reviews</a> --}}
                            <a href="#" class="text-light" role="button" data-toggle="modal" data-target="#seeAllReview">See all reviews</a>
                        </p>
                    </div>
                    <div class="col-md-8">
                        <p class="h2 mb-0"><b>{{$talentInfo->name}}</b></p>
                        <p class="h4 mb-3"><i>{{$talentInfo->category}}</i></p>
                        <p class="mb-4">{{$talentInfo->about_me}}</p>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="d-sm-none">
                                    <p>
                                        <span class="h5 mr-2">Responds by:</span>
                                        <span class="h4">
                                            <i class="fas fa-bolt text-warning mr-1"></i> {{$days}} Days
                                        </span>
                                    </p>
                                </div>
                                <div class="d-none d-sm-block">
                                    <h5>Responds by</h5>
                                    <h4 class="font-weight-bolder mb-0">
                                        <i class="fas fa-bolt text-warning mr-2"></i> {{$days}} Days
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-9">
                                @if ($tags != '0')
                                    @foreach ($tags as $item)
                                        <a href="#" class="text-white"><span class="mr-3">{{$item->tag}}</span></a>
                                    @endforeach
                                @else
                                    <p class="mb-0"><i>No tags</i></p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            @if ($talentInfo->available)
                                @auth
                                    @if (auth()->user()->status)
                                        @if (!($talentInfo->id == auth()->user()->id))
                                            <a class="btn btn-special gcolor btn-block rounded-pill text-capitalize py-3" role="button" href="{{route('user.book.talent', ['username' => $talentInfo->username])}}">
                                                <p class="h5 mb-0">Send Request for <span class="ml-1">৳ {{$talentInfo->vid_price}}</span></p>
                                            </a>
                                        @endif
                                    @else
                                        <a class="btn btn-block border border-light rounded-pill text-capitalize py-3" role="button" href="#" data-toggle="modal" data-target="#accActiveAlert">
                                            <p class="h5 mb-0">Send Request for <span class="ml-1">৳ {{$talentInfo->vid_price}}</span></p>
                                        </a>
                                    @endif
                                @else
                                    <a class="btn btn-special gcolor btn-block rounded-pill text-capitalize py-3" role="button" href="{{route('login')}}">
                                        <p class="h5 mb-0">Send Request for <span class="ml-1">৳ {{$talentInfo->vid_price}}</span></p>
                                    </a>
                                @endauth
                            @else
                                @auth
                                    @if (!($talentInfo->id == auth()->user()->id))
                                        <div class="custom-control custom-switch text-center border border-light rounded-pill py-3">
                                            <form action="{{url('user/talent-profile/'. $talentInfo->id . (($notify == 0) ? '/notify' : '/unotify'))}}" id="notify-user" method="post">
                                                @csrf
                                                <p class="mb-0">
                                                    <input type="checkbox" class="custom-control-input" name="notify" id="notify" value="{{$notify}}" onchange="document.getElementById('notify-user').submit();" @if ($notify != 0) checked @endif>
                                                    <label class="custom-control-label h5" for="notify">Notify me when available</label>
                                                </p>
                                            </form>
                                        </div>
                                    @endif
                                @else
                                    <div class="custom-control custom-switch text-center border border-light rounded-pill py-3">
                                        <form action="{{route('login')}}" id="go-to-login" method="post">
                                            <p class="mb-0">
                                                <input type="checkbox" class="custom-control-input" id="login-to-notify" onchange="document.getElementById('go-to-login').submit();">
                                                <label class="custom-control-label h5" for="login-to-notify">Notify me when available</label>
                                            </p>
                                        </form>
                                    </div>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h5 class="text-center mb-2 text-uppercase"><u>Latest Uploads</u></h5>
        </div>        
        <div class="row row-cols-1 row-cols-md-3 mb-5">
            @foreach ($talentVideos as $item)
                <div class="col-md">
                    <div class="modal fade" id="introVideo{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content special-color-dark text-light">
                                <div class="modal-header d-flex justify-content-end py-2">
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
                    <!-- Card -->
                    <div class="card h-100">
                        <a role="button" data-toggle="modal" data-target="#introVideo{{$item->id}}">
                            <div class="embed-responsive embed-responsive-16by9 rounded">
                                <video class="video-fluid z-depth-1">
                                    <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $item->video)}}">
                                </video>
                            </div>
                        </a>
                    </div>
                    <!-- Card -->
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col mb-md-0 mb-3">
                <div class="card special-color-dark border border-0">
                    <div class="card-body special-color-dark roundcard texture">
                        <p class="text-center h4 mb-3">What is Oplly?</p>
                        <div class="d-flex justify-content-between border border-light rounded-lg p-3">
                            <div class="text-center">
                                <i class="fas fa-mobile-alt fa-2x"></i><br>
                                <p class="mb-0">Send request</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-play-circle fa-2x"></i><br>
                                <p class="mb-0">Get video</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-thumbs-up fa-2x"></i><br>
                                <p class="mb-0">Share with others</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card special-color-dark border border-0">
                    <div class="card-body special-color-dark roundcard texture pb-md-5">
                        <p class="text-center h4 mb-3">How to request?</p>
                        <p class="mb-0 pb-md-3">Try to be as specific as possible with your request such as your relationship to the Oplly recipient, numbers & details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection