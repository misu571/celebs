@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5 px-md-5">
        <div class="card special-color-dark roundcard">
            <div class="card-body">
                <div class="text-center">
                    <img class="rounded-circle img-fluid img-thumbnail mb-1" src="{{($talent->avatar) ? asset('storage/content/avatar/' . $talent->avatar) : asset('images/avatar.png')}}" alt="Talent avatar" width="100" height="100">
                    <p class="h6 mb-5">New Request To<br><span class="h4 font-italic">{{$talent->name}}</span></p>
                    <p class="h5 mb-0">Request for</p>
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <div class="text-center">
                        <button id="forElse" class="btn rounded-circle p-3 btn-special gcolor active" style="width: 60px;height: 60px;">
                            <i class="fas fa-gift fa-2x"></i>
                        </button>
                        <p class="mb-0"><b>Someone else</b></p>
                    </div>
                    <div class="mx-4"></div>
                    <div class="text-center">
                        <button id="forMe" class="btn rounded-circle p-3 btn-special border border-light bdrthick" style="width: 60px;height: 60px;">
                            <i class="fas fa-user fa-2x"></i>
                        </button>
                        <p class="mb-0"><b>Myself</b></p>
                    </div>
                </div>
                <div class="row">
                    <form action="{{route('user.transaction.pay', ['username' => $talent->username])}}" method="POST" class="col-md-5 px-1 mx-auto needs-validation">
                        @csrf
                        
                        <div class="px-3 pb-3 pt-1 mb-4 border border-light rounded-lg">
                            <p class="h5 px-2 mb-2 text-center">Request Details</p>
                            <div class="md-form mb-4">
                                <input type="text" name="to" id="to" value="{{Request::get('to')}}" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg" required>
                                <label class="text-white" for="to">To</label>
                            </div>
                            <div class="md-form mb-4 animated" id="fromDiv">
                                <input type="text" name="from" id="from" value="{{(Request::get('from') == '0') ? '' : Request::get('from')}}" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg" required>
                                <label class="text-white" for="from">From</label>
                            </div>
                            <div class="md-form mb-4">
                                <select class="form-control form-control-lg bg-dark text-light border-0 rounded-lg" name="pronoun" required>
                                    <option disabled selected>Choose pronoun</option>
                                    <option value="She/Her" @if(Request::get('pronoun') == 'She/Her') selected @endif>She/Her: "Wish her a happy birthday"</option>
                                    <option value="He/Him" @if(Request::get('pronoun') == 'He/Him') selected @endif>He/Him: "Wish Him a happy birthday"</option>
                                    <option value="They/Them" @if(Request::get('pronoun') == 'They/Them') selected @endif>They/Them: "Wish Them a happy birthday"</option>
                                    <option value="Other" @if(Request::get('pronoun') == 'Other') selected @endif>Other: - will clarify in the instruction</option>
                                </select>
                            </div>
                            <div class="md-form mb-4">
                                <select class="form-control form-control-lg bg-dark text-light border-0 rounded-lg" name="occasion" required>
                                    <option disabled selected>Select occasion</option>
                                    <option value="None" @if(Request::get('occasion') == 'None') selected @endif>None</option>
                                    <option value="Birthday" @if(Request::get('occasion') == 'Birthday') selected @endif>Birthday</option>
                                    <option value="Anniversary" @if(Request::get('occasion') == 'Anniversary') selected @endif>Anniversary</option>
                                    <option value="Give Thanks" @if(Request::get('occasion') == 'Give Thanks') selected @endif>Give Thanks</option>
                                    <option value="Wedding" @if(Request::get('occasion') == 'Wedding') selected @endif>Wedding</option>
                                    <option value="Gift" @if(Request::get('occasion') == 'Gift') selected @endif>Gift</option>
                                    <option value="Announcement" @if(Request::get('occasion') == 'Announcement') selected @endif>Announcement</option>
                                    <option value="Roast" @if(Request::get('occasion') == 'Roast') selected @endif>Roast</option>
                                    <option value="Get advice" @if(Request::get('occasion') == 'Get advice') selected @endif>Get advice</option>
                                    <option value="Question" @if(Request::get('occasion') == 'Question') selected @endif>Question</option>
                                    <option value="Pep talk" @if(Request::get('occasion') == 'Pep talk') selected @endif>Pep talk</option>
                                    <option value="Just cuz" @if(Request::get('occasion') == 'Just cuz') selected @endif>Just cuz</option>
                                </select>
                            </div>
                            <div class="md-form mb-4">
                                <textarea name="instruction" id="instruction" rows="4" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg mb-0" required>{{Request::get('instruction')}}</textarea>
                                <label class="text-white" for="instruction">Instructions</label>
                                {{-- <textarea name="instruction" id="instruction" rows="4" maxlength="150" oninput="document.getElementById('instlimit').innerText = (150 - this.value.length)" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg mb-0" required>{{Request::get('instruction')}}</textarea>
                                <label class="text-white" for="instruction">Instructions <small>(max 150 characters)</small></label>
                                <small><i>Left: <span id="instlimit">150</span></i></small> --}}
                            </div>
                            {{-- <p class="h6 mb-1">Text my booking updates</p>
                            <div class="md-form my-3">
                                <input type="text" name="phone" id="user_phone" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg mb-0">
                                <label class="text-white" for="phone">Phone</label>
                            </div> --}}
                            <div class="custom-control custom-checkbox my-0">
                                <input type="checkbox" class="custom-control-input" name="hide" id="hide" {{(Request::get('hide') == '1') ? 'checked' : ''}}>
                                <label class="custom-control-label text-light" for="hide">Hide this video from <b>{{$talent->name}}'s</b> profile.</label>
                            </div>
                        </div>
                        {{-- <div class="px-3 pb-3 pt-1 mb-4 border border-light rounded-lg">
                            <p class="h5 px-2 mb-4 text-center">Payment Information</p>
                            <p class="h6 mt-2">Billing address</p>
                            <div class="md-form mt-3 mb-4">
                                <input type="text" name="address" id="user_address" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg">
                                <label class="text-white" for="address">Address</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="md-form my-0">
                                        <input type="text" name="state" id="state" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg">
                                        <label class="text-white" for="state">State / City</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="md-form my-0">
                                        <input type="text" name="zip" id="zip" class="form-control form-control-lg bg-dark text-light border-0 rounded-lg">
                                        <label class="text-white" for="zip">Zip / Postcode</label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="py-2 mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="tncnppy" id="tncnppy" checked required>
                                <label class="custom-control-label" for="tncnppy">
                                    I agree to {{config('app.name')}}'s <span class="font-weight-bold"><a class="text-white" href="{{route('tos')}}">Terms of Service</a></span>, including Additional Terms, and <span class="font-weight-bold"><a class="text-white" href="{{route('ppy')}}">Privacy Policy</a></span>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-special gcolor btn-block rounded-pill text-capitalize" type="submit" name="book_price" value="{{$talent_info->vid_price}}">
                            <p class="mb-0 h5"><i class="fas fa-shopping-cart mr-2"></i>Book for <span class="ml-1">৳ {{$talent_info->vid_price}}</span></p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection