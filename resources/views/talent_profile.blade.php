@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 text-center mb-md-0 mb-3">
                <!--Avatar-->
                <div class="img_div mx-auto w-65">
                    <label class="m-0" for="avatar">
                        <span id="profile_pic">
                            <img src="{{(auth()->user()->avatar) ? asset('storage/content/avatar/' . auth()->user()->avatar) : asset('images/avatar.png')}}" alt="Avatar" id="uploaded_image" class="image img-responsive rounded-circle">
                        </span>
                        <div class="overlay_img m-0">
                            <div class="text text-center text-dark"><p class="h6 m-0 font-weight-bolder">Click to change profile image</p></div>
                        </div>
                        <input type="file" class="custom-file-input d-none" id="avatar" name="avatar" required>
                    </label>
                </div>
                <div id="uploadimageModal" class="modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title">Crop & Upload Avatar Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="text-white" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center">
                                    <div class="col">
                                        <div id="image_demo"></div>
                                    </div>
                                    <button class="btn btn-primary text-capitalize mx-auto crop_image"><h6 class="m-0">Crop & Upload Image</h6></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Name-->
                <h4 class="white-text mt-2"><b>{{auth()->user()->name}}</b></h4>

                <!-- User status -->
                <div class="custom-control custom-switch" data-toggle="tooltip" data-placement="bottom" title="Click to switch status">
                    <form action="{{route('user.profile.availability')}}" id="available-submit" method="post">
                        @csrf
                        <input type="checkbox" class="custom-control-input" name="availability" id="availability" onchange="document.getElementById('available-submit').submit();" @if ($userInfo->available) checked @endif>
                        <label class="custom-control-label" for="availability">Available</label>
                    </form>
                </div>
                {{-- <div class="custom-control custom-switch" data-toggle="tooltip" data-placement="bottom" title="Click to switch status">
                    <div data-toggle="modal" data-target="#talentState">
                        <input type="checkbox" class="custom-control-input" name="availability" id="availability" disabled @if ($userInfo->available == 1) checked @endif>
                        <label class="custom-control-label text-white" for="availability">@if ($userInfo->available == 1) available @else unavailable @endif</label>
                    </div>
                </div>
                <div class="modal fade" id="talentState" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content text-white special-color-dark rounded-lg">
                            <div class="modal-header">
                                <h5 class="modal-title text-white">Switch availability</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="text-white" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Change availability?</h5>
                                <form action="{{url('user/profile/availability/' . $userInfo->available)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning rounded-pill ml-1">Change</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!--Options tab-->
                <div class="font-weight-bold pt-4 my-3">
                    <!--Mobile view-->
                    <ul class="nav nav-pills d-md-none d-block">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-left px-4 active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Profile Options</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item @if (!session('tab-name') || session('tab-name') == 'accounts') active @endif" id="v-pills-accounts-tab" data-toggle="pill" href="#v-pills-accounts" aria-controls="v-pills-accounts">Accounts</a>
                                <a class="dropdown-item @if (session('tab-name') == 'orders') active @endif" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" aria-controls="v-pills-orders">Order Summary</a>
                                <a class="dropdown-item @if (session('tab-name') == 'profile') active @endif" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" aria-controls="v-pills-profile">Personal Information</a>
                                <a class="dropdown-item @if (session('tab-name') == 'banking') active @endif" id="v-pills-banking-tab" data-toggle="pill" href="#v-pills-banking" aria-controls="v-pills-banking">Bank Details</a>
                                <a class="dropdown-item @if (session('tab-name') == 'about') active @endif" id="v-pills-about-tab" data-toggle="pill" href="#v-pills-about" aria-controls="v-pills-about">BIO</a>
                                <a class="dropdown-item @if (session('tab-name') == 'video') active @endif" id="v-pills-video-tab" data-toggle="pill" href="#v-pills-video" aria-controls="v-pills-video">Intro Video</a>
                                <a class="dropdown-item @if (session('tab-name') == 'category') active @endif" id="v-pills-category-tab" data-toggle="pill" href="#v-pills-category" aria-controls="v-pills-category">Category</a>
                                <a class="dropdown-item @if (session('tab-name') == 'price') active @endif" id="v-pills-price-tab" data-toggle="pill" href="#v-pills-price" aria-controls="v-pills-price">Set Price</a>
                                <a class="dropdown-item @if (session('tab-name') == 'social') active @endif" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" aria-controls="v-pills-social">Social Account</a>
                                <a class="dropdown-item @if (session('tab-name') == 'password') active @endif" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" aria-controls="v-pills-password">Password</a>
                            </div>
                        </li>
                    </ul>

                    <!--Desktop view-->
                    <div class="nav flex-column nav-pills text-right d-none d-lg-block border border-light rounded-lg mx-md-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link @if (!session('tab-name') || session('tab-name') == 'accounts') active @endif" id="v-pills-accounts-tab" data-toggle="pill" href="#v-pills-accounts" role="tab" aria-controls="v-pills-accounts" aria-selected="false">Accounts</a>
                        <a class="nav-link @if (session('tab-name') == 'orders') active @endif" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">Order Summary</a>
                        <a class="nav-link @if (session('tab-name') == 'profile') active @endif" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Personal Information</a>
                        <a class="nav-link @if (session('tab-name') == 'banking') active @endif" id="v-pills-banking-tab" data-toggle="pill" href="#v-pills-banking" role="tab" aria-controls="v-pills-banking" aria-selected="false">Bank Details</a>
                        <a class="nav-link @if (session('tab-name') == 'about') active @endif" id="v-pills-about-tab" data-toggle="pill" href="#v-pills-about" role="tab" aria-controls="v-pills-about" aria-selected="false">BIO</a>
                        <a class="nav-link @if (session('tab-name') == 'video') active @endif" id="v-pills-video-tab" data-toggle="pill" href="#v-pills-video" role="tab" aria-controls="v-pills-video" aria-selected="false">Intro Video</a>
                        <a class="nav-link @if (session('tab-name') == 'category') active @endif" id="v-pills-category-tab" data-toggle="pill" href="#v-pills-category" role="tab" aria-controls="v-pills-category" aria-selected="false">Category</a>
                        <a class="nav-link @if (session('tab-name') == 'price') active @endif" id="v-pills-price-tab" data-toggle="pill" href="#v-pills-price" role="tab" aria-controls="v-pills-price" aria-selected="false">Set Price</a>
                        <a class="nav-link @if (session('tab-name') == 'social') active @endif" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="false">Social Account</a>
                        <a class="nav-link @if (session('tab-name') == 'password') active @endif" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Password</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade @if (!session('tab-name') || session('tab-name') == 'accounts') show active @endif" id="v-pills-accounts" role="tabpanel" aria-labelledby="v-pills-accounts-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Accounts</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-md-3">
                                    <div class="col-md">
                                        <p class="h5 mb-md-0">Total Earnings: <i>{{$userInfo->total_income}} {{$userInfo->currency}}</i></p>
                                    </div>
                                    <div class="col-md">
                                        <p class="h5 mb-md-0">Income Ratio: <i>{{$userInfo->cut_ratio}}%</i></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md">
                                        <p class="h5 mb-md-0">Total Withdrawal: <i>{{$userInfo->total_withdrawal}} {{$userInfo->currency}}</i></p>
                                    </div>
                                    <div class="col-md">
                                        <p class="h5 mb-md-0">Amount Left: <i>{{$userInfo->total_income - $userInfo->total_withdrawal}} {{$userInfo->currency}}</i></p>
                                    </div>
                                </div>
                                <div class="table-responsive pb-0">
                                    <table class="table table-sm table-hover" id="dtHorizontal" cellspacing="0" width="100%">
                                        <thead class="text-primary">
                                            <tr class="text-white">
                                                <th></th>
                                                <th>Request By</th>
                                                <th>Occasion</th>
                                                <th>Ratio</th>
                                                <th>Amount</th>
                                                <th class="text-right">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userAcc as $item)
                                                <tr class="text-white">
                                                    <td class="text-left">
                                                        @if ($item->reqstat == 'Submitted') <i class="fas fa-check text-success" data-toggle="tooltip" data-placement="top" title="Submitted"></i> @else @if ($item->reqstat == 'Pending') <i class="fas fa-spinner text-warning" data-toggle="tooltip" data-placement="top" title="Pending"></i> @else <i class="fas fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Rejected"></i> @endif @endif
                                                    </td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->occasion}}</td>
                                                    <td>{{$item->ratio}}</td>
                                                    <td>{{$item->currency}} {{$item->income}}</td>
                                                    <td class="text-right">
                                                        <a href="#" data-toggle="modal" data-target="#requestInfo{{$item->id}}"><i class="fas fa-info-circle text-info"></i></a>
                                                        <div class="modal fade" id="requestInfo{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                                <div class="modal-content bg-dark text-white text-left">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-white">Request Details</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span class="text-white" aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <p><span class="h6">Request By:</span> <span class="ml-1">{{$item->name}}</span></p>
                                                                            @if ($item->from != 0)
                                                                                <p><span class="h6">Request From:</span> <span class="ml-1">{{$item->from}}</span></p>
                                                                            @endif
                                                                            <p><span class="h6">Request For:</span> <span class="ml-1">{{$item->to}}</span></p>
                                                                            <p><span class="h6">Pronoun:</span> <span class="ml-1">{{$item->pronoun}}</span></p>
                                                                            <p><span class="h6">Occasion:</span> <span class="ml-1">{{$item->occasion}}</span></p>
                                                                            <p class="mb-0"><span class="h6">Instruction:</span> <span class="ml-1">{{$item->instruction}}</span></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'orders') show active @endif" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Order Summary</h4>
                            </div>
                            <div class="card-body table-responsive pb-0">
                                <table class="table table-sm table-hover" id="dtHorizontal" cellspacing="0" width="100%">
                                    <thead class="text-primary">
                                        <tr class="text-white">
                                            <th></th>
                                            <th>Transaction ID</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th class="text-right">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-white">
                                        @foreach ($orders as $item)
                                            <tr class="text-white">
                                                <td class="text-left">
                                                    @if ($item->status == 'Success') <i class="fas fa-check text-success"></i> @else <i class="fas fa-times text-danger"></i> @endif
                                                </td>
                                                <td>{{$item->tx_id}}</td>
                                                <td>{{$item->currency}} {{$item->amount}}</td>
                                                <td>{{$item->payment_option}}</td>
                                                <td class="text-right">
                                                    @if ($item->reqstatus == 'Pending')
                                                        <a href="#" data-toggle="modal" data-target="#editInfo{{$item->id}}"><i class="far fa-edit text-warning" data-toggle="tooltip" data-placement="top" title="Edit Request"></i></a>
                                                        <div class="modal fade" id="editInfo{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content unique-color-dark text-light">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modify Request</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span class="text-white" aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST" action="{{route('user.modify.order', ['request_id' => $item->request_id])}}">
                                                                            @csrf

                                                                            <div class="text-left">
                                                                                <label for="video_for">Video For :</label>
                                                                                <input type="text" id="video_for" name="video_for" class="form-control mb-3" value="{{$item->to}}" required>

                                                                                <label for="video_from">Video From (Optional):</label>
                                                                                <input type="text" id="video_from" name="video_from" class="form-control mb-3" @if ($item->from == '0') placeholder="From" @else value="{{$item->from}}" @endif>

                                                                                <label for="pronoun">Pronoun :</label>
                                                                                <select class="form-control mb-3" name="pronoun" id="pronoun" required>
                                                                                    <option value="She/Her" @if ($item->pronoun == 'She/Her') selected @endif>She/Her: "Wish her a happy birthday"</option>
                                                                                    <option value="He/Him" @if ($item->pronoun == 'He/Him') selected @endif>He/Him: "Wish Him a happy birthday"</option>
                                                                                    <option value="They/Them" @if ($item->pronoun == 'They/Them') selected @endif>They/Them: "Wish Them a happy birthday"</option>
                                                                                    <option value="Other" @if ($item->pronoun == 'Other') selected @endif>Other: - will clarify in the instruction</option>
                                                                                </select>

                                                                                <label for="occasion">Occasion :</label>
                                                                                <select class="form-control mb-3" id="occasion" name="occasion" required>
                                                                                    <option value="None" @if ($item->occasion == 'None') selected @endif>None</option>
                                                                                    <option value="Birthday" @if ($item->occasion == 'Birthday') selected @endif>Birthday</option>
                                                                                    <option value="Anniversary" @if ($item->occasion == 'Anniversary') selected @endif>Anniversary</option>
                                                                                    <option value="Give Thanks" @if ($item->occasion == 'Give Thanks') selected @endif>Give Thanks</option>
                                                                                    <option value="Wedding" @if ($item->occasion == 'Wedding') selected @endif>Wedding</option>
                                                                                    <option value="Gift" @if ($item->occasion == 'Gift') selected @endif>Gift</option>
                                                                                    <option value="Announcement" @if ($item->occasion == 'Announcement') selected @endif>Announcement</option>
                                                                                    <option value="Roast" @if ($item->occasion == 'Roast') selected @endif>Roast</option>
                                                                                    <option value="Get advice" @if ($item->occasion == 'Get advice') selected @endif>Get advice</option>
                                                                                    <option value="Question" @if ($item->occasion == 'Question') selected @endif>Question</option>
                                                                                    <option value="Pep talk" @if ($item->occasion == 'Pep talk') selected @endif>Pep talk</option>
                                                                                    <option value="Just cuz" @if ($item->occasion == 'Just cuz') selected @endif>Just cuz</option>
                                                                                </select>

                                                                                <label for="instruction">Instructions :</label>
                                                                                <textarea name="instruction" id="instruction" rows="3" class="form-control mb-3" required>{{$item->instruction}}</textarea>

                                                                                <div class="custom-control custom-checkbox mb-4">
                                                                                    <input type="checkbox" class="custom-control-input" name="hide" id="hide" @if ($item->hide == 1) checked @endif>
                                                                                    <label class="custom-control-label" for="hide">Hide from talent's profile</label>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold">Update</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <a href="#" data-toggle="modal" data-target="#orderInfo{{$item->id}}"><i class="fas fa-info-circle text-info ml-2" data-toggle="tooltip" data-placement="top" title="See Details"></i></a>
                                                    <div class="modal fade" id="orderInfo{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                            <div class="modal-content bg-dark text-white text-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-white">Order Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span class="text-white" aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div>
                                                                        <p><span class="h6">Transaction No.:</span> <span class="ml-1">{{$item->tx_id}}</span></p>
                                                                        <p><span class="h6">Amount:</span> <span class="ml-1">{{$item->currency}} {{$item->amount}}</span></p>
                                                                        <p><span class="h6">Payment method:</span> <span class="ml-1">{{$item->payment_option}}</span></p>
                                                                        <p class="mb-0"><span class="h6">Status:</span> <span class="ml-1">{{$item->status}}</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'profile') show active @endif" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Personal Information</h4>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">
                                    <span class="h5">Email : {{auth()->user()->email}}</span>
                                    @if (auth()->user()->email_verified_at)
                                        <small class="text-success ml-2"><i><i class="fas fa-check mr-1"></i>Verified</i></small>
                                    @else
                                        <small class="text-warning ml-2"><i><i class="fas fa-exclamation-triangle mr-1"></i>Unverified</i></small>
                                    @endif
                                </p>
                                @if (!auth()->user()->email_verified_at)
                                    <form method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-white text-capitalize p-0 m-0">{{ __('Click to verify email') }}</button>
                                    </form>
                                @endif
                                <form class="mt-3" method="POST" action="{{route('user.profile.info.update')}}">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{auth()->user()->name}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="phone" id="talentPhone" placeholder="Phone" value="{{auth()->user()->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="date" class="form-control text-muted" name="dob" value="{{auth()->user()->dob}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control" name="gender">
                                                    <option class="text-muted" disabled @if (!auth()->user()->gender) selected @endif>Gender</option>
                                                    <option class="text-dark" value="Male" @if (auth()->user()->gender == 'Male') selected @endif>Male</option>
                                                    <option class="text-dark" value="Female" @if (auth()->user()->gender == 'Female') selected @endif>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address" placeholder="Adress" value="{{auth()->user()->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="city" placeholder="City" value="{{auth()->user()->city}}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="country" placeholder="Country" value="{{auth()->user()->country}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="post_code" placeholder="Postal Code" value="{{auth()->user()->post_code}}">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-special btn-sm text-capitalize gcolor btn-block rounded-pill mt-4"><h5 class="my-1"><i class="far fa-id-card mr-2"></i>Update Profile</h5></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'banking') show active @endif" id="v-pills-banking" role="tabpanel" aria-labelledby="v-pills-banking-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Bank Details</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('user.profile.bank.update')}}">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="{{$userInfo->bank_name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="branch_name" placeholder="Branch Name" value="{{$userInfo->branch_name}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="acc_name" placeholder="Bank Account Name" value="{{$userInfo->acc_name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="acc_id" placeholder="Bank Account Number" value="{{$userInfo->acc_id}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="swift_code" placeholder="Bank Swift Code" value="{{$userInfo->swift_code}}">
                                            </div>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="btn btn-special btn-sm text-capitalize gcolor btn-block rounded-pill mt-4"><h5 class="my-1"><i class="far fa-id-card mr-2"></i>Update</h5></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'about') show active @endif" id="v-pills-about" role="tabpanel" aria-labelledby="v-pills-about-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">BIO</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('user.profile.about.update')}}">
                                    @csrf
                                    
                                    <div class="form-group green-border-focus">
                                        <textarea class="form-control" id="exampleFormControlTextarea5" name="about_me" rows="5" maxlength="150">{{$userInfo->about_me}}</textarea>
                                    </div>
    
                                    <button type="submit" class="btn btn-special btn-sm text-capitalize gcolor btn-block rounded-pill mt-4"><h5 class="my-1"><i class="far fa-file-alt mr-2"></i>Update</h5></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'video') show active @endif" id="v-pills-video" role="tabpanel" aria-labelledby="v-pills-video-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Intro Video</h4>
                            </div>
                            <div class="card-body">
                                @if ($userInfo->intro_video)
                                    <div class="row">
                                        <div class="col">
                                            <div class="embed-responsive embed-responsive-16by9 rounded-top">
                                                <video class="video-fluid z-depth-1" controls>
                                                    <source class="embed-responsive-item" src="{{asset('storage/content/video/' . $userInfo->intro_video)}}">
                                                </video>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between align-items-center special-color-dark rounded-bottom py-1">
                                                <a data-toggle="modal" data-target="#videoEdit"><i class="fas fa-pen-square fa-2x text-light" data-toggle="tooltip" data-placement="right" title="Change"></i></a>
                                                <a data-toggle="modal" data-target="#videoDelete"><i class="fas fa-trash-alt fa-2x text-light" data-toggle="tooltip" data-placement="left" title="Delete"></i></a>
                                            </div>
                                            <div class="modal fade" id="videoEdit" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content bg-dark text-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Change Intro Video</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{route('user.profile.update.intro_video')}}" id="edit-upload_intro" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input @error('video_update') is-invalid @enderror" name="video_update" id="video_update" onchange="modalviderrorclear()" required>
                                                                                <label class="custom-file-label" for="video_update">Choose file</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-0 mt-1" id="modalvidValidation"></p>
                                                                @error('video_update')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <div class="row mt-4">
                                                                    <div class="col-md">
                                                                        <button class="btn btn-sm btn-block btn-primary text-capitalize rounded-lg m-0 waves-effect" type="button" onclick="modalfileSizeValidation()">
                                                                            <h6 class="m-0">Upload</h6>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="videoDelete" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content text-white special-color-dark rounded-lg">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Delete Video</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <h5 class="mb-0">Are you sure to delete this?</h5>
                                                            <form action="{{route('user.profile.delete.intro_video')}}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-check mr-1"></i>Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <form method="POST" action="{{route('user.profile.add.intro_video')}}" id="upload-intro" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <p class="h6"><i>No video found.</i></p>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('video') is-invalid @enderror" name="video" id="video" onchange="viderrorclear()" required>
                                                        <label class="custom-file-label" for="video">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0 mt-1" id="vidValidation"></p>
                                        @error('video')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="row mt-4">
                                            <div class="col-md">
                                                <button class="btn btn-primary text-capitalize rounded-lg m-0 waves-effect" type="button" onclick="fileSizeValidation()">
                                                    <h6 class="m-0">Upload</h6>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'category') show active @endif" id="v-pills-category" role="tabpanel" aria-labelledby="v-pills-category-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Category</h4>
                            </div>
                            <div class="card-body">
                                <p class="h5"><span class="text-muted">Primary category :</span> {{$userInfo->category}}</p>
                                @if ($ctgs != '0')
                                    <p class="h5 mt-2"><span class="text-muted">Other categories :</span> @foreach ($ctgs as $item) {{$item->category}}<span>, </span> @endforeach</p>
                                @endif
                                <form method="POST" action="{{route('user.profile.category.select')}}">
                                    @csrf
                                    
                                    <div class="row mt-4">
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend" data-toggle="tooltip" data-placement="top" title="Make Primary">
                                                    <div class="input-group-text bg-warning">
                                                        <input type="checkbox" name="primary" checked>
                                                    </div>
                                                </div>
                                                <select class="browser-default custom-select" name="designation" required>
                                                    <option disabled selected>Choose...</option>
                                                    @foreach ($categories as $item)
                                                        <option class="text-dark" value="{{$item->id}}" @if ($userInfo->category_id == $item->id) selected @endif>{{$item->category}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-md btn-primary text-capitalize rounded-right m-0 px-3 py-2 z-depth-0 waves-effect" type="submit"><h6 class="m-0">Choose</h6></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'price') show active @endif" id="v-pills-price" role="tabpanel" aria-labelledby="v-pills-price-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Service Price</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('user.profile.set.video.price')}}">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="set-price"><i class="fas fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="number" name="vid_price" class="form-control" value="{{$userInfo->vid_price}}" aria-describedby="set-price" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-md btn-primary text-capitalize rounded-right text-capitalize m-0 px-3 py-2 z-depth-0 waves-effect" type="submit"><h6 class="m-0">Set it</h6></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'social') show active @endif" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                        <div class="card text-white special-color-dark rounded-lg texture">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Social Accounts</h4>
                            </div>
                            <div class="card-body">
                                @if (auth()->user()->status == 1)
                                    <a class="btn btn-link text-white px-0 m-0" data-toggle="collapse" href="#collapseExample" role="button"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-plus mr-2"></i>Add Social Account
                                    </a>
                                @endif
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body text-white special-color-dark texture my-0 p-0">
                                        <form action="{{route('user.profile.handler.create')}}" method="POST">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control" name="handler_name" required>
                                                            <option selected disabled>Social account</option>
                                                            @foreach ($socialPlatforms as $item)
                                                                <option class="text-dark" value="{{$item->platform}}">{{$item->platform}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="handler_id" placeholder="Your social ID" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="followers" placeholder="Followers" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-special btn-block rounded-pill gcolor m-0 py-2 float-right">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-white" scope="col"><b>ID</b></th>
                                                <th class="text-white" scope="col"><b>Name</b></th>
                                                <th class="text-white" scope="col"><b>Followers</b></th>
                                                <th class="text-white text-right" scope="col"><b>Action</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($userSocialAcc as $key => $data)
                                                <tr class="text-white">
                                                    <td>{{$data->social_acc_id}}</td>
                                                    <td>{{$data->social_acc_name}}</td>
                                                    <td>{{$data->followers}}</td>
                                                    <td class="text-right">
                                                        <a data-toggle="modal" data-target="#handlerEdit">
                                                            <i class="fas fa-pen-square align-self-center mr-3" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#handlerDelete">
                                                            <i class="fas fa-trash-alt align-self-center" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!--Grid column-->
                                                <div class="modal fade" id="handlerEdit" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                        <div class="modal-content text-white special-color-dark rounded-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Edit Social Account</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span class="text-white" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{url('useruser/profile/handler-edit/' . $data->id)}}" method="POST">
                                                                    @csrf
                                                                    <div class="form-group mb-2">
                                                                        <select class="form-control" name="handler_name" required>
                                                                            @foreach ($socialPlatforms as $item)
                                                                                <option class="text-dark" value="{{$item->platform}}" @if ($item->platform == $data->social_acc_name) selected @endif>{{$item->platform}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <input type="text" class="form-control" name="handler_id" value="{{$data->social_acc_id}}" placeholder="Your social ID" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <input type="number" class="form-control" name="followers" value="{{$data->followers}}" placeholder="Followers" required>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-special gcolor btn-block btn-sm m-0 float-right">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="handlerDelete" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content text-white special-color-dark rounded-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Delete Social Account</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span class="text-white" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body d-flex justify-content-center align-items-center">
                                                                <h5 class="mb-0">Are you sure to delete this entry?</h5>
                                                                <form action="{{url('user/profile/handler-delete/' . $data->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Grid column-->
                                            @empty
                                                <tr><td><p class="text-white mb-0">No data found.</p></td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if (session('tab-name') == 'password') show active @endif" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <div class="card text-white special-color-dark rounded-lg texture mb-3">
                            <div class="card-header border-bottom card-header-primary border-light border-bottom">
                                <h4 class="card-title mb-0">Password</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('user.profile.password.update')}}">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="password_confirmation" id="password-confirm" placeholder="Confirm password" required>
                                            </div>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="btn btn-special btn-sm text-capitalize gcolor btn-block rounded-pill mt-4"><h5 class="my-1"><i class="fas fa-unlock-alt mr-2"></i>Change Password</h5></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
