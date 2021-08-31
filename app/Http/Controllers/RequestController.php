<?php

namespace App\Http\Controllers;

use App\Mail\RequestCompleted;
use App\RequestDetail;
use App\TalentAccount;
use App\TalentInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function booking(Request $request, $username)
    {
        $talent = User::where('username', $username)->first();
        $talent_info = TalentInfo::where('user_id', $talent->id)->first();

        return view('page_talent_book')->with([
            'talent' => $talent,
            'talent_info' => $talent_info,
        ]);
    }

    public function requested_video(Request $request, $reqid)
    {
        $this->validate($request, [
            'video' => 'required|mimes:mkv,mp4,mov,avi,mpg,mpeg,quicktime',
        ]);

        $reqData = RequestDetail::find($reqid);
        $talentAccData = TalentAccount::where('request_id', $reqid)->first();
        $talentData = TalentInfo::where('user_id', $reqData->talent_id)->first();
        $totalIncome = $talentAccData->income + $talentData->total_income;
        if ($request->hasFile('video')) {
            $fileName = $this->random_string(15);
            $extension = $request->file('video')->getClientOriginalExtension();
            $fileName = $fileName . '.' . $extension;
            if ($request->file('video')->storeAs('content/video', $fileName, 'public')) {
                RequestDetail::where('id', $reqid)->update(['video' => $fileName, 'status' => 'Submitted']);
                TalentAccount::where('request_id', $reqid)->update(['status' => true]);
                TalentInfo::where('user_id', $reqData->talent_id)->update(['total_income' => $totalIncome]);
                $user = User::find($reqData->submit_by);
                Mail::to($user->email)->send(new RequestCompleted($reqData->submit_by, $reqData->talent_id, $reqid));
                return back()->with('flush-alert', array('success', 'Video uploaded successfully.'));
                flush('flush-alert');
            } else {
                return back()->with('flush-alert', array('danger', 'Wrong file uploaded.'));
                flush('flush-alert');
            }
        }
    }

    public function reject_request(Request $request, $reqid)
    {
        RequestDetail::where('id', $reqid)->update(['status' => 'Rejected']);
        return back()->with('flush-alert', array('success', 'Request has been rejected.'));
        flush('flush-alert');
    }

    public function requested_video_edit(Request $request, $reqid)
    {
        $this->validate($request, [
            'video_edit' => 'required|mimes:mkv,mp4,mov,avi,mpg,mpeg,quicktime',
        ]);

        $reqData = RequestDetail::find($reqid);
        if ($request->hasFile('video_edit')) {
            Storage::delete('/public/content/video/' . $reqData->video);
            $fileName = $this->random_string(15);
            $extension = $request->file('video_edit')->getClientOriginalExtension();
            $fileName = $fileName . '.' . $extension;
            if ($request->file('video_edit')->storeAs('content/video', $fileName, 'public')) {
                RequestDetail::where('id', $reqid)->update(['video' => $fileName]);
                return back()->with('flush-alert', array('success', 'Video edited successfully.'));
                flush('flush-alert');
            } else {
                return back()->with('flush-alert', array('danger', 'Wrong file uploaded.'));
                flush('flush-alert');
            }
        }
    }

    public function random_string($length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}
