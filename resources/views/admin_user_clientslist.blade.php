@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Client User List</h4>
                {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
            </div>
            <div class="card-body pb-0">
                <table class="table" id="dtHorizontal" cellspacing="0" width="100%">
                    <thead class="text-primary">
                        <tr>
                            <th class="text-white">Name</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">Phone</th>
                            <th class="text-white">Status</th>
                            <th class="text-right text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userClients as $user)
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
                                                    <form action="{{url('backend/user-clients/'. $user->id .'/email-verify')}}" method="POST">
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
                                                        <form action="{{url('backend/user-clients/'. $user->id .'/phone-verify')}}" method="POST">
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
                                @if ($user->status == 1)
                                    <span class="badge badge-success rounded-pill p-2"><i><i class="fas fa-check mr-2"></i>Active</i></span>
                                @else
                                    <span class="badge badge-danger rounded-pill p-2"><i><i class="fas fa-user-alt-slash mr-2"></i>Inactive</i></span>
                                @endif
                            </td>
                            <td class="text-white d-flex justify-content-end align-items-center">
                                <a href="#" data-toggle="modal" data-target="#seeInfo{{$user->id}}"><i class="fas fa-info-circle fa-2x text-info mr-3"></i></a>
                                @if ($user->status == 0)
                                    <a href="#" data-toggle="modal" data-target="#accVerify{{$user->id}}"><i class="fas fa-check-circle fa-2x text-success"></i></a>
                                @else
                                    <a href="#" data-toggle="modal" data-target="#accBan{{$user->id}}"><i class="fas fa-times-circle fa-2x text-danger"></i></a>
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
                                    <div class="modal-body pt-5">
                                        <div class="card card-profile mb-0">
                                            <div class="card-avatar mb-3">
                                                <img class="img" src="{{($user->avatar) ? asset('storage/content/avatar/' . $user->avatar) : asset('images/avatar.png')}}">
                                            </div>
                                            <h4 class="card-title text-white">{{$user->name}}</h4>
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
                                        <form action="{{url('backend/user-clients/'. $user->id .'/acc-verify')}}" method="POST">
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
                                        <form action="{{url('backend/user-clients/'. $user->id .'/acc-ban')}}" method="POST">
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