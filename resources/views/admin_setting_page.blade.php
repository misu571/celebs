@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Settings Panel</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="modal fade" id="editAboutUs" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content dark-edition text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Edit About Us</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.company.about.update')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="about_us" id="about_us" data-editor="ck" class="form-control bg-white text-dark @error('about_us') is-invalid @enderror" rows="15" required>
                                                        @if(old('about_us')) {{ old('about_us') }} @else {{ ($companyInfo && $companyInfo->about != '0') ? $companyInfo->about : 'Write here...' }} @endif
                                                    </textarea>
                                                    @error('about_us')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <button class="btn btn-info btn-block" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-header-primary">
                                <span class="float-left"><b>About Us</b></span>
                                <span class="float-right" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="#" class="px-2" data-toggle="modal" data-target="#editAboutUs"><i class="fas fa-pen-square text-white"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="modal fade" id="editTnc" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content dark-edition text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Edit Terms and Conditions</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.company.tnc.update')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="terms_n_conditions" id="terms_n_conditions" data-editor="ck" class="form-control bg-white text-dark @error('terms_n_conditions') is-invalid @enderror" rows="15" required>
                                                        @if(old('terms_n_conditions')) {{ old('terms_n_conditions') }} @else {{ ($companyInfo && $companyInfo->tnc != '0') ? $companyInfo->tnc : 'Write here...' }} @endif
                                                    </textarea>
                                                    @error('terms_n_conditions')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <button class="btn btn-info btn-block" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-header-success">
                                <span class="float-left"><b>Terms and Conditions</b></span>
                                <span class="float-right" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="#" class="px-2" data-toggle="modal" data-target="#editTnc"><i class="fas fa-pen-square text-white"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="modal fade" id="editPpy" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content dark-edition text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Edit Privacy Policy</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.company.ppy.update')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="privacy_policy" id="privacy_policy" data-editor="ck" class="form-control bg-white text-dark @error('privacy_policy') is-invalid @enderror" rows="15" required>
                                                        @if(old('privacy_policy')) {{ old('privacy_policy') }} @else {{ ($companyInfo && $companyInfo->ppy != '0') ? $companyInfo->ppy : 'Write here...' }} @endif
                                                    </textarea>
                                                    @error('privacy_policy')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <button class="btn btn-info btn-block" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-header-warning">
                                <span class="float-left"><b>Privacy Policy</b></span>
                                <span class="float-right" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="#" class="px-2" data-toggle="modal" data-target="#editPpy"><i class="fas fa-pen-square text-white"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="modal fade" id="editFAQ" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content dark-edition text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Edit FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.company.faq.update')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="faq" id="faq" data-editor="ck" class="form-control bg-white text-dark @error('faq') is-invalid @enderror" rows="15" required>
                                                        @if(old('faq')) {{ old('faq') }} @else {{ ($companyInfo && $companyInfo->faq != '0') ? $companyInfo->faq : 'Write here...' }} @endif
                                                    </textarea>
                                                    @error('faq')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <button class="btn btn-info btn-block" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-header-info">
                                <span class="float-left"><b>Frequently Asked Questions</b></span>
                                <span class="float-right" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <a href="#" class="px-2" data-toggle="modal" data-target="#editFAQ"><i class="fas fa-pen-square text-white"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div id="uploadimageModal" class="modal" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row text-center">
                                                <div class="col">
                                                    <div id="image_banner_demo"></div>
                                                </div>
                                                <button class="btn btn-primary text-capitalize mx-auto crop_banner_image"><h6 class="m-0">Crop & Upload Image</h6></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-header-warning">
                                <span class="float-left"><b>Banners</b></span>
                                <span class="float-right" data-toggle="tooltip" data-placement="top" title="Add new banner">
                                    <div class="img_div">
                                        <label class="" for="banner">
                                            <i class="fas fa-plus text-white"></i>
                                            <input type="file" class="custom-file-input d-none" id="banner" name="banner" required>
                                        </label>
                                    </div>
                                </span>
                            </div>
                            <div class="card-body pb-0">
                                <table id="dt-vertical-scroll-1" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr><th></th><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>
                                                    <img class="w-100 border border-white rounded" src="{{asset('storage/content/banners/' . $banner->banner)}}" alt="">
                                                </td>
                                                <td>
                                                    <a href="" data-toggle="modal" data-target="#bannerDelete{{$banner->id}}">
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="bannerDelete{{$banner->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                    <div class="modal-content dark-edition">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Delete banner</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <h5 class="mb-0">Delete this banner?</h5>
                                                            <form action="{{route('admin.setting.banner.remove', ['id' => $banner->id])}}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-times mr-2"></i>Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="modal fade" id="addLink" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content dark-edition text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Add New Link</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.setting.social_link.add')}}" method="post">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <select class="form-control @error('type') is-invalid @enderror" name="type" required>
                                                                <option disabled @if(!old('type')) selected @endif>Select Type...</option>
                                                                <option class="text-dark" value="Facebook" @if(old('type') == 'Facebook') selected @endif>Facebook</option>
                                                                <option class="text-dark" value="Twitter" @if(old('type') == 'Twitter') selected @endif>Twitter</option>
                                                                <option class="text-dark" value="Instagram" @if(old('type') == 'Instagram') selected @endif>Instagram</option>
                                                                <option class="text-dark" value="Linkedin" @if(old('type') == 'Linkedin') selected @endif>Linkedin</option>
                                                            </select>
                                                            @error('type')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" @if(old('link')) value="{{ old('link') }}" @else placeholder="Link" @endif required>
                                                            @error('link')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <button class="btn btn-info btn-block" type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-header-info">
                                <span class="float-left"><b>Social link</b></span>
                                <span class="float-right" data-toggle="tooltip" data-placement="top" title="Add social link">
                                    <a href="#" class="px-2" data-toggle="modal" data-target="#addLink"><i class="fas fa-plus text-white"></i></a>
                                </span>
                            </div>
                            <div class="card-body pb-0">
                                <table id="dt-vertical-scroll-2" class="table mb-0" cellspacing="0" width="100%">
                                    <thead>
                                        <tr><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($social_links as $social_link)
                                            <tr>
                                                <td>
                                                    <a href="" data-toggle="modal" data-target="#changeLink{{$social_link->id}}">
                                                        <div class="row" data-toggle="tooltip" data-placement="top" title="Click to edit">
                                                            <div class="col-2">
                                                                @switch($social_link->type)
                                                                    @case('Facebook')
                                                                        <i class="fab fa-facebook-f text-white"></i>
                                                                        @break
                                                                    @case('Twitter')
                                                                        <i class="fab fa-twitter text-white"></i>
                                                                        @break
                                                                    @case('Instagram')
                                                                        <i class="fab fa-instagram text-white"></i>
                                                                        @break
                                                                    @default
                                                                        <i class="fab fa-linkedin-in text-white"></i>
                                                                @endswitch
                                                            </div>
                                                            <div class="col-10">
                                                                <p class="text-muted mb-0"><i>{{(($social_link->link == '0') ? 'Click to edit' : $social_link->link)}}</i></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="changeLink{{$social_link->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content dark-edition text-left">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Edit / Delete Link</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    <form action="{{route('admin.setting.social_link.update', ['id' => $social_link->id])}}" method="post">
                                                                        @csrf
        
                                                                        <div class="form-group pb-0">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text">
                                                                                        @switch($social_link->type)
                                                                                            @case('Facebook')
                                                                                                <i class="fab fa-facebook-f text-white"></i>
                                                                                                @break
                                                                                            @case('Twitter')
                                                                                                <i class="fab fa-twitter text-white"></i>
                                                                                                @break
                                                                                            @case('Instagram')
                                                                                                <i class="fab fa-instagram text-white"></i>
                                                                                                @break
                                                                                            @default
                                                                                                <i class="fab fa-linkedin-in text-white"></i>
                                                                                        @endswitch
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" @if($social_link->link == '0' || old('link') == '0') placeholder="Input link" @else value="{{(old('link') ?? $social_link->link)}}" @endif required>
                                                                                <div class="input-group-prepend">
                                                                                    <button class="btn btn-info rounded-right m-0 py-0" type="submit">Update</button>
                                                                                </div>
                                                                            </div>
                                                                            @error('link')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="col-3 pl-0">
                                                                    <form action="{{route('admin.setting.social_link.remove', ['id' => $social_link->id])}}" method="post">
                                                                        @csrf

                                                                        <div class="form-group pb-0">
                                                                            <button class="btn btn-danger rounded m-0" type="submit">Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="modal fade" id="addVacancy" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content dark-edition text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Add New Vacancy</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.setting.vacancy.add')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" @if(old('position')) value="{{ old('position') }}" @else placeholder="Position" @endif required>
                                                    @error('position')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="post_details" id="post_details" data-editor="ck" class="form-control bg-white text-dark @error('post_details') is-invalid @enderror" rows="10" required>{!! old('post_details') !!}</textarea>
                                                    @error('post_details')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="active" id="active" @if(old('active')) checked @endif>
                                                    <label class="custom-control-label" for="active">Active</label>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <button class="btn btn-info btn-block" type="submit">Add New</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-header-success">
                                <span class="float-left"><b>Vacancy</b></span>
                                <span class="float-right" data-toggle="tooltip" data-placement="top" title="Add new vacancy">
                                    <a href="#" class="px-2" data-toggle="modal" data-target="#addVacancy"><i class="fas fa-plus text-white"></i></a>
                                </span>
                            </div>
                            <div class="card-body pb-0">
                                <table id="dt-vertical-scroll-3" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vacancies as $vacancy)
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            @if ($vacancy->active)
                                                                <i class="fas fa-check-circle text-white"></i>
                                                            @else
                                                                <i class="fas fa-times text-white"></i>
                                                            @endif
                                                            <span class="font-weight-bold ml-3">
                                                                {{ $vacancy->position }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="modal fade" id="updateVacancy{{ $vacancy->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                    <div class="modal-content dark-edition text-left">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title text-white">Update Vacancy</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('admin.setting.vacancy.update', ['id' => $vacancy->id])}}" method="post">
                                                                                @csrf
                                                                                
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control @error('position' . $vacancy->id) is-invalid @enderror" name="position{{ $vacancy->id }}" value="{{ old('position' . $vacancy->id) ?? $vacancy->position }}">
                                                                                    @error('position' . $vacancy->id)
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ str_replace("position" . $vacancy->id,"Position",$message) }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <textarea name="post_details{{ $vacancy->id }}" id="post_details{{ $vacancy->id }}" data-editor="ck" class="form-control bg-white text-dark @error('post_details' . $vacancy->id) is-invalid @enderror" rows="10" required>
                                                                                        {{ old('post_details' . $vacancy->id) ?? $vacancy->details }}
                                                                                    </textarea>
                                                                                    @error('post_details' . $vacancy->id)
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ str_replace("post details" . $vacancy->id,"Post Details",$message) }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="active{{ $vacancy->id }}" @if($vacancy->active) checked @endif>
                                                                                    <label class="custom-control-label" for="active">Active</label>
                                                                                </div>
                                                                                <div class="row mt-4">
                                                                                    <div class="col">
                                                                                        <button class="btn btn-info btn-block" type="submit">Update</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a data-toggle="modal" href="#updateVacancy{{ $vacancy->id }}" role="button" class="btn btn-link m-0 p-0"><i class="fas fa-pen-square text-warning"></i></a>
                                                            <a href="#" role="button" class="btn btn-link m-0 p-0" data-toggle="modal" data-target="#deleteVacancy{{ $vacancy->id }}"><i class="fas fa-window-close text-danger ml-2"></i></a>
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
</div>
@endsection