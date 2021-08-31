@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Modal -->
    <div class="modal fade" id="addPromoType" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content dark-edition">
                <div class="modal-header">
                    <h5 class="modal-title text-white">New Promo Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="m-0" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control rounded-left" name="promo_type" placeholder="New Promo Type" aria-describedby="promo-type" required>
                            <div class="input-group-append">
                                <button class="btn btn-default m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="promo-type">Add New</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="container-fluid">
        <button class="btn btn-primary waves-effect d-block" type="button" data-toggle="collapse" data-target="#collapseExample-30" aria-expanded="false" aria-controls="collapseExample-30">
            <i class="material-icons mr-2">loupe</i>
            Create New Promo
        </button>
        <div class="collapse" id="collapseExample-30">
            <div class="card mt-2">
                <div class="card-body pt-4">
                    <form action="{{route('admin.setting.promotion.create')}}" class="m-0" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating" for="promo_title">Title</label>
                                    <input type="text" name="promo_title" id="promo_title" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating" for="promo_code">Code</label>
                                    <input type="text" name="promo_code" id="promo_code" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="" for="promo_valid_from">Valid From</label>
                                    <input type="date" name="promo_valid_from" id="promo_valid_from" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="" for="promo_valid_until">Valid Until</label>
                                    <input type="date" name="promo_valid_until" id="promo_valid_until" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="bmd-label-floating" for="promo_uses_limit">Uses Limit</label>
                                    <input type="number" name="promo_uses_limit" id="promo_uses_limit" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating" for="promo_details">Details</label>
                                    <input type="text" name="promo_details" id="promo_details" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="custom-file border rounded">
                                        <input type="file" class="custom-file-input" id="promo_thumbnail" name="promo_thumbnail">
                                        <label class="custom-file-label mb-0" for="promo_thumbnail"><strong>Select Thumbnail</strong></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-auto">
                                <label class="mr-2">Discount Type:</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="promo_discount_type-1" name="promo_discount_type" class="custom-control-input" value="Cash" required>
                                    <label class="custom-control-label my-auto" for="promo_discount_type-1">Cash</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="promo_discount_type-2" name="promo_discount_type" class="custom-control-input" value="Item" required>
                                    <label class="custom-control-label my-auto" for="promo_discount_type-2">Item</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 d-none" id="promo_type_cash">
                            <div class='col-md-3'>
                                <div class='form-group'>
                                    <label class='bmd-label-floating' for='promo_base_value'>Base Value</label>
                                    <input type='number' name='promo_base_value' id='promo_base_value' class='form-control'>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='form-group'>
                                    <label class="bmd-label-floating" for="promo_percent">Percent</label>
                                    <input type="number" name="promo_percent" id="promo_percent" class="form-control">
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='form-group'>
                                    <label class="bmd-label-floating" for="promo_max_value">Max Value</label>
                                    <input type="number" name="promo_max_value" id="promo_max_value" class="form-control">
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='form-group'>
                                    <label class="bmd-label-floating" for="promo_min_value">Min Value</label>
                                    <input type="number" name="promo_min_value" id="promo_min_value" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 d-none" id="promo_type_item">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating" for="promo_search">Search</label>
                                    <input type="text" class="form-control" id="promo_search" name="promo_search">
                                    <select class="form-control custom-select text-light py-0 d-none" id="promo_search_result" name="promo_search_result"></select>
                                    <input type="hidden" name="promo_typename" id="promo_typename">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <select class="form-control custom-select text-light" id="promo_service" name="promo_service">
                                        <option selected disabled>Choose...</option>
                                        <option class="text-dark" value="1">Video</option>
                                        <option class="text-dark" value="2">Chat</option>
                                        <option class="text-dark" value="3">All</option>
                                    </select>
                                    <input type="hidden" name="promo_typeservice" id="promo_typeservice">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary btn-sm my-0" id="promo_search_add" type="button">Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7" id="promo_search_select"></div>
                        </div>
                        <button class="btn btn-primary float-right mt-2" id="promo_typeItem_submit" type="submit">Create New Promotion</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title mb-0">Promotion List</h4>
            </div>
            <div class="card-body">
                <table class="table" id="dtHorizontal" cellspacing="0" width="100%">
                    <thead class="text-primary">
                        <tr>
                            <th class="text-white">Title</th>
                            <th class="text-white">Code</th>
                            <th class="text-white">Image</th>
                            <th class="text-white">Type</th>
                            <th class="text-white">Status</th>
                            <th class="text-right text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promotions as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{$item->code}}</td>
                            <td><img class="img-fluid" src="{{($item->thumbnail) ? asset('storage/content/img/' . $item->thumbnail) : asset('images/stock_video_pic.jpg')}}" alt="avatar" width="50" height="50"></td>
                            <td>{{$item->discount_type}}</td>
                            <td>@if (intval(date_diff(date_create($item->valid_from),date_create(date('Y-m-d H:i:s', time())))->format("%R%d%H%i%s")) > 0 && intval(date_diff(date_create($item->valid_until),date_create(date('Y-m-d H:i:s', time())))->format("%R%d%H%i%s")) < 1) <span class="badge badge-success badge-pill px-3 py-2"><i>Enable</i></span> @else <span class="badge badge-danger badge-pill px-3 py-2"><i>Disable</i></span> @endif</td>
                            <td class="text-right d-block">
                                <a href="#" data-toggle="modal" data-target="#seeInfo{{$item->id}}"><i class="fas fa-info-circle fa-2x text-info"></i></a>
                                <a href="#" data-toggle="modal" data-target="#accVerify{{$item->id}}"><i class="fas fa-check-circle fa-2x text-success ml-2"></i></a>
                                <a href="#" data-toggle="modal" data-target="#accBan{{$item->id}}"><i class="fas fa-times-circle fa-2x text-danger ml-2"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection