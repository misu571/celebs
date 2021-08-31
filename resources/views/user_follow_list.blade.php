@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5">
        <div class="card text-white special-color-dark texture rounded-lg texture">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                <h3 class="m-0">Talent Following</h3>
            </div>
            <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-sm text-white mb-0" id="dtBasicExample-11">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($followings as $data)
                                <tr>
                                    <td class="d-flex justify-content-between align-items-center bg-light text-dark rounded-pill border-0 p-0 my-1">
                                        <div class="avatar d-flex justify-content-between align-items-center">
                                            <img src="{{($data->avatar) ? asset('storage/content/avatar/' . $data->avatar) : asset('images/avatar.png')}}" class="rounded-circle z-depth-1 img-fluid" width="45" height="45">
                                            <p class="mb-0 ml-3"><b>{{$data->name}}</b></p>
                                            <p class="mb-0 ml-3"><b>{{$data->category}}</b></p>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{route('talent.profile', ['username' => $data->username])}}" role="button" class="btn btn-dark rounded-pill text-capitalize px-4"><i>Go to profile</i></a>
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
</section>
@endsection