@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary d-flex justify-content-between">
                <h4 class="card-title mb-0">Talent User List</h4>
                <a href="#" data-toggle="tooltip" data-placement="top" title="Add new talent"><i class="fas fa-user-plus fa-2x mr-2" data-toggle="modal" data-target="#addTalent"></i></a>
            </div>
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
                                <button class="btn btn-primary text-capitalize mx-auto admin_crop_image"><h6 class="m-0">Crop & Upload Image</h6></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addTalent" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content dark-edition">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Add New Talent</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.userTalents.talent_create')}}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                <div class="input-group-prepend bg-dark rounded-right">
                                                    <div class="input-group-text" data-toggle="tooltip" data-placement="top" title="Verify Email">
                                                        <input type="checkbox" name="email_verified_at" @if(old('email_verified_at')) checked @endif>
                                                    </div>
                                                </div>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" min="8" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Confirm password</label>
                                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="date" class="form-control text-muted" name="dob" value="{{old('dob')}}" required autocomplete="dob">
                                        </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Phone</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" min="10" required autocomplete="phone">
                                                <div class="input-group-prepend bg-dark rounded-right">
                                                    <div class="input-group-text" data-toggle="tooltip" data-placement="top" title="Verify Phone">
                                                        <input type="checkbox" name="phone_verified_at" @if(old('phone_verified_at')) checked @endif>
                                                    </div>
                                                </div>
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="designation" required autocomplete="designation">
                                                <option disabled  @if(!old('designation')) selected @endif>Select Category...</option>
                                                @foreach ($categorys as $item)
                                                    <option class="text-dark" value="{{$item->id}}" @if(old('designation') == $item->id) selected @endif>{{$item->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="gender" required autocomplete="gender">
                                                <option disabled @if(!old('gender')) selected @endif>Select Gender</option>
                                                <option class="text-dark" value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                                                <option class="text-dark" value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <b><p class="h5 text-white mb-0 mt-2">Social Account :</p></b>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <select class="form-control" name="handler_name" required>
                                                <option disabled  @if(!old('handler_name')) selected @endif>Select social account</option>
                                                @foreach ($socialPlatforms as $item)
                                                    <option class="text-dark" value="{{$item->platform}}" @if(old('handler_name') == $item->platform) selected @endif>{{$item->platform}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Your social ID</label>
                                            <input type="text" class="form-control @error('handler_id') is-invalid @enderror" name="handler_id" value="{{ old('handler_id') }}" required autocomplete="handler_id">
                                            @error('handler_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Number of Followers</label>
                                            <input type="number" class="form-control @error('followers') is-invalid @enderror" name="followers" value="{{ old('followers') }}" required autocomplete="followers">
                                            @error('followers')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mt-3">Add New</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="card-body pb-0">
                <table class="table" id="dtHorizontal" cellspacing="0" width="100%">
                    <thead class="text-primary">
                        <tr>
                            <th class="text-white">Name</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">Phone</th>
                            <th class="text-white">Cut Ratio</th>
                            <th class="text-white">Status</th>
                            <th class="text-white text-center">Feature</th>
                            <th class="text-white text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userTalents as $user)
                        <tr>
                            <td class="text-white">{{$user->name}}</td>
                            <td class="text-white">
                                @if ($user->email_verified_at)
                                    <i class="fas fa-check-circle text-success mr-2"></i>{{$user->email}}
                                @else
                                    <a href="#" data-toggle="modal" data-target="#emailVerify{{$user->id}}" class="text-decoration-none"><i class="fas fa-exclamation-triangle text-warning mr-2"></i>{{$user->email}}</a>
                                    <div class="modal fade" id="emailVerify{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content dark-edition">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-white">Client Email Verification</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span class="text-white" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items-center">
                                                    <h5 class="mb-0">Verify this E-mail?</h5>
                                                    <form action="{{url('backend/user-talents/'. $user->id .'/email-verify')}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Verify</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="text-white">
                                @if ($user->phone)
                                    @if ($user->phone_verified_at)
                                        <i class="fas fa-check-circle text-success mr-2"></i>{{$user->phone}}
                                    @else
                                        <a href="#" data-toggle="modal" data-target="#phoneVerify{{$user->id}}" class="text-decoration-none"><i class="fas fa-exclamation-triangle text-warning mr-2"></i>{{$user->phone}}</a>
                                        <div class="modal fade" id="phoneVerify{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                <div class="modal-content dark-edition">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-white">Client Phone Verification</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span class="text-white" aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                        <h5 class="mb-0">Verify this number?</h5>
                                                        <form action="{{url('backend/user-talents/'. $user->id .'/phone-verify')}}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Verify</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <i class="fas fa-exclamation-triangle text-warning mr-2"></i><i>empty</i>
                                @endif
                            </td>
                            <td class="text-white">{{$user->cut_ratio}}</td>
                            <td>
                                @if ($user->status == 1)
                                    <span class="badge badge-success rounded-pill p-2"><i><i class="fas fa-check mr-2"></i>Active</i></span>
                                @else
                                    <span class="badge badge-danger rounded-pill p-2"><i><i class="fas fa-user-alt-slash mr-2"></i>Inactive</i></span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button id="featureThis{{$user->id}}" class="featureThis btn btn-link m-0" value="{{$user->id}}" type="button">
                                    @if ($user->feature) <i class="fas fa-star text-white"></i> @else <i class="far fa-star text-white"></i> @endif
                                </button>
                            </td>
                            <td class="text-white text-right">
                                {{-- <a href="#" data-toggle="modal" data-target="#talentProfileEdit{{$user->id}}"><i class="fas fa-pen-square fa-2x text-warning mr-3"></i></a> --}}
                                <a href="{{route('admin.talent.details', ['id' => $user->id])}}" data-toggle="tooltip" data-placement="left" title="Details"><i class="fas fa-info-circle fa-2x text-info mr-3"></i></a>
                                @if ($user->status == 0)
                                    <a href="#" data-toggle="modal" data-target="#accVerify{{$user->id}}"><i class="fas fa-check-circle fa-2x text-success" data-toggle="tooltip" data-placement="left" title="Activate account"></i></a>
                                @else
                                    <a href="#" data-toggle="modal" data-target="#accBan{{$user->id}}"><i class="fas fa-times-circle fa-2x text-danger" data-toggle="tooltip" data-placement="left" title="Deactivate account"></i></a>
                                @endif
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="seeInfo{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Client Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pt-4">
                                        <div class="card card-profile mb-0">
                                            <div class="img_div card-avatar mx-auto w-65">
                                                <label class="m-0" for="{{$user->id}}">
                                                    <span id="profile_pic">
                                                        <img src="{{($user->avatar) ? asset('storage/content/avatar/' . $user->avatar) : asset('images/avatar.png')}}" alt="Avatar" id="uploaded_image" class="image img-responsive rounded-circle">
                                                    </span>
                                                    <div class="overlay_img m-0">
                                                        <div class="text text-center text-dark"><p class="h6 m-0 font-weight-bolder">Change avatar</p></div>
                                                    </div>
                                                    <input type="file" class="custom-file-input d-none ad_avatar" id="{{$user->id}}" name="avatar" required>
                                                </label>
                                            </div>
                                            <h6 class="card-category text-capitalize">@if ($user->category) {{$user->category}} @else <i>empty</i> @endif</h6>
                                            <h4 class="card-title">{{$user->name}}</h4>
                                            <div class="card-body text-left">
                                                <p class="h5">
                                                    <span class="text-white mr-2">Email :</span>
                                                    <span>
                                                        @if ($user->email)
                                                            {{$user->email}} @if ($user->email_verified_at) <small class="ml-2"><span class="badge badge-success p-1"><i>Verified<i class="fas fa-check ml-2"></i></i></span></small> @else <small class="ml-2"><span class="badge badge-warning p-1"><i>Unverified<i class="fas fa-exclamation-triangle ml-2"></i></i></span></small> @endif
                                                        @else <small><i>empty</i></small> @endif
                                                    </span>
                                                </p>
                                                <p class="h5">
                                                    <span class="text-white mr-2">Phone :</span>
                                                    <span>
                                                        @if ($user->phone)
                                                            {{$user->phone}} @if ($user->phone_verified_at) <small class="ml-2"><span class="badge badge-success p-1"><i>Verified<i class="fas fa-check ml-2"></i></i></span></small> @else <small class="ml-2"><span class="badge badge-warning p-1"><i>Unverified<i class="fas fa-exclamation-triangle ml-2"></i></i></span></small> @endif
                                                        @else <small><i>empty</i></small> @endif
                                                    </span>
                                                </p>
                                                <p class="h5 d-flex justify-content-start align-items-end">
                                                    <span class="text-white mr-2">Gender :</span>
                                                    <span>@if ($user->gender) {{$user->gender}} @else <small><i>empty</i></small> @endif</span>
                                                </p>
                                                <p class="h5 d-flex justify-content-start align-items-end">
                                                    <span class="text-white mr-2">Date of Birth :</span>
                                                    <span>@if ($user->dob) {{$user->dob}} @else <small><i>empty</i></small> @endif</span>
                                                </p>
                                                <p class="h5">
                                                    <span class="text-white">Address :<br></span>
                                                    <span>@if ($user->address) {{$user->address}} @else <small><i>empty</i></small> @endif</span>
                                                </p>
                                                <p class="h5 d-flex justify-content-start align-items-end">
                                                    <span class="text-white mr-2">City :</span>
                                                    <span>@if ($user->city) {{$user->city}} @else <small><i>empty</i></small> @endif</span>
                                                </p>
                                                <p class="h5 d-flex justify-content-start align-items-end">
                                                    <span class="text-white mr-2">Country :</span>
                                                    <span>@if ($user->country) {{$user->country}} @else <small><i>empty</i></small> @endif</span>
                                                </p>
                                                <p class="h5 d-flex justify-content-start align-items-end">
                                                    <span class="text-white mr-2">Post code :</span>
                                                    <span>@if ($user->post_code) {{$user->post_code}} @else <small><i>empty</i></small> @endif</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="talentProfileEdit{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Edit Talent Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('backend/user-talents/'. $user->id .'/profile-edit')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="tl_name" value="{{$user->name}}" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <input type="date" class="form-control text-muted" name="tl_dob" value="{{$user->dob}}" required>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="tl_phone" value="{{$user->phone}}" required>
                                                        <div class="input-group-prepend bg-dark rounded-right">
                                                            <div class="input-group-text" data-toggle="tooltip" data-placement="top" title="Verify Phone">
                                                                <input type="checkbox" name="tl_phone_verified_at">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-4">
                                                <div class="col">
                                                    <select class="form-control" name="tl_designation" required>
                                                        @foreach ($categorys as $item)
                                                            <option class="text-dark" value="{{$item->id}}" @if ($user->category_id == $item->id) selected @endif>{{$item->category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="tl_gender">
                                                        <option class="text-dark" value="Male" @if ($user->gender == "Male") selected @endif>Male</option>
                                                        <option class="text-dark" value="Female" @if ($user->gender == "Female") selected @endif>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mt-3">Edit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="accVerify{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Client Profile Verification</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                        <h5 class="mb-0">Verify this account?</h5>
                                        <form action="{{url('backend/user-talents/'. $user->id .'/acc-verify')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Verify</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="accBan{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Deactive Client Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                        <h5 class="mb-0">Deactivate this account?</h5>
                                        <form action="{{url('backend/user-talents/'. $user->id .'/acc-ban')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-times mr-2"></i>Deactive</button>
                                        </form>
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
@endsection