@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <!-- Picture modal -->
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
        <!-- Picture modal -->

        <div class="card">
            <div class="card-header card-header-primary d-flex justify-content-between">
                <h4 class="card-title mb-0">Talent Details</h4>
            </div>

            <div class="card-body">
                <a href="{{route('admin.userAcc.talents')}}" role="button" class="btn btn-link btn-lg text-capitalize px-0 m-0" data-toggle="tooltip" data-placement="right" title="Back to talent list">
                    <i class="fas fa-angle-left mr-2"></i> Go Back
                </a>
                
                <div class="card card-profile">
                    <div class="card-avatar img_div mx-auto">
                        <label class="m-0" for="avatar">
                            <span id="profile_pic">
                                <img src="{{($userInfo->avatar) ? asset('storage/content/avatar/' . $userInfo->avatar) : asset('images/avatar.png')}}" alt="Avatar" id="uploaded_image" class="image img-responsive rounded-circle">
                            </span>
                            <div class="overlay_img m-0">
                                <div class="text text-center text-dark"><p class="h6 m-0 font-weight-bolder">Click to change profile image</p></div>
                            </div>
                            <input type="file" class="custom-file-input d-none" id="avatar" name="avatar" required>
                        </label>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$userInfo->name}}</h4>
                        <p class="card-description text-light mb-0"><b>{{$userInfo->category}}</b></p>
                    </div>
                </div>
                <div class="card mt-0 border border-secondary rounded">
                    <div class="card-header text-white">
                        <p class="h3 my-0">Income Details</p>
                        <hr class="my-0">
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-md-3">
                            <div class="col-md">
                                <p class="h5 mb-md-0">Total Earnings: <i>{{$userInfo->total_income}}</i></p>
                            </div>
                            <div class="col-md">
                                <p class="h5 mb-md-0">Income Ratio: <i>{{$userInfo->cut_ratio}}%</i></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <p class="h5 mb-md-0">Total Withdrawal: <i>{{$userInfo->total_withdrawal}}</i></p>
                            </div>
                            <div class="col-md">
                                <p class="h5 mb-md-0">Amount Left: <i>{{$userInfo->total_income - $userInfo->total_withdrawal}}</i></p>
                            </div>
                        </div>
                        <div class="table-responsive border border-secondary rounded p-1">
                            <table class="table table-hover" id="dtHorizontal" cellspacing="0" width="100%">
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
                                    @forelse ($accInfo as $item)
                                        <tr class="text-white">
                                            <td class="text-left">
                                                @if ($item->request_details_status == 'Submitted') <i class="fas fa-check text-success" data-toggle="tooltip" data-placement="top" title="Submitted"></i> @else @if ($item->status == 'Pending') <i class="fas fa-spinner text-warning" data-toggle="tooltip" data-placement="top" title="Pending"></i> @else <i class="fas fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Rejected"></i> @endif @endif
                                            </td>
                                            <td>{{$item->users_name}}</td>
                                            <td>{{$item->request_details_occasion}}</td>
                                            <td>{{$item->ratio}}</td>
                                            <td>{{$item->currency}} {{$item->income}}</td>
                                            <td class="text-right">
                                                <a href="#" data-toggle="modal" data-target="#orderInfo{{$item->id}}" class="mr-3"><i class="fas fa-info-circle text-warning" data-toggle="tooltip" data-placement="top" title="Order Info"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#requestInfo{{$item->id}}"><i class="fas fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Request Info"></i></a>
                                                <div class="modal fade" id="orderInfo{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content dark-edition text-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Order Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span class="text-white" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <p class="mb-0"><b>Transaction No.:</b> <span class="ml-1">{{$item->orders_tx_id}}</span></p>
                                                                    @if ($item->orders_bank_tx_id != 0)
                                                                        <p class="mb-0"><b>Bank transaction No.:</b> <span class="ml-1">{{$item->orders_bank_tx_id}}</span></p>
                                                                    @endif
                                                                    <p class="mb-0"><b>Amount:</b> <span class="ml-1">{{$item->orders_currency}} {{$item->orders_amount}}</span></p>
                                                                    <p class="mb-0"><b>Payment method:</b> <span class="ml-1">{{$item->orders_payment_option}}</span></p>
                                                                    <p class="mb-0"><b>Status:</b> <span class="ml-1">{{$item->orders_status}}</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="requestInfo{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content dark-edition text-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Request Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span class="text-white" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <p class="mb-0"><b>Booked by (name):</b> <span class="ml-1">{{$item->users_name}}</span></p>
                                                                    <p class="mb-0"><b>Booked by (email):</b> <span class="ml-1">{{$item->users_email}}</span></p>
                                                                    <p class="mb-0"><b>Requested for:</b> <span class="ml-1">{{$item->request_details_to}}</span></p>
                                                                    @if ($item->request_details_from != 0)
                                                                        <p class="mb-0"><b>Requested from:</b> <span class="ml-1">{{$item->request_details_from}}</span></p>
                                                                    @endif
                                                                    <p class="mb-0"><b>Pronoun:</b> <span class="ml-1">{{$item->request_details_pronoun}}</span></p>
                                                                    <p class="mb-0"><b>Occasion:</b> <span class="ml-1">{{$item->request_details_occasion}}</span></p>
                                                                    <p class="mb-0"><b>Instruction:</b> <span class="ml-1">{{$item->request_details_instruction}}</span></p>
                                                                    <p class="mb-0"><b>Status:</b> <span class="ml-1">{{$item->request_details_status}}</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-white"><td><i>No data</i></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mt-0 border border-secondary rounded">
                    <div class="card-header text-white">
                        <p class="h3 my-0">Personal Details</p>
                        <hr class="my-0">
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{route('admin.talents.profile-edit', ['id' => $userInfo->user_id])}}" method="post">
                            @csrf
                            
                            <div class="row mb-md-3">
                                <div class="col-md">
                                    <p class="h5 mb-md-0"><span class="text-white mr-2">Email:</span>{{$userInfo->email}}</p>
                                </div>
                            </div>
                            <div class="row mb-md-3">
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-name">Name :</span>
                                        </div>
                                        <input type="text" name="name" id="name" class="form-control" value="{{$userInfo->name}}" placeholder="Name" aria-label="Name" aria-describedby="basic-name" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-username">Username :</span>
                                        </div>
                                        <input type="text" name="username" id="username" class="form-control" value="{{$userInfo->username}}" placeholder="Username" aria-label="Username" aria-describedby="basic-username" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-md-3">
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-phone">Phone :</span>
                                        </div>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{$userInfo->phone}}" placeholder="Phone" aria-label="Phone" aria-describedby="basic-phone">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-secondary rounded-right" data-toggle="tooltip" data-placement="top" title="Verify Phone">
                                                <input type="checkbox" name="phone_verified_at" @if ($userInfo->phone_verified_at) checked @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-dob">Date of Birth :</span>
                                        </div>
                                        <input type="date" name="dob" id="dob" class="form-control" value="{{$userInfo->dob}}" placeholder="Date of Birth" aria-label="Date of Birth" aria-describedby="basic-dob">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group mt-0">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text text-white" for="gender">Gender :</label>
                                        </div>
                                        <select class="custom-select" name="gender" id="gender">
                                            <option disabled selected>Choose...</option>
                                            <option class="text-dark" value="Male" @if ($userInfo->gender == 'Male') selected @endif>Male</option>
                                            <option class="text-dark" value="Female" @if ($userInfo->gender == 'Female') selected @endif>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-md-3">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-address">Address :</span>
                                        </div>
                                        <input type="text" name="address" id="address" class="form-control" value="{{$userInfo->address}}" placeholder="Address" aria-label="Address" aria-describedby="basic-address">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-city">City :</span>
                                        </div>
                                        <input type="text" name="city" id="city" class="form-control" value="{{$userInfo->city}}" placeholder="City" aria-label="City" aria-describedby="basic-city">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-country">Country :</span>
                                        </div>
                                        <input type="text" name="country" id="country" class="form-control" value="{{$userInfo->country}}" placeholder="Country" aria-label="Country" aria-describedby="basic-country">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-post_code">Postal Code :</span>
                                        </div>
                                        <input type="text" name="post_code" id="post_code" class="form-control" value="{{$userInfo->post_code}}" placeholder="Postal Code" aria-label="Postal Code" aria-describedby="basic-post_code">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-0 mt-4">Update</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-0 border border-secondary rounded">
                    <div class="card-header text-white">
                        <p class="h3 my-0">Profile Information</p>
                        <hr class="my-0">
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{route('admin.talents.profile-update', ['id' => $userInfo->user_id])}}" method="post">
                            @csrf
                            
                            <div class="row mb-md-3">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-bio">BIO :</span>
                                        </div>
                                        <textarea class="form-control" id="about_me" name="about_me" rows="3" maxlength="150" placeholder="Write here..." aria-label="BIO" aria-describedby="basic-bio">{{$userInfo->about_me}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-vid_price">Video price :</span>
                                        </div>
                                        <input type="text" name="vid_price" id="vid_price" class="form-control" value="{{$userInfo->vid_price}}" placeholder="Video price" aria-label="Video price" aria-describedby="basic-vid_price">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-cut_ratio">Cut ratio :</span>
                                        </div>
                                        <input type="text" name="cut_ratio" id="cut_ratio" class="form-control" value="{{$userInfo->cut_ratio}}" placeholder="Cut ratio" aria-label="Cut ratio" aria-describedby="basic-cut_ratio">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group mt-0">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text text-white" for="category">Category :</label>
                                        </div>
                                        <select class="custom-select" name="category" id="category">
                                            <option disabled selected>Choose...</option>
                                            @foreach ($categories as $item)
                                                <option class="text-dark" value="{{$item->id}}" @if ($userInfo->category_id == $item->id) selected @endif>{{$item->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-0 mt-4">Update</button>
                        </form>
                    </div>
                </div>
                <div class="card my-0 border border-secondary rounded">
                    <div class="card-header text-white">
                        <p class="h3 my-0">Account Information</p>
                        <hr class="my-0">
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{route('admin.talents.bank-update', ['id' => $userInfo->user_id])}}" method="post">
                            @csrf
                            
                            <div class="row mb-md-3">
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-bank_name">Bank name :</span>
                                        </div>
                                        <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{$userInfo->bank_name}}" placeholder="Bank name" aria-label="Bank name" aria-describedby="basic-bank_name" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-branch_name">Branch name :</span>
                                        </div>
                                        <input type="text" name="branch_name" id="branch_name" class="form-control" value="{{$userInfo->branch_name}}" placeholder="Branch name" aria-label="Branch name" aria-describedby="basic-branch_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-md-3">
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-acc_name">Account name :</span>
                                        </div>
                                        <input type="text" name="acc_name" id="acc_name" class="form-control" value="{{$userInfo->acc_name}}" placeholder="Account name" aria-label="Account name" aria-describedby="basic-acc_name" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-acc_id">Account number :</span>
                                        </div>
                                        <input type="text" name="acc_id" id="acc_id" class="form-control" value="{{$userInfo->acc_id}}" placeholder="Account number" aria-label="Account number" aria-describedby="basic-acc_id" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white pl-0" id="basic-swift_code">Swift code :</span>
                                        </div>
                                        <input type="text" name="swift_code" id="swift_code" class="form-control" value="{{$userInfo->swift_code}}" placeholder="Swift code" aria-label="Swift code" aria-describedby="basic-swift_code">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-0 mt-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection