@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5 px-md-5">
        <div class="row px-md-5">
            <div class="col mx-md-5">
                <div class="card special-color-dark">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-2 col-4">
                                <div class="avatar">
                                    <img src="{{$talentUser->avatar ? asset('storage/content/avatar/' . $talentUser->avatar) : asset('images/avatar.png')}}" class="rounded-circle img-fluid">
                                </div>
                            </div>
                            <div class="col my-auto">
                                <p class="h4 font-weight-bold mb-1">{{$talentUser->name}}</p>
                                <p class="h4 font-weight-normal mb-0">{{$talentUser->category}}</p>
                            </div>
                        </div>
                        <div class="text-md-left text-center">
                            <p class="text-uppercase h5">your request is booked</p>
                            <p class="font-weight-normal mb-0">Your request was sent to {{$talentUser->name}}. You should receive an email shortly.</p>
                        </div>
                    </div>
                    <div class="card-body px-md-5 pt-md-3 pb-0">
                        <p class="h5 mb-2">Request Details:</p>

                        <p class="h6 mb-0">Requested for:</p>
                        <p class="font-weight-light">{{$talentUser->name}}</p>

                        <p class="h6 mb-0">Booked By:</p>
                        <p class="font-weight-light">{{auth()->user()->name}}</p>

                        <p class="h6 mb-0">Video For:</p>
                        <p class="font-weight-light">{{$transaction->to}}</p>

                        @if ($transaction->from != '0')
                            <p class="h6 mb-0">Video From:</p>
                            <p class="font-weight-light">{{$transaction->from}}</p>
                        @endif

                        <p class="h6 mb-0">Pronoun:</p>
                        <p class="font-weight-light">{{$transaction->pronoun}}</p>

                        <p class="h6 mb-0">Occasion:</p>
                        <p class="font-weight-light">{{$transaction->occasion}}</p>

                        <p class="h6 mb-0">Instructions:</p>
                        <p class="font-weight-light">{{$transaction->instruction}}</p>
                        
                        @if ($transaction->hide == 1)
                            <p class="font-italic">Booked Privately</p>
                        @endif

                        <p><span class="h6">Charged:</span> <span class="font-weight-light">{{$transaction->currency}} {{$transaction->amount}}</span></p>
                        
                        <p class="h5 mb-2">Delivery Info:</p>
                        <p><span class="h6">Email:</span> <span class="font-weight-light">{{auth()->user()->email}}</span></p>
                    </div>
                    <div class="card-footer text-center">
                        @if ($transaction->reqstatus == 'Pending')
                            <a role="button" class="btn btn-light text-dark rounded-pill font-weight-bold" data-toggle="modal" data-target="#modifyOrder">Modify Order</a>
                            <div class="modal fade" id="modifyOrder" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content unique-color-dark text-light">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modify Request</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{route('user.modify.order', ['request_id' => $transaction->request_id])}}">
                                                @csrf

                                                <div class="text-left">
                                                    <label for="video_for">Video For :</label>
                                                    <input type="text" id="video_for" name="video_for" class="form-control mb-3" value="{{$transaction->to}}" required>

                                                    <label for="video_from">Video From (Optional):</label>
                                                    <input type="text" id="video_from" name="video_from" class="form-control mb-3" @if ($transaction->from == '0') placeholder="From" @else value="{{$transaction->from}}" @endif>

                                                    <label for="pronoun">Pronoun :</label>
                                                    <select class="form-control mb-3" name="pronoun" id="pronoun" required>
                                                        <option value="She/Her" @if ($transaction->pronoun == 'She/Her') selected @endif>She/Her: "Wish her a happy birthday"</option>
                                                        <option value="He/Him" @if ($transaction->pronoun == 'He/Him') selected @endif>He/Him: "Wish Him a happy birthday"</option>
                                                        <option value="They/Them" @if ($transaction->pronoun == 'They/Them') selected @endif>They/Them: "Wish Them a happy birthday"</option>
                                                        <option value="Other" @if ($transaction->pronoun == 'Other') selected @endif>Other: - will clarify in the instruction</option>
                                                    </select>

                                                    <label for="occasion">Occasion :</label>
                                                    <select class="form-control mb-3" id="occasion" name="occasion" required>
                                                        <option value="None" @if ($transaction->occasion == 'None') selected @endif>None</option>
                                                        <option value="Birthday" @if ($transaction->occasion == 'Birthday') selected @endif>Birthday</option>
                                                        <option value="Anniversary" @if ($transaction->occasion == 'Anniversary') selected @endif>Anniversary</option>
                                                        <option value="Give Thanks" @if ($transaction->occasion == 'Give Thanks') selected @endif>Give Thanks</option>
                                                        <option value="Wedding" @if ($transaction->occasion == 'Wedding') selected @endif>Wedding</option>
                                                        <option value="Gift" @if ($transaction->occasion == 'Gift') selected @endif>Gift</option>
                                                        <option value="Announcement" @if ($transaction->occasion == 'Announcement') selected @endif>Announcement</option>
                                                        <option value="Roast" @if ($transaction->occasion == 'Roast') selected @endif>Roast</option>
                                                        <option value="Get advice" @if ($transaction->occasion == 'Get advice') selected @endif>Get advice</option>
                                                        <option value="Question" @if ($transaction->occasion == 'Question') selected @endif>Question</option>
                                                        <option value="Pep talk" @if ($transaction->occasion == 'Pep talk') selected @endif>Pep talk</option>
                                                        <option value="Just cuz" @if ($transaction->occasion == 'Just cuz') selected @endif>Just cuz</option>
                                                    </select>

                                                    <label for="instruction">Instructions :</label>
                                                    <textarea name="instruction" id="instruction" rows="3" class="form-control mb-3" required>{{$transaction->instruction}}</textarea>

                                                    <div class="custom-control custom-checkbox mb-4">
                                                        <input type="checkbox" class="custom-control-input" name="hide" id="hide" @if ($transaction->hide == 1) checked @endif>
                                                        <label class="custom-control-label" for="hide">Hide from talent's profile</label>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection