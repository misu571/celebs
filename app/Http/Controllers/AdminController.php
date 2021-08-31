<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
use App\CompanyInfo;
use App\Exports\TransactionExport;
use App\Notification;
use App\Order;
use App\Promotion;
use App\PromotionItem;
use App\PromotionValue;
use App\RequestDetail;
use App\SettingBanners;
use App\SettingSocialLink;
use App\SocialPlatform;
use App\TagList;
use App\TalentAccount;
use App\TalentInfo;
use App\TalentSocialAccount;
use App\User;
use App\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin_dashboard');
    }

    public function accounts()
    {
        $accounts = Order::join('users as byuser', 'orders.user_id', '=', 'byuser.id')->leftJoin('request_details', 'orders.id', '=', 'request_details.payment_id')->leftJoin('users as fortalent', 'request_details.talent_id', '=', 'fortalent.id')
        ->select('orders.*', 'byuser.id as byuser_id', 'byuser.name as byuser_name', 'byuser.email as byuser_email', 'fortalent.id as fortalent_id', 'fortalent.name as fortalent_name', 'fortalent.email as fortalent_email', 'request_details.to', 'request_details.from', 'request_details.pronoun', 'request_details.occasion', 'request_details.instruction', 'request_details.hide', 'request_details.status as reqstatus')->orderByDesc('orders.created_at')->get();
        $total_income = Order::where('status', 'Success')->sum('amount');
        $total_paid = TalentInfo::sum('total_withdrawal');
        $net_income = $total_income - $total_paid;

        return view('admin_setting_accounts')->with([
            'total_income' => $total_income,
            'total_paid' => $total_paid,
            'net_income' => $net_income,
            'accounts' => $accounts,
        ]);
    }

    public function accountsPrintExcel()
    {
        return Excel::download(new TransactionExport, 'transactions.xlsx');
        return back()->with('flush-alert', array('success', 'Excel file downloaded.'));
    }

    public function accountsPrintCsv()
    {
        return Excel::download(new TransactionExport, 'transactions.csv');
        return back()->with('flush-alert', array('success', 'Excel file downloaded.'));
    }

    public function promotion()
    {
        $promotions = Promotion::latest()->get();

        return view('admin_setting_promotion')->with([
            'promotions' => $promotions,
        ]);
    }

    public function promotion_create(Request $request)
    {
        $this->validate($request, [
            'promo_title' => 'required|string|max:50',
            'promo_code' => 'required|string|max:20',
            'promo_valid_from' => 'nullable',
            'promo_valid_until' => 'nullable',
            'promo_uses_limit' => 'nullable|integer',
            'promo_details' => 'nullable|string|max:120',
            'promo_thumbnail' => 'nullable|image',
            'promo_discount_type' => 'required|string',
        ]);
        if ($request->input('promo_discount_type') == 'Cash') {
            $this->validate($request, [
                'promo_base_value' => 'nullable|integer',
                'promo_percent' => 'nullable|integer',
                'promo_max_value' => 'nullable|integer',
                'promo_min_value' => 'nullable|integer',
            ]);
        } else {
            $this->validate($request, [
                'promo_typename' => 'required|string',
            ]);
        }

        $promo = new Promotion();
        $promo->title = $request->input('promo_title');
        $promo->code = $request->input('promo_code');
        if ($request->hasFile('promo_thumbnail')) {
            $extension = $request->input('promo_thumbnail')->getClientOriginalExtension();
            $fileName = 'promo_thumbnail_' . $this->random_string(11) . '.' . $extension;
            $request->input('promo_thumbnail')->storeAs('content/img', $fileName, 'public');
            $promo->thumbnail = $fileName;
        }
        $promo->discount_type = $request->input('promo_discount_type');
        $promo->details = $request->input('promo_details');
        $promo->valid_from = $request->input('promo_valid_from');
        $promo->valid_until = $request->input('promo_valid_until');
        if ($request->hasFile('promo_uses_limit')) {
            $promo->uses_limit = $request->input('promo_uses_limit');
        }
        $promo->created_by = auth()->user()->id;

        if ($promo->save()) {
            if ($request->input('promo_discount_type') == 'Cash') {
                $promoCash = new PromotionValue();
                $promoCash->promo_id = $promo->id;
                $promoCash->base_value = $request->input('promo_base_value');
                $promoCash->percent = $request->input('promo_percent');
                $promoCash->max_value = $request->input('promo_max_value');
                $promoCash->min_value = $request->input('promo_min_value');
                $promoCash->save();
            } else {
                $promoItem = new PromotionItem();
                $promoItem->promo_id = $promo->id;
                $promoItem->user_ids = $request->input('promo_typename');
                $promoItem->save();
            }
            return back()->with('flush-alert', array('success', 'New Promotion created successfully.'));
            flush('flush-alert');
        }
    }

    public function setting()
    {
        $banners = SettingBanners::whereNotIn('banner', ['0'])->orderByDesc('updated_at')->get();
        $social_links = SettingSocialLink::all();
        $companyInfo = CompanyInfo::find(1);
        $vacancies = Vacancy::orderByDesc('active')->get();
        return view('admin_setting_page')->with([
            'banners' => $banners,
            'social_links' => $social_links,
            'companyInfo' => $companyInfo,
            'vacancies' => $vacancies,
        ]);
    }

    public function updateCompanyAbout(Request $request)
    {
        $this->validate($request, [
            'about_us' => 'required|string|max:61500',
        ]);
        CompanyInfo::where('id', 1)->update(['about' => request('about_us')]);
        return back()->with('flush-alert', array('success', 'About Us updated successfully.'));
    }

    public function updateCompanyTnc(Request $request)
    {
        $this->validate($request, [
            'terms_n_conditions' => 'required|string|max:61500',
        ]);
        CompanyInfo::where('id', 1)->update(['tnc' => request('terms_n_conditions')]);
        return back()->with('flush-alert', array('success', 'Terms & Conditions updated successfully.'));
    }

    public function updateCompanyPpy(Request $request)
    {
        $this->validate($request, [
            'privacy_policy' => 'required|string|max:61500',
        ]);
        CompanyInfo::where('id', 1)->update(['ppy' => request('privacy_policy')]);
        return back()->with('flush-alert', array('success', 'Privacy Policy updated successfully.'));
    }

    public function updateCompanyFaq(Request $request)
    {
        $this->validate($request, [
            'faq' => 'required|string|max:61500',
        ]);
        CompanyInfo::where('id', 1)->update(['faq' => request('faq')]);
        return back()->with('flush-alert', array('success', 'FAQ updated successfully.'));
    }

    public function settingCreateVacancy(Request $request)
    {
        $this->validate($request, [
            'position' => 'required|string|max:100',
            'post_details' => 'required|string|max:61500',
        ]);
        $active = false;
        if ($request->has('active')) {
            $active = true;
        }
        Vacancy::create(['position' => request('position'), 'details' => request('post_details'), 'active' => $active]);
        
        return back()->with('flush-alert', array('success', 'New vacancy created.'));
    }

    public function settingUpdateVacancy(Request $request, $id)
    {
        $position = 'position' . $id;
        $post_details = 'post_details' . $id;
        $active = 'active' . $id;
        $this->validate($request, [
            $position => 'required|string|max:100',
            $post_details => 'required|string|max:61500',
        ]);
        $activeState = false;
        if ($request->has($active)) {
            $activeState = true;
        }
        Vacancy::where('id', $id)->update(['position' => request($position), 'details' => request($post_details), 'active' => $activeState]);
        
        return back()->with('flush-alert', array('success', 'Vacancy updated.'));
    }

    public function setting_banner_add(Request $request)
    {
        $this->validate($request, [
            'banner' => 'required|string',
        ]);

        $base64_image = $request->banner;
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);
            $data = base64_decode($data);
            $imageName = 'banner_' . $this->random_string(7) . '.png';
            Storage::disk('public')->put('content/banners/' . $imageName, $data);
            $banner = SettingBanners::where('banner', '0')->first();
            if ($banner) {
                SettingBanners::where('id', $banner->id)->update(['banner' => $imageName]);
            } else {
                SettingBanners::create(['banner' => $imageName]);
            }
            return response()->json('success');
        }
    }

    public function setting_banner_remove(Request $request ,$id)
    {
        $data = SettingBanners::find($id);
        Storage::delete('/public/content/banners/' . $data->banner);
        SettingBanners::where('id', $id)->update(['banner' => '0']);
        return back()->with('flush-alert', array('success', 'Banner deleted successfully.'));
        flush('flush-alert');
    }

    public function setting_social_link_add(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|string|unique:setting_social_links,type',
            'link' => 'required|string',
        ]);

        $type = ucfirst(strtolower($request->input('type')));
        $link = strtolower($request->input('link'));
        SettingSocialLink::create([
            'type' => $type,
            'link' => $link,
        ]);
        return back()->with('flush-alert', array('success', 'Link added successfully.'));
        flush('flush-alert');
    }

    public function setting_social_link_update(Request $request, $id)
    {
        $this->validate($request, [
            'link' => 'required|string',
        ]);

        SettingSocialLink::where('id', $id)->update([
            'link' => $request->input('link'),
        ]);
        return back()->with('flush-alert', array('success', 'Link updated successfully.'));
        flush('flush-alert');
    }

    public function setting_social_link_remove(Request $request, $id)
    {
        SettingSocialLink::where('id', $id)->update([
            'link' => '0',
        ]);
        return back()->with('flush-alert', array('success', 'Link removed successfully.'));
        flush('flush-alert');
    }

    // Category settings //
    public function setting_category()
    {
        $categories = Category::all();
        $tags = TagList::latest()->get();

        return view('admin_setting_category_page')->with([
            'tags' => $tags,
            'categories' => $categories,
        ]);
    }

    public function setting_tag_create(Request $request)
    {
        $this->validate($request, [
            'tag_create' => 'required|string|max:50|unique:tag_lists,tag',
        ]);

        TagList::create([
            'tag' => '#' . $request->input('tag_create'),
        ]);
        
        return back()->with('flush-alert', array('success', 'Tag created successfully.'));
        flush('flush-alert');
    }

    public function setting_tag_edit(Request $request, $id)
    {
        $this->validate($request, [
            'tag_edit' => 'required|string|max:50|unique:tag_lists,tag',
        ]);

        $tagName = $request->input('tag_edit');
        $arr = str_split($tagName);
        if ($arr[0] != '#') {
            $tagName = '#' . $tagName;
        }
        TagList::where('id', $id)->update(['tag' => $tagName]);
        
        return back()->with('flush-alert', array('success', 'Tag edited successfully.'));
        flush('flush-alert');
    }

    public function setting_tag_delete(Request $request, $id)
    {
        $tag = TagList::find($id);
        
        if ($tag->delete()) {
            return back()->with('flush-alert', array('success', 'Tag deleted successfully.'));
            flush('flush-alert');
        }
    }

    public function setting_category_create(Request $request)
    {
        $this->validate($request, [
            'category_create' => 'required|string|max:50|unique:categories,category',
        ]);

        Category::create([
            'category' => $request->input('category_create'),
            'show' => '0',
        ]);
        
        return back()->with('flush-alert', array('success', 'Category created successfully.'));
        flush('flush-alert');
    }

    public function setting_category_edit(Request $request, $id)
    {
        $this->validate($request, [
            'category_edit' => 'required|string|max:50|unique:categories,category',
        ]);

        if ($id < 10) {
            return back()->with('flush-alert', array('danger', 'Category can not be edit.'));
            flush('flush-alert');
        }
        Category::where('id', $id)->update(['category' => $request->input('category_edit')]);
        
        return back()->with('flush-alert', array('success', 'Category edited successfully.'));
        flush('flush-alert');
    }

    public function setting_category_delete(Request $request, $id)
    {
        if ($id < 10) {
            return back()->with('flush-alert', array('danger', 'Category can not be deleted.'));
            flush('flush-alert');
        }
        $category = Category::find($id);
        
        if ($category->delete()) {
            return back()->with('flush-alert', array('success', 'Category deleted successfully.'));
            flush('flush-alert');
        }
    }
    // Category settings //

    // User profile function //
    public function userClients()
    {
        $userClients = User::where('type', '0')->get();

        return view('admin_user_clientslist')->with([
            'userClients' => $userClients,
        ]);
    }

    public function user_acc_verify($id)
    {
        $userData = User::find($id);
        $userData->status = '1';
        $userData->status_changed_by = auth()->user()->id;
        $userData->status_changed_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'Account verified successfully.'));
            flush('flush-alert');
        }
    }

    public function user_email_verify($id)
    {
        $userData = User::find($id);
        $userData->email_verified_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'E-mail verified successfully.'));
            flush('flush-alert');
        }
    }

    public function user_phone_verify($id)
    {
        $userData = User::find($id);
        $userData->phone_verified_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'Phone verified successfully.'));
            flush('flush-alert');
        }
    }

    public function user_acc_ban($id)
    {
        $userData = User::find($id);
        $userData->status = '0';
        $userData->status_changed_by = auth()->user()->id;
        $userData->status_changed_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'Account diactivated successfully.'));
            flush('flush-alert');
        }
    }
    // User profile function //

    // Talent profile function //
    public function userTalents()
    {
        // $userTalents = User::join('talent_titles', 'users.id', '=', 'talent_titles.user_id')->where('talent_titles.primary', '1')->where('users.type', '1')->leftJoin('user_categories', function ($join) {
        //     $join->on('users.id', '=', 'user_categories.user_id')->where('user_categories.category_id', 2);
        // })->select('users.*', 'talent_titles.designation', 'user_categories.category_id as uctgid')->get();

        $userTalents = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')
        ->select('users.*', 'talent_infos.about_me', 'talent_infos.rating', 'talent_infos.intro_video', 'talent_infos.vid_price', 'talent_infos.chat_price', 'talent_infos.cut_ratio', 'talent_infos.response_time', 'talent_infos.category_id', 'talent_infos.feature', 'categories.category')->get();
        $categorys = Category::all();
        $socialPlatforms = SocialPlatform::all();

        return view('admin_user_talentlist')->with([
            'userTalents' => $userTalents,
            'categorys' => $categorys,
            'socialPlatforms' => $socialPlatforms,
        ]);
    }

    public function feature_category(Request $request)
    {
        $this->validate($request, [
            'uid' => 'required|string',
        ]);

        $talent = TalentInfo::where('user_id', $request->input('uid'))->first();
        if ($talent->feature) {
            $feature = false;
        } else {
            $feature = true;
        }
        TalentInfo::where('user_id', $request->input('uid'))->update(['feature' => $feature]);

        return response()->json($feature);
    }

    public function talent_details(Request $request, $id)
    {
        $categories = Category::all();
        $socialPlatforms = SocialPlatform::all();
        $userInfo = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('users.id', $id)->select('users.*', 'talent_infos.*', 'categories.category')->first();
        $accInfo = TalentAccount::join('orders', 'talent_accounts.order_id', '=', 'orders.id')->join('request_details', 'talent_accounts.request_id', '=', 'request_details.id')->join('users', 'request_details.submit_by', '=', 'users.id')->where('request_details.talent_id', $id)->where('talent_accounts.user_id', $id)
        ->select(
            'talent_accounts.*',
            'users.name as users_name',
            'users.email as users_email',
            'orders.tx_id as orders_tx_id',
            'orders.bank_tx_id as orders_bank_tx_id',
            'orders.amount as orders_amount',
            'orders.currency as orders_currency',
            'orders.payment_option as orders_payment_option',
            'orders.status as orders_status',
            'request_details.to as request_details_to',
            'request_details.from as request_details_from',
            'request_details.pronoun as request_details_pronoun',
            'request_details.occasion as request_details_occasion',
            'request_details.instruction as request_details_instruction',
            'request_details.status as request_details_status'
        )->orderBy('talent_accounts.created_at', 'desc')->get();
        
        return view('admin_talent_details')->with([
            'userInfo' => $userInfo,
            'accInfo' => $accInfo,
            'categories' => $categories,
            'socialPlatforms' => $socialPlatforms,
        ]);
    }

    public function talent_profile_edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'nullable|string|min:10',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'post_code' => 'nullable|string|max:255',
        ]);
        
        $data = User::find($id);
        if ($data->username !== $request->input('username')) {
            $userName = User::where('username', $request->input('username'))->first();
            if (!$userName) {
                $data->username = strtolower($request->input('username'));
            }
        }
        if ($data->phone !== $request->input('phone')) {
            $data->phone = $request->input('phone');
            $data->phone_verified_at = NULL;
        }
        if ($request->has('phone_verified_at')) {
            $data->phone_verified_at = now();
        }
        $data->name = $request->input('name');
        $data->gender = $request->input('gender');
        $data->dob = $request->input('dob');
        $data->address = $request->input('address');
        $data->city = $request->input('city');
        $data->country = $request->input('country');
        $data->post_code = $request->input('post_code');

        if ($data->save()) {
            return back()->with('flush-alert', array('success', 'Talent profile updated successfully.'));
            flush('flush-alert');
        }
    }

    public function talent_profile_update(Request $request, $id)
    {
        $this->validate($request, [
            'about_me' => 'nullable|string|max:255',
            'vid_price' => 'string|max:255',
            'cut_ratio' => 'string|max:255',
            'category' => 'string|max:255',
        ]);
        
        $data = TalentInfo::where('user_id', $id)->first();
        $data->about_me = $request->input('about_me');
        $data->vid_price = $request->input('vid_price');
        $data->cut_ratio = $request->input('cut_ratio');
        $data->category_id = $request->input('category');

        if ($data->save()) {
            return back()->with('flush-alert', array('success', 'Talent profile updated successfully.'));
            flush('flush-alert');
        }
    }

    public function talent_bank_update(Request $request, $id)
    {
        $this->validate($request, [
            'bank_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'acc_name' => 'required|string|max:255',
            'acc_id' => 'required|string|max:255',
            'swift_code' => 'nullable|string|max:255',
        ]);
        
        $data = TalentInfo::where('user_id', $id)->first();
        $data->bank_name = $request->input('bank_name');
        $data->branch_name = $request->input('branch_name');
        $data->acc_name = $request->input('acc_name');
        $data->acc_id = $request->input('acc_id');
        if ($request->has('swift_code')) {
            $data->swift_code = $request->input('swift_code');
        }

        if ($data->save()) {
            return back()->with('flush-alert', array('success', 'Talent profile updated successfully.'));
            flush('flush-alert');
        }
    }

    public function talent_avatar_update(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|string',
            'uid' => 'required|string',
        ]);

        $user = User::find($request->input('uid'));
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
                $this->userTalents();
            }
        }
    }

    public function talent_acc_verify($id)
    {
        $userData = User::find($id);
        $userData->status = '1';
        $userData->status_changed_by = auth()->user()->id;
        $userData->status_changed_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'Account verified successfully.'));
            flush('flush-alert');
        }
    }

    public function talent_email_verify($id)
    {
        $userData = User::find($id);
        $userData->email_verified_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'E-mail verified successfully.'));
            flush('flush-alert');
        }
    }

    public function talent_phone_verify($id)
    {
        $userData = User::find($id);
        $userData->phone_verified_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'Phone verified successfully.'));
            flush('flush-alert');
        }
    }

    public function talent_acc_ban($id)
    {
        $userData = User::find($id);
        $userData->status = '0';
        $userData->status_changed_by = auth()->user()->id;
        $userData->status_changed_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'Account diactivated successfully.'));
            flush('flush-alert');
        }
    }

    public function talent_create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email',
            'email_verified_at' => 'nullable',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:10',
            'phone_verified_at' => 'nullable',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'designation' => 'required|string',
            'handler_name' => 'required|string',
            'handler_id' => 'required|string',
            'followers' => 'required|string',
        ]);

        $name = $request->input('name');
        $name = str_replace(".","",str_replace(")","",str_replace("(","",$name)));
        $name = explode(" ",$name);
        $count = count($name);
        if ($count > 2) {
            $name = $name[$count - 2] ." ". $name[$count - 1];
        } else {
            $name = join(" ",$name);
        }
        $username = strtolower(str_replace(" ","_",$name)) ."_". $this->random_string(11);
        
        $uid = User::insertGetId([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $username,
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
            'type' => '1',
        ]);

        $userData = User::find($uid);
        if ($request->has('email_verified_at')) {
            $userData->email_verified_at = now();
        }
        if ($request->has('phone_verified_at')) {
            $userData->phone_verified_at = now();
        }
        $userData->created_at = now();
        $userData->updated_at = now();
        $userData->save();

        $userInfo = new TalentInfo();
        $userInfo->user_id = $uid;
        $userInfo->category_id = $request->input('designation');
        $userInfo->save();

        $socialAcc = new TalentSocialAccount();
        $socialAcc->user_id = $uid;
        $socialAcc->social_acc_name = $request->input('handler_name');
        $socialAcc->social_acc_id = $request->input('handler_id');
        $socialAcc->followers = $request->input('followers');
        $socialAcc->save();

        return back()->with('flush-alert', array('success', 'Account created successfully.'));
        flush('flush-alert');
    }
    // Talent profile function //

    // Admin profile function //
    public function userAdmins()
    {
        if (auth()->user()->level < 3) {
            $userAdmins = Admin::all();
    
            return view('admin_user_adminlist')->with([
                'userAdmins' => $userAdmins,
            ]);
        }
    }

    public function admin_acc_verify($id)
    {
        if (auth()->user()->level < 3) {
            $userData = Admin::find($id);
            $userData->status = '1';
            $userData->status_changed_by = auth()->user()->id;
            $userData->status_changed_at = now();

            if ($userData->save()) {
                return back()->with('flush-alert', array('success', 'Account verified successfully.'));
                flush('flush-alert');
            }
        }
    }

    public function admin_email_verify($id)
    {
        $userData = Admin::find($id);
        $userData->email_verified_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'E-mail verified successfully.'));
            flush('flush-alert');
        }
    }

    public function admin_phone_verify($id)
    {
        $userData = Admin::find($id);
        $userData->phone_verified_at = now();

        if ($userData->save()) {
            return back()->with('flush-alert', array('success', 'Phone verified successfully.'));
            flush('flush-alert');
        }
    }

    public function admin_acc_ban($id)
    {
        if (auth()->user()->level < 3) {
            $userData = Admin::find($id);
            $userData->status = '0';
            $userData->status_changed_by = auth()->user()->id;
            $userData->status_changed_at = now();

            if ($userData->save()) {
                return back()->with('flush-alert', array('success', 'Account diactivated successfully.'));
                flush('flush-alert');
            }
        }
    }

    public function admin_create(Request $request)
    {
        if (auth()->user()->level < 3) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|email|unique:admins,email',
                'email_verified_at' => 'nullable',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|string|min:10',
                'phone_verified_at' => 'nullable',
                'dob' => 'required|date',
                'gender' => 'required|string',
                'level' => 'required|string',
            ]);

            $user = new Admin();
            $user->password = bcrypt($request->input('password'));
            if ($request->has('email_verified_at')) {
                $user->email_verified_at = now();
            }
            if ($request->has('phone_verified_at')) {
                $user->phone_verified_at = now();
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $name = $request->input('name');
            $name = str_replace(".","",str_replace(")","",str_replace("(","",$name)));
            $name = explode(" ",$name);
            $count = count($name);
            if ($count > 2) {
                $name = $name[$count - 2] ." ". $name[$count - 1];
            } else {
                $name = join(" ",$name);
            }
            $username = strtolower(str_replace(" ","_",$name)) ."_". $this->random_string(11);
            $user->username = $username;
            $user->phone = $request->input('phone');
            $user->dob = $request->input('dob');
            $user->gender = $request->input('gender');
            $user->status = '1';
            $user->status_changed_by = auth()->user()->id;
            $user->status_changed_at = now();
            if (auth()->user()->level < $request->input('level')) {
                $user->level = $request->input('level');
            } else {
                return back()->with('flush-alert', array('danger', 'Incorrect user level.'));
                flush('flush-alert');
            }

            if ($user->save()) {
                return back()->with('flush-alert', array('success', 'Account created successfully.'));
                flush('flush-alert');
            }
        }
    }
    // Admin profile function //

    // Profile function //
    public function profile()
    {
        return view('admin_profile');
    }

    public function profile_update(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|max:255|nullable',
            'phone' => 'string|min:10|nullable',
            'dob' => 'date|nullable',
            'gender' => 'string|nullable',
            'address' => 'string|max:255|nullable',
            'city' => 'string|max:100|nullable',
            'country' => 'string|max:150|nullable',
            'post_code' => 'string|nullable',
        ]);

        $data = Admin::find(auth()->user()->id);
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

        if ($data->save()) {
            return back()->with('flush-alert', array('success', 'Profile updated successfully.'));
            flush('flush-alert');
        }
    }

    public function avatar_update(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|string',
        ]);

        $user = Admin::find(auth()->user()->id);
        $base64_image = $request->avatar;
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);
            $data = base64_decode($data);
            $imageName = 'avatar_admin_' . $user->id . '.png';
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
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required',
        ]);

        $user = Admin::find(auth()->user()->id);
        if (Hash::check($request->input('old_password'), $user->password)) {
            if ($request->input('password') === $request->input('password_confirmation')) {
                $user->password = bcrypt($request->input('password'));
            }
        }

        if ($user->save()) {
            return back()->with('flush-alert', array('success', 'Password changed successfully.'));
            flush('flush-alert');
        }
    }
    // Profile function //

    // Client request function //
    public function client_request()
    {
        $requests = RequestDetail::join('users as usubmit', 'usubmit.id', '=', 'request_details.submit_by')->join('users as utalent', 'utalent.id', '=', 'request_details.talent_id')->join('orders', 'request_details.payment_id', '=', 'orders.id')
        ->select(
            'request_details.*',
            'usubmit.name as usubmit_name',
            'usubmit.email as usubmit_email',
            'utalent.name as utalent_name',
            'utalent.email as utalent_email',
            'orders.tx_id as orders_tx_id',
            'orders.bank_tx_id as orders_bank_tx_id',
            'orders.amount as orders_amount',
            'orders.currency as orders_currency',
            'orders.payment_option as orders_payment_option',
            'orders.status as orders_status'
        )->orderBy('request_details.created_at', 'desc')->get();

        return view('admin_client_request')->with([
            'requests' => $requests,
        ]);
    }

    public function request_verify(Request $request, $id)
    {
        $clintRequest = RequestDetail::find($id);
        $clintRequest->approve_by = auth()->user()->id;
        $clintRequest->approved_at = now();
        $clintRequest->status = 'Pending';
        
        if ($clintRequest->save()) {
            $notify = new Notification();
            $notify->request_id = $id;
            if ($notify->save()) {
                return back()->with('flush-alert', array('success', 'Client request verified.'));
                flush('flush-alert');
            }
        }
    }

    public function request_unverify(Request $request, $id)
    {
        $clintRequest = RequestDetail::find($id);
        $clintRequest->approve_by = auth()->user()->id;
        $clintRequest->approved_at = now();
        $clintRequest->status = 'NOT Verified';
        
        if ($clintRequest->save()) {
            $notify = Notification::where('request_id', $id)->first();
            if ($notify->delete()) {
                return back()->with('flush-alert', array('success', 'Client request unverified.'));
                flush('flush-alert');
            }
        }
    }

    public function request_cancle(Request $request, $id)
    {
        $clintRequest = RequestDetail::find($id);
        $clintRequest->approve_by = auth()->user()->id;
        $clintRequest->approved_at = now();
        $clintRequest->status = 'Rejected';
        
        if ($clintRequest->save()) {
            $notify = Notification::where('request_id', $id)->first();
            if ($notify->delete()) {
                return back()->with('flush-alert', array('success', 'Client request rejected.'));
                flush('flush-alert');
            }
        }
    }

    public function random_string($length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}
