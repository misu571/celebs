<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\TalentAvailable;
use App\TalentCategory;
use App\TalentFollowerList;
use App\TalentInfo;
use App\TalentSocialAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TalentProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function designation_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'designation' => 'required|string',
            'primary' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'category'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $categoryType = Category::find($request->input('designation'));
        $ctgId = $categoryType->id;
        if ($request->has('primary')) {
            TalentInfo::where('user_id', auth()->user()->id)->update(['category_id' => $ctgId]);
        } else {
            $ctgList = TalentCategory::where('user_id', auth()->user()->id)->first();
            if ($ctgList) {
                $ctgId = $ctgList->category_id_list . ',' . $ctgId;
                TalentCategory::where('user_id', auth()->user()->id)->update(['category_id_list' => $ctgId]);
            } else {
                TalentCategory::create(['user_id' => auth()->user()->id, 'category_id_list' => $ctgId]);
            }
        }

        return back()->with([
            'flush-alert' => array('success', 'Category added successfully.'),
            'tab-name' => 'category'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function availability(Request $request)
    {
        $check = $request->input('availability');
        $available = '0';
        $talent = TalentInfo::where('user_id', auth()->user()->id);
        if ($check) {
            $available = '1';
            $talentData = $talent->first();
            if ($talentData->notify_id_list != '0') {
                $maiList = [];
                $users = explode(",", $talentData->notify_id_list);
                foreach ($users as $id) {
                    $user = User::find($id);
                    array_push($maiList, $user->email);
                }
                Mail::bcc($maiList)->send(new TalentAvailable);
            }
            $talent->update(['available' => $available, 'notify_id_list' => '0']);
            return back()->with('flush-alert', array('success', 'You are now available.'));
        }
        $talent->update(['available' => $available]);
        return back()->with('flush-alert', array('success', 'You are unavailable.'));
    }

    public function banking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string',
            'branch_name' => 'required|string',
            'acc_name' => 'required|string',
            'acc_id' => 'required|string',
            'swift_code' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'banking'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $TalentInfo = TalentInfo::where('user_id', auth()->user()->id)->first();
        $TalentInfo->bank_name = $request->input('bank_name');
        $TalentInfo->branch_name = $request->input('branch_name');
        $TalentInfo->acc_name = $request->input('acc_name');
        $TalentInfo->acc_id = $request->input('acc_id');
        $TalentInfo->swift_code = $request->input('swift_code');

        $TalentInfo->save();
        return back()->with([
            'flush-alert' => array('success', 'Bank details updated successfully.'),
            'tab-name' => 'banking'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function about_me(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_me' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'about'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $TalentInfo = TalentInfo::where('user_id', auth()->user()->id)->first();
        if ($TalentInfo) {
            $TalentInfo->about_me = $request->input('about_me');
        } else {
            $TalentInfo = new TalentInfo();
            $TalentInfo->user_id = auth()->user()->id;
            $TalentInfo->about_me = $request->input('about_me');
        }

        $TalentInfo->save();
        return back()->with([
            'flush-alert' => array('success', 'Bio updated successfully.'),
            'tab-name' => 'about'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function set_video_price(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vid_price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'price'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $userInfo = TalentInfo::where('user_id', auth()->user()->id)->first();
        $userInfo->vid_price = $request->input('vid_price');

        $userInfo->save();
        return back()->with([
            'flush-alert' => array('success', 'Price set successfully.'),
            'tab-name' => 'price'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function intro_vid(Request $request)
    {
        $this->validate($request, [
            'video' => 'required|max:159744|mimes:mkv,mp4,mov,avi,mpg,mpeg,quicktime',
        ]);

        $videoFile = TalentInfo::where('user_id', auth()->user()->id)->first();
        if ($request->hasFile('video')) {
            $vidId = $this->random_string(5);
            $fileName = 'intro_vid_' . $vidId;
            $extension = $request->file('video')->getClientOriginalExtension();
            $fileName = $fileName .'.'. $extension;
            $request->file('video')->storeAs('content/video', $fileName, 'public');
            $videoFile->intro_video = $fileName;
        }
        
        $videoFile->save();
        return back()->with([
            'flush-alert' => array('success', 'Intro video added successfully.'),
            'tab-name' => 'video'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function intro_vid_update(Request $request)
    {
        $this->validate($request, [
            'video_update' => 'required|max:159744|mimes:mkv,mp4,mov,avi,mpg,mpeg,quicktime',
        ]);

        $videoFile = TalentInfo::where('user_id', auth()->user()->id)->first();
        if ($request->hasFile('video_update')) {
            $vidId = $this->random_string(5);
            $fileName = 'intro_vid_' . $vidId;
            $extension = $request->file('video_update')->getClientOriginalExtension();
            $fileName = $fileName . '.' . $extension;
            if ($videoFile->intro_video) {
                Storage::delete('/public/content/video/' . $videoFile->intro_video);
                $request->file('video_update')->storeAs('content/video', $fileName, 'public');
            }
            $videoFile->intro_video = $fileName;
        }
        
        $videoFile->save();
        return back()->with([
            'flush-alert' => array('success', 'Intro video updated successfully.'),
            'tab-name' => 'video'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function intro_delete(Request $request)
    {
        $introVideo = TalentInfo::where('user_id', auth()->user()->id)->first();
        if ($introVideo->intro_video) {
            Storage::delete('/public/content/video/' . $introVideo->intro_video);
            $introVideo->intro_video = NULL;
        }
        
        $introVideo->save();
        return back()->with([
            'flush-alert' => array('success', 'Intro video has been deleted.'),
            'tab-name' => 'video'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function handler_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'handler_name' => 'required|string',
            'handler_id' => 'required|string',
            'followers' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'social'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $id = auth()->user()->id;
        $socialAcc = TalentSocialAccount::where('user_id', $id)->where('social_acc_name', $request->input('handler_name'))->first();
        $socialId = TalentSocialAccount::where('user_id', $id)->where('social_acc_id', $request->input('handler_id'))->first();
        if ($socialAcc) {
            return back();
        } else {
            if ($socialId) {
                return back();
            } else {
                $data = new TalentSocialAccount();
                $data->user_id = $id;
                $data->social_acc_name = $request->input('handler_name');
                $data->social_acc_id = $request->input('handler_id');
                $data->followers = $request->input('followers');

                $data->save();
                return back()->with([
                    'flush-alert' => array('success', 'Social account added successfully.'),
                    'tab-name' => 'social'
                ]);
                flush('flush-alert');
                flush('tab-name');
            }
        }
    }

    public function handler_edit(Request $request, $accid)
    {
        $validator = Validator::make($request->all(), [
            'handler_name' => 'required|string',
            'handler_id' => 'required|string',
            'followers' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'flush-alert' => array('danger', $validator->errors()),
                'tab-name' => 'social'
            ]);
            flush('flush-alert');
            flush('tab-name');
        }

        $socialAcc = TalentSocialAccount::where('user_id', auth()->user()->id)->where('id', $accid)->first();
        $socialAcc->social_acc_name = $request->input('handler_name');
        $socialAcc->social_acc_id = $request->input('handler_id');
        $socialAcc->followers = $request->input('followers');

        $socialAcc->save();
        return back()->with([
            'flush-alert' => array('success', 'Social account updated successfully.'),
            'tab-name' => 'social'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function handler_delete(Request $request, $accid)
    {
        $socialAcc = TalentSocialAccount::where('user_id', auth()->user()->id)->where('id', $accid)->first();

        $socialAcc->delete();
        return back()->with([
            'flush-alert' => array('success', 'Social account has been deleted.'),
            'tab-name' => 'social'
        ]);
        flush('flush-alert');
        flush('tab-name');
    }

    public function random_string($length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}
