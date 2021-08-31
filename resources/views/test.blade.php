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

                <!--Options tab-->
                <div class="font-weight-bold pt-4 my-3">
                    <!--Mobile view-->
                    <ul class="nav nav-pills d-md-none d-block">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-left px-4 active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Profile Options</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item @if (!session('tab-name') || session('tab-name') == 'orders') active @endif" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" aria-controls="v-pills-orders">Order Summary</a>
                                <a class="dropdown-item @if (session('tab-name') == 'profile') active @endif" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" aria-controls="v-pills-profile">Personal Information</a>
                                <a class="dropdown-item @if (session('tab-name') == 'password') active @endif" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" aria-controls="v-pills-password">Password</a>
                            </div>
                        </li>
                    </ul>

                    <!--Desktop view-->
                    <div class="nav flex-column nav-pills text-right d-none d-lg-block border border-light rounded-lg mx-md-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link @if (!session('tab-name') || session('tab-name') == 'orders') active @endif" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">Order Summary</a>
                        <a class="nav-link @if (session('tab-name') == 'profile') active @endif" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Personal Information</a>
                        <a class="nav-link @if (session('tab-name') == 'password') active @endif" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Password</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade @if (!session('tab-name') || session('tab-name') == 'orders') show active @endif" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
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
                                                        <a href="#" data-toggle="modal" data-target="#editTrnInfo{{$item->id}}"><i class="far fa-edit text-warning" data-toggle="tooltip" data-placement="top" title="Edit Request"></i></a>
                                                        <div class="modal fade" id="editTrnInfo{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                                <input type="text" name="video_for" class="form-control mb-3 @error('video_for') is-invalid @enderror" value="{{(old('video_for') ?? $item->to)}}" required autocomplete="video_for">
                                                                                @error('video_for')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                
                                                                                <label for="video_from">Video From (Optional):</label>
                                                                                <input type="text" name="video_from" class="form-control mb-3 @error('video_from') is-invalid @enderror" @if ($item->from == '0') placeholder="From" @else value="{{(old('video_from') ?? $item->from)}}" @endif>
                                                                                @error('video_from')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                
                                                                                <label for="pronoun">Pronoun :</label>
                                                                                <select class="form-control mb-3" name="pronoun" required>
                                                                                    <option value="She/Her" @if ((old('pronoun') ?? $item->pronoun) == 'She/Her') selected @endif>She/Her: "Wish her a happy birthday"</option>
                                                                                    <option value="He/Him" @if ((old('pronoun') ?? $item->pronoun) == 'He/Him') selected @endif>He/Him: "Wish Him a happy birthday"</option>
                                                                                    <option value="They/Them" @if ((old('pronoun') ?? $item->pronoun) == 'They/Them') selected @endif>They/Them: "Wish Them a happy birthday"</option>
                                                                                    <option value="Other" @if ((old('pronoun') ?? $item->pronoun) == 'Other') selected @endif>Other: - will clarify in the instruction</option>
                                                                                </select>
                                
                                                                                <label for="occasion">Occasion :</label>
                                                                                <select class="form-control mb-3" name="occasion" required>
                                                                                    <option value="None" @if ((old('occasion') ?? $item->occasion) == 'None') selected @endif>None</option>
                                                                                    <option value="Birthday" @if ((old('occasion') ?? $item->occasion) == 'Birthday') selected @endif>Birthday</option>
                                                                                    <option value="Anniversary" @if ((old('occasion') ?? $item->occasion) == 'Anniversary') selected @endif>Anniversary</option>
                                                                                    <option value="Give Thanks" @if ((old('occasion') ?? $item->occasion) == 'Give Thanks') selected @endif>Give Thanks</option>
                                                                                    <option value="Wedding" @if ((old('occasion') ?? $item->occasion) == 'Wedding') selected @endif>Wedding</option>
                                                                                    <option value="Gift" @if ((old('occasion') ?? $item->occasion) == 'Gift') selected @endif>Gift</option>
                                                                                    <option value="Announcement" @if ((old('occasion') ?? $item->occasion) == 'Announcement') selected @endif>Announcement</option>
                                                                                    <option value="Roast" @if ((old('occasion') ?? $item->occasion) == 'Roast') selected @endif>Roast</option>
                                                                                    <option value="Get advice" @if ((old('occasion') ?? $item->occasion) == 'Get advice') selected @endif>Get advice</option>
                                                                                    <option value="Question" @if ((old('occasion') ?? $item->occasion) == 'Question') selected @endif>Question</option>
                                                                                    <option value="Pep talk" @if ((old('occasion') ?? $item->occasion) == 'Pep talk') selected @endif>Pep talk</option>
                                                                                    <option value="Just cuz" @if ((old('occasion') ?? $item->occasion) == 'Just cuz') selected @endif>Just cuz</option>
                                                                                </select>
                                
                                                                                <label for="instruction">Instructions :</label>
                                                                                <textarea name="instruction" rows="3" class="form-control mb-3 @error('instruction') is-invalid @enderror" required autocomplete="instruction">{{(old('instruction') ?? $item->instruction)}}</textarea>
                                                                                @error('instruction')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror

                                                                                <div class="custom-control custom-checkbox mb-4">
                                                                                    <input type="checkbox" class="custom-control-input" name="hide" @if ((old('hide') ?? $item->hide) == '1') checked @endif>
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
                                <p class="h5 mb-3">
                                    <span class="text-white mr-2">Email :</span>
                                    <span class="text-muted">
                                        @if (auth()->user()->email)
                                            {{auth()->user()->email}}
                                            {{-- @if (auth()->user()->email_verified_at) <small class="text-success ml-2"><i>Verified<i class="fas fa-check ml-2"></i></i></small> @else <small class="text-warning ml-2"><i>Unverified<i class="fas fa-exclamation-triangle ml-2"></i></i></small> @endif --}}
                                        @else <small><i>empty</i></small> @endif
                                    </span>
                                </p>
                                <form method="POST" action="{{route('user.profile.info.update')}}">
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
