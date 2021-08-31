@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title mb-0">Client Request List</h4>
            </div>
            <div class="card-body">
                <table class="table" id="dtHorizontal" cellspacing="0" width="100%">
                    <thead class="text-primary">
                        <tr>
                            <th class="text-white">Request By</th>
                            <th class="text-white">Request To</th>
                            <th class="text-white">Payment Info</th>
                            <th class="text-white">Status</th>
                            <th class="text-right text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $item)
                        <tr>
                            <td class="text-white">{{$item->usubmit_name}}</td>
                            <td class="text-white">{{$item->utalent_name}}</td>
                            <td class="text-white"><a href="#" data-toggle="modal" data-target="#payment{{$item->payment_id}}" class="btn-link" role="button"><i class="far fa-hand-point-right mr-2"></i>Details</a></td>
                            <td class="text-white">
                                @if ($item->status == 'NOT Verified')
                                    <span class="badge badge-light p-2"><i><i class="fas fa-exclamation mr-2"></i>{{$item->status}}</i></span>
                                @elseif ($item->status == 'Pending')
                                    <span class="badge badge-warning p-2"><i><i class="fas fa-exclamation-triangle mr-2"></i>{{$item->status}}</i></span>
                                @elseif ($item->status == 'Rejected')
                                    <span class="badge badge-danger p-2"><i><i class="fas fa-ban mr-2"></i>{{$item->status}}</i></span>
                                @else
                                    <span class="badge badge-success p-2"><i><i class="fas fa-check-circle mr-2"></i>{{$item->status}}</i></span>
                                @endif
                            </td>
                            <td class="text-right text-white d-flex justify-content-end align-items-center py-0">
                                <a href="#" data-toggle="modal" data-target="#requestDetail{{$item->id}}"><i class="fas fa-info-circle fa-2x text-info"></i></a>
                                @if ($item->status == 'NOT Verified')
                                    <a href="#" data-toggle="modal" data-target="#requestVerify{{$item->id}}"><i class="fas fa-check-circle fa-2x text-success ml-3"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#requestCancle{{$item->id}}"><i class="fas fa-times-circle fa-2x text-danger ml-3"></i></a>
                                @elseif ($item->status == 'Pending')
                                    <a href="#" data-toggle="modal" data-target="#requestUnverify{{$item->id}}"><i class="fas fa-exclamation-circle fa-2x text-light ml-3"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#requestCancle{{$item->id}}"><i class="fas fa-times-circle fa-2x text-danger ml-3"></i></a>
                                @endif
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="payment{{$item->payment_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Payment Details</h5>
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
                        <!-- Modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="requestVerify{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Request Verification</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                        <h5 class="mb-0">Verify this request?</h5>
                                        <form action="{{url('backend/client-request/'. $item->id .'/verify')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Verify</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="requestUnverify{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Unverify Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                        <h5 class="mb-0">Unverify this request?</h5>
                                        <form action="{{url('backend/client-request/'. $item->id .'/unverify')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning rounded-pill ml-2"><i class="fas fa-exclamation mr-2"></i>Unverify</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="requestCancle{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content dark-edition">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Cancle Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="text-white" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                        <h5 class="mb-0">Cancle this request?</h5>
                                        <form action="{{url('backend/client-request/'. $item->id .'/cancle')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-times mr-2"></i>Cancle</button>
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