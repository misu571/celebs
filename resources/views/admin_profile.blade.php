@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <!-- Modal -->
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
                                    <button class="btn btn-primary text-capitalize mx-auto adminprofile_crop_image"><h6 class="m-0">Crop & Upload Image</h6></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="card card-profile">
                    <div class="card-avatar img_div mx-auto w-65">
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
                    <div class="card-body">
                        <h4 class="card-title">{{auth()->user()->name}}</h4>
                        <p class="card-description text-light"><b>@if (auth()->user()->level == 0) Developer @elseif (auth()->user()->level == 1) Administrator @elseif (auth()->user()->level == 2) Manager @else Operator @endif</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Edit Profile</h4>
                        <p class="card-category">Complete your profile</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p class="h5">
                                    <span class="text-white mr-2">Profile status :</span>
                                    <span>
                                        @if (auth()->user()->status == 0)
                                            <span class="badge badge-light p-2"><i><i class="fas fa-exclamation mr-2"></i>Inactive</i></span>
                                        @else
                                            <span class="badge badge-success p-2"><i><i class="fas fa-check mr-2"></i>Active</i></span>
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="h5">
                                    <span class="text-white mr-2">Email :</span>
                                    <span>
                                        @if (auth()->user()->email)
                                            {{auth()->user()->email}} @if (auth()->user()->email_verified_at) <small class="text-success ml-2"><i>Verified<i class="fas fa-check ml-2"></i></i></small> @else <small class="text-warning ml-2"><i>Unverified<i class="fas fa-exclamation-triangle ml-2"></i></i></small> @endif
                                        @else <small><i>empty</i></small> @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="h5">
                                    <span class="text-white mr-2">Phone :</span>
                                    <span>
                                        @if (auth()->user()->phone)
                                            {{auth()->user()->phone}} @if (auth()->user()->phone_verified_at) <small class="text-success ml-2"><i>Verified<i class="fas fa-check ml-2"></i></i></small> @else <small class="text-warning ml-2"><i>Unverified<i class="fas fa-exclamation-triangle ml-2"></i></i></small> @endif
                                        @else <small><i>empty</i></small> @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="h5 d-flex justify-content-start align-items-end">
                                    <span class="text-white mr-2">Gender :</span>
                                    <span>@if (auth()->user()->gender) {{auth()->user()->gender}} @else <small><i>empty</i></small> @endif</span>
                                </p>
                            </div>
                            <div class="col">
                                <p class="h5 d-flex justify-content-start align-items-end">
                                    <span class="text-white mr-2">Date of Birth :</span>
                                    <span>@if (auth()->user()->dob) {{auth()->user()->dob}} @else <small><i>empty</i></small> @endif</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="h5">
                                    <span class="text-white">Address :</span><br>
                                    <span>@if (auth()->user()->address) {{auth()->user()->address}} @else <small><i>empty</i></small> @endif</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="h5 d-flex justify-content-start align-items-end">
                                    <span class="text-white mr-2">City :</span>
                                    <span>@if (auth()->user()->city) {{auth()->user()->city}} @else <small><i>empty</i></small> @endif</span>
                                </p>
                            </div>
                            <div class="col">
                                <p class="h5 d-flex justify-content-start align-items-end">
                                    <span class="text-white mr-2">Country :</span>
                                    <span>@if (auth()->user()->country) {{auth()->user()->country}} @else <small><i>empty</i></small> @endif</span>
                                </p>
                            </div>
                            <div class="col">
                                <p class="h5 d-flex justify-content-start align-items-end">
                                    <span class="text-white mr-2">Post code :</span>
                                    <span>@if (auth()->user()->post_code) {{auth()->user()->post_code}} @else <small><i>empty</i></small> @endif</span>
                                </p>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="updateProfile" tabindex="-1" role="dialog" aria-labelledby="talentSigninLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Update Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('admin.profile.info.update')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Phone</label>
                                                        <input type="number" class="form-control" name="phone" id="talentPhone" value="{{auth()->user()->phone}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control text-muted" name="dob" value="{{auth()->user()->dob}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select class="form-control" name="gender">
                                                            <option class="text-muted" disabled @if (!auth()->user()->gender) selected @endif>Select Gender</option>
                                                            <option class="text-dark" value="Male" @if (auth()->user()->gender == 'Male') selected @endif>Male</option>
                                                            <option class="text-dark" value="Female" @if (auth()->user()->gender == 'Female') selected @endif>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Adress</label>
                                                        <input type="text" class="form-control" name="address" value="{{auth()->user()->address}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">City</label>
                                                        <input type="text" class="form-control" name="city" value="{{auth()->user()->city}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Country</label>
                                                        <input type="text" class="form-control" name="country" value="{{auth()->user()->country}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Postal Code</label>
                                                        <input type="text" class="form-control" name="post_code" value="{{auth()->user()->post_code}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mt-3">Update Profile</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfile">Update Profile</button>
                        <!-- Modal -->
                        <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="talentSigninLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Change Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('admin.profile.password.update')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Old password</label>
                                                <input type="password" class="form-control" name="old_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Confirm password</label>
                                                <input type="password" class="form-control" name="password_confirmation" id="password-confirm" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mt-3">Change Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="d-flex align-items-center mt-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePassword">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection