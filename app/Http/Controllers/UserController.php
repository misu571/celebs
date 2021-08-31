<?php

namespace App\Http\Controllers;

use App\Category;
use App\RequestDetail;
use App\SocialPlatform;
use App\TalentAccount;
use App\TalentCategory;
use App\TalentInfo;
use App\TalentReviewList;
use App\TalentSocialAccount;
use App\TalentVideoList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $newtalent = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
        ->where(['users.type' => '1', 'users.status' => '1'])->whereDate('users.created_at', '>', now()->modify('-90 day')->toDateString())
        ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->inRandomOrder()->take(7)->get();

        $featalent = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where(['users.type' => '1', 'users.status' => '1', 'talent_infos.feature' => '1'])
        ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->inRandomOrder()->take(7)->get();

        $ctg_2 = $this->seek_talents(2);
        $ctg_3 = $this->seek_talents(3);
        $ctg_4 = $this->seek_talents(4);
        $ctg_5 = $this->seek_talents(5);
        $ctg_6 = $this->seek_talents(6);
        $ctg_7 = $this->seek_talents(7);
        $ctg_8 = $this->seek_talents(8);
        $ctg_9 = $this->seek_talents(9);
        
        $new_counts = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->where(['users.type' => '1', 'users.status' => '1'])->whereDate('users.created_at', '>', now()->modify('-90 day')->toDateString())->count();
        $fet_counts = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->where(['users.type' => '1', 'users.status' => '1', 'talent_infos.feature' => '1'])->count();
        $categorie_counts = TalentInfo::join('users', 'talent_infos.user_id', '=', 'users.id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('users.status', '1')->selectRaw('distinct(categories.category) as ct_name, count(talent_infos.category_id) as ct_count')->groupBy('ct_name')->get();
        
        return view('home')->with([
            'new_counts' => $new_counts,
            'fet_counts' => $fet_counts,
            'categorie_counts' => $categorie_counts,
            'newtalent' => $newtalent,
            'featalent' => $featalent,
            'ctg_2' => $ctg_2,
            'ctg_3' => $ctg_3,
            'ctg_4' => $ctg_4,
            'ctg_5' => $ctg_5,
            'ctg_6' => $ctg_6,
            'ctg_7' => $ctg_7,
            'ctg_8' => $ctg_8,
            'ctg_9' => $ctg_9,
        ]);
    }

    public function seek_talents($ctg_id)
    {
        return User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where(['users.type' => '1', 'users.status' => '1', 'talent_infos.category_id' => $ctg_id])
        ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->inRandomOrder()->take(7)->get();
    }

    public function request_list()
    {
        $requests = RequestDetail::join('users', 'request_details.submit_by', '=', 'users.id')->where('request_details.talent_id', auth()->user()->id)
        ->select('request_details.*', 'users.name', 'users.avatar')->latest()->get();
        
        return view('talent_request_list')->with([
            'requests' => $requests,
        ]);
    }
    
    public function video_list()
    {
        $videos = RequestDetail::join('users', 'request_details.talent_id', '=', 'users.id')->join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
        ->where(['request_details.submit_by' => auth()->user()->id])->select('request_details.*', 'users.name', 'users.avatar', 'categories.category')->latest()->get();

        return view('user_video_list')->with([
            'videos' => $videos,
        ]);
    }

    public function notification()
    {
        if (auth()->user()->type > 0) {
            $requests = RequestDetail::join('users', 'users.id', '=', 'request_details.submit_by')->where('talent_id', auth()->user()->id)
            ->whereNotIn('status', ['NOT Verified'])->select('request_details.*', 'users.name as uname', 'users.avatar as uavatar')->latest()->get();
            
            return view('talent_notification')->with([
                'requests' => $requests,
            ]);
        } else {
            $response = RequestDetail::join('video_requests', 'request_details.id', '=', 'video_requests.request_id')
                ->join('users', 'users.id', '=', 'request_details.talent_id')->where('submit_by', auth()->user()->id)
                ->whereIn('status', ['Submitted', 'Rejected'])->select('request_details.*', 'video_requests.video as reqvideo', 'users.name as tname', 'users.avatar as tavatar')->latest()->get();
            
            return view('user_notification')->with([
                'response' => $response,
            ]);
        }
    }

    public function following()
    {
        $followers = TalentInfo::select('user_id', 'follower_id_list')->get();
        $uids = [];
        foreach ($followers as $value) {
            $users = explode(",", $value->follower_id_list);
            $arrKey = array_search(auth()->user()->id, $users);
            if (is_int($arrKey)) {
                if (array_key_exists($arrKey, $users)) {
                    array_push($uids, $value->user_id);
                }
            }
        }
        $followings = user::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
        ->whereIn('users.id', $uids)->select('users.*', 'talent_infos.rating', 'talent_infos.vid_price', 'talent_infos.available', 'categories.category')->get();
        
        return view('user_follow_list')->with('followings', $followings);
    }

    public function follow(Request $request, $id)
    {
        $talent = TalentInfo::where('user_id', $id)->first();
        if ($talent) {
            $data = auth()->user()->id;
            if ($talent->follower_id_list != 0) {
                $data = $talent->follower_id_list . ',' . auth()->user()->id;
            }
            TalentInfo::where('user_id', $id)->update(['follower_id_list' => $data]);
            return back()->with('flush-alert', array('success', 'You are now following this talent.'));
            flush('flush-alert');
        } else {
            return back()->with('flush-alert', array('danger', 'Talent does not exists.'));
            flush('flush-alert');
        }
    }

    public function unfollow(Request $request, $id)
    {
        $talent = TalentInfo::where('user_id', $id)->first();
        if ($talent) {
            $list = explode(",", $talent->follower_id_list);
            if (count($list) > 1) {
                $uid = array_search(auth()->user()->id, $list);
                array_splice($list, $uid, 1);
                $data = implode(",", $list);
            } else {
                $data = '0';
            }
            TalentInfo::where('user_id', $id)->update(['follower_id_list' => $data]);
            return back()->with('flush-alert', array('success', 'You have unfollow this talent.'));
            flush('flush-alert');
        } else {
            return back()->with('flush-alert', array('danger', 'Talent does not exists.'));
            flush('flush-alert');
        }
    }

    public function notify(Request $request, $id)
    {
        $talent = TalentInfo::where('user_id', $id)->first();
        if ($talent) {
            $data = auth()->user()->id;
            if ($talent->notify_id_list != 0) {
                $data = $talent->notify_id_list . ',' . auth()->user()->id;
            }
            TalentInfo::where('user_id', $id)->update(['notify_id_list' => $data]);
            return back()->with('flush-alert', array('success', 'You will be notified.'));
            flush('flush-alert');
        } else {
            return back()->with('flush-alert', array('danger', 'Talent does not exists.'));
            flush('flush-alert');
        }
    }

    public function unotify(Request $request, $id)
    {
        $talent = TalentInfo::where('user_id', $id)->first();
        if ($talent) {
            $list = explode(",", $talent->notify_id_list);
            if (count($list) > 1) {
                $uid = array_search(auth()->user()->id, $list);
                array_splice($list, $uid, 1);
                $data = implode(",", $list);
            } else {
                $data = '0';
            }
            TalentInfo::where('user_id', $id)->update(['notify_id_list' => $data]);
            return back()->with('flush-alert', array('success', 'You will not be notified.'));
            flush('flush-alert');
        } else {
            return back()->with('flush-alert', array('danger', 'Talent does not exists.'));
            flush('flush-alert');
        }
    }

    public function talent_rating(Request $request, $id)
    {
        $this->validate($request, [
            'rateTalent' => 'required|integer|min:1|max:5',
            'review_msg' => 'nullable|string|max:100',
        ]);

        $rate = $request->input('rateTalent');
        $comment = $request->input('review_msg');
        if (is_null($comment)) {
            $comment = '0';
        }
        RequestDetail::where('id', $id)->update(['rate' => $rate, 'comment' => $comment]);
        $req = RequestDetail::find($id);
        $talentRating = TalentInfo::where('user_id', $req->talent_id)->first();
        $reqAvgRate = (RequestDetail::where('talent_id', $req->talent_id)->get())->avg('rate');
        $rateValue = (($talentRating->rating + $reqAvgRate) / 2);
        switch (true) {
            case $rateValue < 1:
                $rateValue = 1;
                break;
            case ($rateValue >= 1.5 && $rateValue < 2):
                $rateValue = 1.5;
                break;
            case ($rateValue >= 2 && $rateValue < 2.5):
                $rateValue = 2;
                break;
            case ($rateValue >= 2.5 && $rateValue < 3):
                $rateValue = 2.5;
                break;
            case ($rateValue >= 3 && $rateValue < 3.5):
                $rateValue = 3;
                break;
            case ($rateValue >= 3.5 && $rateValue < 4):
                $rateValue = 3.5;
                break;
            case ($rateValue >= 4 && $rateValue < 4.5):
                $rateValue = 4;
                break;
            case ($rateValue >= 4.5 && $rateValue < 5):
                $rateValue = 4.5;
                break;
            default:
                $rateValue = 5;
        }
        TalentInfo::where('user_id', $req->talent_id)->update(['rating' => strval($rateValue)]);
        return back()->with('flush-alert', array('success', 'Your review submitted.'));
    }

    public function profile()
    {
        $orders = TalentAccount::join('orders', 'talent_accounts.order_id', '=', 'orders.id')->join('request_details', 'talent_accounts.request_id', '=', 'request_details.id')->where('talent_accounts.user_id', auth()->user()->id)
        ->select('talent_accounts.*', 'orders.tx_id', 'orders.bank_tx_id', 'orders.amount', 'orders.currency', 'orders.payment_option', 'orders.status', 'request_details.to', 'request_details.from', 'request_details.pronoun', 'request_details.occasion', 'request_details.instruction', 'request_details.hide', 'request_details.status as reqstatus')->get();

        if (auth()->user()->type > 0) {
            $userInfo = TalentInfo::join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('talent_infos.user_id', auth()->user()->id)->select('talent_infos.*', 'categories.category')->first();
            $userAcc = TalentAccount::join('orders', 'talent_accounts.order_id', '=', 'orders.id')->join('request_details', 'talent_accounts.request_id', '=', 'request_details.id')->join('users', 'talent_accounts.user_id', '=', 'users.id')->where('request_details.talent_id', auth()->user()->id)
            ->select('talent_accounts.*', 'orders.tx_id', 'orders.bank_tx_id', 'orders.amount', 'orders.currency', 'request_details.to', 'request_details.from', 'request_details.pronoun', 'request_details.occasion', 'request_details.instruction', 'request_details.status as reqstat', 'users.name', 'users.email')->latest()->get();
            $ctgList = TalentCategory::where('user_id', auth()->user()->id)->first();
            $ctgs = '0';
            if ($ctgList) {
                $ctgArr = explode(',', $ctgList->category_id_list);
                $ctgs = Category::whereIn('id', $ctgArr)->get();
            }
            $userSocialAcc = TalentSocialAccount::where('user_id', auth()->user()->id)->get();
            $categories = Category::where('id', '!=', '2')->get();
            $socialPlatforms = SocialPlatform::all();

            return view('talent_profile')->with([
                'userInfo' => $userInfo,
                'userSocialAcc' => $userSocialAcc,
                'categories' => $categories,
                'ctgs' => $ctgs,
                'socialPlatforms' => $socialPlatforms,
                'userAcc' => $userAcc,
                'orders' => $orders,
            ]);
        } else {
            return view('user_profile')->with([
                'orders' => $orders,
            ]);
        }
    }

    public function profile_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'string|min:10|nullable',
            'dob' => 'date|nullable',
            'gender' => 'string|nullable',
            'address' => 'string|max:255|nullable',
            'city' => 'string|max:100|nullable',
            'country' => 'string|max:150|nullable',
            'post_code' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'profile'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $data = User::find(auth()->user()->id);
        if ($data->phone !== $request->input('phone')) {
            $data->phone = $request->input('phone');
            $data->phone_verified_at = NULL;
        }
        $data->name = $request->input('name');
        $data->gender = $request->input('gender');
        $data->dob = $request->input('dob');
        $data->address = $request->input('address');
        $data->city = $request->input('city');
        $data->country = $request->input('country');
        $data->post_code = $request->input('post_code');

        $data->save();
        return back()->with([
            'flush-alert' => array('success', 'Profile updated successfully.'),
            'tab-name' => 'profile'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function avatar_update(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|string',
        ]);

        $user = User::find(auth()->user()->id);
        $base64_image = $request->avatar;
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);
            $data = base64_decode($data);
            $imageName = 'avatar_user_' . $user->id . '.png';
            if ($user->avatar) {
                Storage::delete('/public/content/avatar/' . $user->avatar);
            }
            if (Storage::disk('public')->put('content/avatar/' . $imageName, $data)) {
                $user->avatar = $imageName;
                $user->save();
                $this->profile();
            }
        }
    }

    public function password_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'password'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $user = User::find(auth()->user()->id);
        if (Hash::check($request->input('old_password'), $user->password)) {
            if ($request->input('password') !== $request->input('password_confirmation')) {
                return back()->with([
                    'flush-alert' => array('danger', 'Confirm password does not match.'),
                    'tab-name' => 'password'
                ]);
                flush('flush-alert');
                flush('tab-name');
            }
            $user->password = bcrypt($request->input('password'));
        } else {
            return back()->with([
                'flush-alert' => array('danger', 'Password does not match.'),
                'tab-name' => 'password'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $user->save();
        return back()->with([
            'flush-alert' => array('success', 'Password change successfully.'),
            'tab-name' => 'password'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function talent_video_archive()
    {
        if (auth()->user()->type > 0) {
            $userSocialVid = TalentVideoList::where('user_id', auth()->user()->id)->orderByDesc('created_at')->get();

            return view('talent_video_list')->with([
                'userSocialVid' => $userSocialVid,
            ]);
        }
    }

    public function account_deactivate()
    {
        $user = User::find(auth()->user()->id);
        $user->status = '0';
        $user->status_changed_by = null;
        $user->status_changed_at = now();

        if ($user->save()) {
            return back()->with('flush-alert', array('success', 'Account deactivated successfully.'));
            flush('flush-alert');
        }
    }
}
