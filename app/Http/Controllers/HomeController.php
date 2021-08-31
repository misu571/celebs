<?php

namespace App\Http\Controllers;

use App\Category;
use App\CompanyInfo;
use App\RequestDetail;
use App\TagList;
use App\TalentInfo;
use App\TalentReviewList;
use App\TalentTag;
use App\TalentVideoList;
use App\User;
use App\Vacancy;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Artisan::call('cache:clear');
        if (Auth::check()) {
            $this->middleware('auth');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

    public function category(Request $request)
    {
        $this->validate($request, [
            'ctname' => 'required|string',
        ]);

        $ctname = Category::where('category', $request->input('ctname'))->whereNotIn('category', ['Newcomer', 'Featured'])->first();
        if ($ctname) {
            $categoryType = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
            ->where(['users.type' => '1', 'users.status' => '1', 'talent_infos.category_id' => $ctname->id])
            ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->get();
        } else {
            if ($request->input('ctname') == 'Newcomer') {
                $categoryType = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
                ->where(['users.type' => '1', 'users.status' => '1'])->whereDate('users.created_at', '>', now()->modify('-90 day')->toDateString())
                ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->get();
            } else {
                $categoryType = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
                ->where(['users.type' => '1', 'users.status' => '1', 'talent_infos.feature' => '1'])
                ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->get();
            }
        }

        return response()->json($categoryType);
    }

    public function talent_profile(Request $request, $username)
    {
        $talent = User::where('username', $username)->first();
        $talentInfo = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('users.id', $talent->id)
        ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'talent_infos.response_time', 'talent_infos.available', 'categories.category')->first();
        $tagList = TalentTag::where('user_id', $talent->id)->first();
        $tags = '0';
        if ($tagList) {
            $tagArr = explode(',', $tagList->tag_id_list);
            $tags = TagList::whereIn('id', $tagArr)->get();
        }
        $days = 1;
        $req = RequestDetail::where('talent_id', $talent->id);
        $reqList = $req->get();
        if ($req->exists()) {
			$total = 0;
            foreach ($reqList as $value) {
                $createTime = new DateTime($value->created_at);
                $updateTime = new DateTime($value->updated_at);
                $interval = $createTime->diff($updateTime);
                $daysCount = $interval->format('%a');
                $total = $total + $daysCount;
            }
			$days = strval(round($total / $req->count()));
			if ($days < 1) {
				$days = '1';
			}
        }
        $follow = '0';
        $notify = '0';
        if (Auth::check()) {
            if (auth()->user()->id != $talent->id) {
                $talentData = TalentInfo::where('user_id', $talent->id)->first();
                if ($talentData->follower_id_list != 0) {
                    $followerList = explode(",", $talentData->follower_id_list);
                    $arrFollowKey = array_search(auth()->user()->id, $followerList);
                    if (is_int($arrFollowKey)) {
                        if (array_key_exists($arrFollowKey, $followerList)) {
                            $follow = $talent->id;
                        }
                    }
                }
                if ($talentData->notify_id_list != 0) {
                    $notifyList = explode(",", $talentData->notify_id_list);
                    $arrNotifyKey = array_search(auth()->user()->id, $notifyList);
                    if (is_int($arrNotifyKey)) {
                        if (array_key_exists($arrNotifyKey, $notifyList)) {
                            $notify = $talent->id;
                        }
                    }
                }
            }
        }
        $talentVideos = $req->where('hide', '0')->inRandomOrder()->take(3)->get();
        $ratings = RequestDetail::join('users', 'request_details.submit_by', '=', 'users.id')->where('request_details.talent_id', $talent->id)->orderByDesc('request_details.created_at')->get();

        return view('page_talent_profile')->with([
            'talentInfo' => $talentInfo,
            'talentVideos' => $talentVideos,
            'ratings' => $ratings,
            'tags' => $tags,
            'days' => $days,
            'follow' => $follow,
            'notify' => $notify,
        ]);
    }

    public function show_review(Request $request)
    {
        $this->validate($request, [
            'reviewId' => 'required',
        ]);

        $reviewId = $request->input('reviewId');
        $reviews = TalentReviewList::join('users', 'users.id', '=', 'talent_review_lists.user_id')->where('follower_id', $reviewId)->select('talent_review_lists.*', 'users.name as uname')->latest()->get();
        return response()->json($reviews);
    }

    public function search_talent(Request $request)
    {
        $this->validate($request, [
            'searchVal' => 'required',
        ]);

        $searchVal = $request->input('searchVal');
        $searchResult = User::where('name', 'like', '%' . $searchVal . '%')->where('type', '1')->take(10)->get();
        return response()->json($searchResult);
    }

    public function inquiry(Request $request)
    {
        $this->validate($request, [
            'contact_name' => 'required|string|max:100',
            'contact_email' => 'required|string|email|max:100',
            'contact_subject' => 'required|string|max:255',
            'contact_message' => 'required|string|max:255',
        ]);
        Mail::raw(request('contact_message'), function ($message) {
            $message->from(request('contact_email'), request('contact_name'));
            $message->to(config('mail.support.address'), config('mail.support.name'));
            $message->subject(request('contact_subject'));
        });
        
        return back()->with('flush-alert', array('success', 'Message send successfully.'));
    }

    public function career()
    {
        $vacancies = Vacancy::where('active', true)->orderByDesc('updated_at')->get();
        return view('career')->with('vacancies', $vacancies);
    }

    public function about()
    {
        return view('about_us');
    }

    public function faq()
    {
        return view('faq');
    }

    public function tos()
    {
        return view('tnc');
    }

    public function ppy()
    {
        return view('pp');
    }
}
