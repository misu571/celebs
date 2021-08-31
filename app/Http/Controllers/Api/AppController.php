<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\TalentFollowerList;
use App\TalentInfo;
use App\TalentVideoList;
use App\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;
    public $message = '';
    
    public function user()
    {
        return auth()->user();
    }
    
    public function home()
    {
        $newtalent = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')
        ->join('categories', 'talent_infos.category_id', '=', 'categories.id')
        ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', '0')->whereDate('users.created_at', '>', now()->modify('-90 day')->toDateString())
        ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->inRandomOrder()->take(7)->get();

        $featalent = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->join('user_categories', 'users.id', '=', 'user_categories.user_id')
        ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', '0')->where('user_categories.category_id', '2')
        ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->inRandomOrder()->take(7)->get();

        $otrtalent = $this->seek_talents(1);
        $actalent = $this->seek_talents(3);
        $comtalent = $this->seek_talents(4);
        $ctrtalent = $this->seek_talents(5);
        $entalent = $this->seek_talents(6);
        $inftalent = $this->seek_talents(7);
        $modtalent = $this->seek_talents(8);
        $mustalent = $this->seek_talents(9);
        $spttalent = $this->seek_talents(10);
        
        $new_counts = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', 0)->whereDate('users.created_at', '>', now()->modify('-90 day')->toDateString())->count();
        $fet_counts = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->join('user_categories', 'users.id', '=', 'user_categories.user_id')
        ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', '0')->where('user_categories.category_id', '2')->count();
        $categorie_counts = TalentInfo::join('categories', 'talent_infos.category_id', '=', 'categories.id')->join('users', 'talent_infos.user_id', '=', 'users.id')
        ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', 0)
        ->selectRaw('distinct(categories.category) as ct_name, count(talent_infos.category_id) as ct_count')->groupBy('ct_name')->get();

        $data = array();
        $data['new_counts'] = $new_counts;
        $data['fet_counts'] = $fet_counts;
        $data['categorie_counts'] = $categorie_counts;
        $data['newtalent'] = $newtalent;
        $data['featalent'] = $featalent;
        $data['otrtalent'] = $otrtalent;
        $data['actalent'] = $actalent;
        $data['comtalent'] = $comtalent;
        $data['ctrtalent'] = $ctrtalent;
        $data['entalent'] = $entalent;
        $data['inftalent'] = $inftalent;
        $data['modtalent'] = $modtalent;
        $data['mustalent'] = $mustalent;
        $data['spttalent'] = $spttalent;
        $data = array_merge($data, array("type" => $this->user()->type));

        return response()->json($data, $this->successStatus);
    }

    public function seek_talents($ct)
    {
        return User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
        ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', '0')->where('talent_infos.category_id', $ct)
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
            ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', '0')->where('talent_infos.category_id', $ctname->id)
            ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->get();
        } else {
            if ($request->input('ctname') == 'Newcomer') {
                $categoryType = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
                ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', '0')->whereDate('users.created_at', '>', now()->modify('-90 day')->toDateString())
                ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->get();
            } else {
                $categoryType = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->join('user_categories', 'users.id', '=', 'user_categories.user_id')
                ->where('users.type', '1')->where('users.status', '1')->whereNotNull('users.avatar')->where('talent_infos.vid_price', '>', '0')->where('user_categories.category_id', '2')
                ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'categories.category')->get();
            }
        }
        $categoryType->add(['type'=> $this->user()->type]);

        return response()->json($categoryType, $this->successStatus);
    }

    public function talent_profile(Request $request, $username)
    {
        $talent = User::where('username', $username)->first();
        $talent = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('users.id', $talent->id)->select('users.*', 'talent_infos.*', 'categories.*')->first();
        $talentVideos = TalentVideoList::join('video_requests', 'video_requests.id', '=', 'talent_video_lists.request_id')
                        ->select('talent_video_lists.*','video_requests.video as video')->where('user_id', $talent->id)->latest()->take(3)->get();
        $user = TalentFollowerList::where('user_id', $this->user()->id)->first();
        $follow = '0';
        if ($user) {
            if ($user->follower_id_list != 0) {
                $key = 0;
                $id_list = explode(",", $user->follower_id_list);
                $tid = array_search($talent->id, $id_list);
                if (is_int($tid)) {
                    $key = array_key_exists($tid, $id_list);
                }
                if ($key) {
                    $follow = $talent->id;
                }
            }
        }

        $data = array();
        $data['talent'] = $talent;
        $data['talentVideos'] = $talentVideos;
        $data['follow'] = $follow;
        $data = array_merge($data, array("type" => $this->user()->type));
        
        return response()->json($data, $this->successStatus);
    }

    public function follow(Request $request, $id)
    {
        $talent = User::where('id', $id)->where('type', 1)->first();
        if ($talent) {
            $follow = TalentFollowerList::where('user_id', auth()->user()->id)->first();
            if ($follow) {
                if ($follow->follower_id_list == 0) {
                    $follow->follower_id_list = $talent->id;
                } else {
                    $follow->follower_id_list = $follow->follower_id_list . ',' . $id;
                }
            } else {
                $follow = new TalentFollowerList();
                $follow->user_id = auth()->user()->id;
                $follow->follower_id_list = $id;
            }
            if ($follow->save()) {
                $this->message = 'You are now following this talent.';
                return response()->json(['message' => $this->message], $this->successStatus);
            }
        } else {
            $this->message = 'Talent does not exists.';
            return response()->json(['message' => $this->message], $this->errorStatus);
        }
    }

    public function unfollow(Request $request, $id)
    {
        $talent = User::where('id', $id)->where('type', 1)->first();
        if ($talent) {
            $unfollow = TalentFollowerList::where('user_id', auth()->user()->id)->first();
            $list = explode(",", $unfollow->follower_id_list);
            if (count($list) > 1) {
                $tid = array_search($talent->id, $list);
                array_splice($list, $tid, 1);
                $unfollow->follower_id_list = implode(",", $list);
            } else {
                $unfollow->follower_id_list = '0';
            }
            if ($unfollow->save()) {
                $this->message = 'You have unfollow this talent.';
                return response()->json(['message' => $this->message], $this->successStatus);
            }
        } else {
            $this->message = 'Talent does not exists.';
            return response()->json(['message' => $this->message], $this->errorStatus);
        }
    }

    public function about()
    {
        return response()->json(array("type" => $this->user()->type), $this->successStatus);
    }

    public function faq()
    {
        return response()->json(array("type" => $this->user()->type), $this->successStatus);
    }

    public function tos()
    {
        return response()->json(array("type" => $this->user()->type), $this->successStatus);
    }

    public function ppy()
    {
        return response()->json(array("type" => $this->user()->type), $this->successStatus);
    }
}
