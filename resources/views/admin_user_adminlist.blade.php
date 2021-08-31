@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary d-flex justify-content-between">
                <h4 class="card-title mb-0">Admin User List</h4>
                <a href="#" data-toggle="tooltip" data-placement="top" title="Add new employee"><i class="fas fa-user-plus fa-2x mr-2" data-toggle="modal" data-target="#addAdmin"></i></a>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content dark-edition">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Add New Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.userAdmins.admin_create')}}" method="POST">
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
                                            <select class="form-control" name="gender" required autocomplete="gender">
                                                <option disabled @if(!old('gender')) selected @endif>Select Gender</option>
                                                <option class="text-dark" value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                                                <option class="text-dark" value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                                            </select>
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
                                            <label class="bmd-label-floating">Confirm password</label>
                                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="level" required autocomplete="level">
                                                <option disabled  @if(!old('level')) selected @endif>Select Job Title</option>
                                                @if (auth()->user()->level == 0)
                                                    <option class="text-dark" value="1" @if(old('level') == '1') selected @endif>Administrator</option>
                                                    <option class="text-dark" value="2" @if(old('level') == '2') selected @endif>Manager</option>
                                                    <option class="text-dark" value="3" @if(old('level') == '3') selected @endif>Operator</option>
                                                @elseif (auth()->user()->level == 1)
                                                    <option class="text-dark" value="2" @if(old('level') == '2') selected @endif>Manager</option>
                                                    <option class="text-dark" value="3" @if(old('level') == '3') selected @endif>Operator</option>
                                                @else
                                                    <option class="text-dark" value="3" @if(old('level') == '3') selected @endif>Operator</option>
                                                @endif
                                            </select>
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
                            <th class="text-white">Level</th>
                            <th class="text-white">Status</th>
                            <th class="text-right text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userAdmins as $user)
                            @if (auth()->user()->level < 1)
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
                                                            <form action="{{url('backend/user-admins/'. $user->id .'/email-verify')}}" method="POST">
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
                                                                <form action="{{url('backend/user-admins/'. $user->id .'/phone-verify')}}" method="POST">
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
                                    <td>
                                        @switch($user->level)
                                            @case(0)
                                                <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Dev</b></span>
                                                @break
                                            @case(1)
                                                <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Administrator</b></span>
                                                @break
                                            @case(2)
                                                <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Manager</b></span>
                                                @break
                                            @default
                                                <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Operator</b></span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if ($user->status == 1)
                                            <span class="badge badge-success p-2"><i><i class="fas fa-check mr-2"></i>Active</i></span>
                                        @else
                                            <span class="badge badge-danger p-2"><i><i class="fas fa-user-alt-slash mr-2"></i>Inactive</i></span>
                                        @endif
                                    </td>
                                    <td class="text-white d-flex justify-content-end align-items-center">
                                        @if ($user->id !== auth()->user()->id)
                                            <a href="#" data-toggle="modal" data-target="#seeInfo{{$user->id}}"><i class="fas fa-info-circle fa-2x text-info"></i></a>
                                            @if (auth()->user()->level < $user->level)
                                                @if ($user->status == 0)
                                                    <a href="#" data-toggle="modal" data-target="#accVerify{{$user->id}}"><i class="fas fa-check-circle fa-2x text-success ml-3"></i></a>
                                                @else
                                                    <a href="#" data-toggle="modal" data-target="#accBan{{$user->id}}"><i class="fas fa-times-circle fa-2x text-danger ml-3"></i></a>
                                                @endif
                                            @endif
                                        @else
                                            <i class="fas fa-ellipsis-h mt-1"></i>
                                        @endif
                                    </td>
                                </tr>
                                @if ($user->id !== auth()->user()->id)
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
                                            <div class="modal-body pt-5">
                                                <div class="card card-profile mb-0">
                                                    <div class="card-avatar">
                                                        <img class="img" src="{{($user->avatar) ? asset('storage/content/avatar/' . $user->avatar) : asset('images/avatar.png')}}">
                                                    </div>
                                                    <h6 class="card-category">@if ($user->designation) {{$user->designation}} @else <i>empty</i> @endif</h6>
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
                                <!-- Modal -->
                                <!-- Modal -->
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
                                                <form action="{{url('backend/user-admins/'. $user->id .'/acc-verify')}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Verify</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <!-- Modal -->
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
                                                <form action="{{url('backend/user-admins/'. $user->id .'/acc-ban')}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-times mr-2"></i>Deactive</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                @endif
                            @else
                                @if ($user->level != 0)
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
                                                                <form action="{{url('backend/user-admins/'. $user->id .'/email-verify')}}" method="POST">
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
                                                                    <form action="{{url('backend/user-admins/'. $user->id .'/phone-verify')}}" method="POST">
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
                                        <td>
                                            @switch($user->level)
                                                @case(0)
                                                    <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Dev</b></span>
                                                    @break
                                                @case(1)
                                                    <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Administrator</b></span>
                                                    @break
                                                @case(2)
                                                    <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Manager</b></span>
                                                    @break
                                                @default
                                                    <span class="badge badge-info badge-pill text-dark py-2 px-3"><b>Operator</b></span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="badge badge-success p-2"><i><i class="fas fa-check mr-2"></i>Active</i></span>
                                            @else
                                                <span class="badge badge-danger p-2"><i><i class="fas fa-user-alt-slash mr-2"></i>Inactive</i></span>
                                            @endif
                                        </td>
                                        <td class="text-white d-flex justify-content-end align-items-center">
                                            @if ($user->id !== auth()->user()->id)
                                                <a href="#" data-toggle="modal" data-target="#seeInfo{{$user->id}}"><i class="fas fa-info-circle fa-2x text-info"></i></a>
                                                @if (auth()->user()->level < $user->level)
                                                    @if ($user->status == 0)
                                                        <a href="#" data-toggle="modal" data-target="#accVerify{{$user->id}}"><i class="fas fa-check-circle fa-2x text-success ml-3"></i></a>
                                                    @else
                                                        <a href="#" data-toggle="modal" data-target="#accBan{{$user->id}}"><i class="fas fa-times-circle fa-2x text-danger ml-3"></i></a>
                                                    @endif
                                                @endif
                                            @else
                                                <i class="fas fa-ellipsis-h mt-1"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($user->id !== auth()->user()->id)
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
                                                <div class="modal-body pt-5">
                                                    <div class="card card-profile mb-0">
                                                        <div class="card-avatar">
                                                            <img class="img" src="{{($user->avatar) ? asset('storage/content/avatar/' . $user->avatar) : asset('images/avatar.png')}}">
                                                        </div>
                                                        <h6 class="card-category">@if ($user->designation) {{$user->designation}} @else <i>empty</i> @endif</h6>
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
                                    <!-- Modal -->
                                    <!-- Modal -->
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
                                                    <form action="{{url('backend/user-admins/'. $user->id .'/acc-verify')}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Verify</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <!-- Modal -->
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
                                                    <form action="{{url('backend/user-admins/'. $user->id .'/acc-ban')}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-times mr-2"></i>Deactive</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection