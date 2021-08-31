@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title float-left m-0">Accounts</h4>
            </div>
            <div class="card-body pb-0">
                <div class="card mt-0 border border-secondary rounded">
                    <div class="card-header text-white">
                        <form action="{{route('admin.setting.accounts.print-excel')}}" id="print-excel" method="post">@csrf</form>
                        <form action="{{route('admin.setting.accounts.print-csv')}}" id="print-csv" method="post">@csrf</form>
                        <p class="my-0">
                            <span class="h3"><strong>Income Details</strong></span>
                            <span class="float-right">
                                <a href="#" role="button" class="btn btn-sm btn-success my-0 ml-0 mr-2 px-2" onclick="document.getElementById('print-excel').submit();" data-toggle="tooltip" data-placement="top" title="Download excel file"><i class="fas fa-file-excel mr-2"></i>.xlsx</a>
                                <a href="#" role="button" class="btn btn-sm btn-info m-0 px-2" onclick="document.getElementById('print-csv').submit();" data-toggle="tooltip" data-placement="top" title="Download CSV file"><i class="fas fa-file-csv mr-2"></i>.CSV</a>
                            </span>
                        </p>
                        <hr class="bg-white my-0">
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-md-3">
                            <div class="col-md">
                                <p class="h5 mb-md-0">Total Earnings: <i><span class="text-white">{{$total_income}} BDT</span></i></p>
                            </div>
                            <div class="col-md">
                                <p class="h5 mb-md-0">Total Paid: <i><span class="text-white">{{$total_paid}} BDT</span></i></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <p class="h5 mb-md-0">Net Income: <i><span class="text-white">{{$net_income}} BDT</span></i></p>
                            </div>
                        </div>
                        <div class="table-responsive border border-secondary rounded p-1">
                            <table class="table table-hover" id="dtHorizontal" cellspacing="0" width="100%">
                                <thead class="text-primary">
                                    <tr>
                                        <th></th>
                                        <th class="text-white">Request By</th>
                                        <th class="text-white">Tr No.</th>
                                        <th class="text-white">Bank Tr No.</th>
                                        <th class="text-white text-right">Amount</th>
                                        <th class="text-white text-right">Pay method</th>
                                        <th class="text-white text-right">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts as $item)
                                        <tr>
                                            <td class="text-white text-left">
                                                @if ($item->status == 'Success')
                                                    @if ($item->reqstatus == 'Submitted')
                                                        <i class="fas fa-check text-success" data-toggle="tooltip" data-placement="top" title="Submitted"></i>
                                                    @else
                                                        @if ($item->reqstatus == 'Pending')
                                                            <i class="fas fa-spinner text-warning" data-toggle="tooltip" data-placement="top" title="Pending"></i>
                                                        @else
                                                            <i class="fas fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Rejected"></i>
                                                        @endif
                                                    @endif
                                                @else
                                                    <i class="fas fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Canceled"></i>
                                                @endif
                                            </td>
                                            <td class="text-white">{{$item->byuser_name}}</td>
                                            <td class="text-white">{{$item->tx_id}}</td>
                                            <td class="text-white">{{($item->bank_tx_id == 0) ? '-=-' : $item->bank_tx_id}}</td>
                                            <td class="text-white text-right">{{$item->currency}} {{$item->amount}}</td>
                                            <td class="text-white text-right">{{$item->payment_option}}</td>
                                            <td class="text-right">
                                                <a href="#" data-toggle="modal" data-target="#orderInfo{{$item->id}}"><i class="fas fa-info-circle text-warning" data-toggle="tooltip" data-placement="top" title="Order Info"></i></a>
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection