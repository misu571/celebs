@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <!-- Modal -->
                    <div class="modal fade" id="addDesignation" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content dark-edition">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Add New Designation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="text-white" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.setting.company.degcreate')}}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="designation" placeholder="Name" required>
                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary btn-sm" type="submit">Create</button>
                                            </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="card-header card-header-primary">
                        <h4 class="card-title float-left m-0">Designation List</h4>
                        <a href="#" class="float-right" data-toggle="modal" data-target="#addDesignation"><i class="fas fa-plus-square mr-1"></i>New</a>
                    </div>
                    <div class="card-body pb-0">
                        <table class="table" cellspacing="0" width="100%">
                            <thead class="text-primary">
                                <tr>
                                    {{-- <th class="text-white">#</th> --}}
                                    <th class="text-white">Name</th>
                                    {{-- <th class="text-right text-white">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($designations as $data)
                                    <tr>
                                        {{-- <td class="text-white">{{$data->serial}}</td> --}}
                                        <td class="text-white">{{$data->designation}}</td>
                                        {{-- <td class="text-right text-white">{{$data->id}}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
</div>
@endsection