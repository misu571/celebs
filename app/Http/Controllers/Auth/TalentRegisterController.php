<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeUserMail;
use App\SocialPlatform;
use App\TalentInfo;
use App\TalentSocialAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TalentRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $socialPlatforms = SocialPlatform::all();
        return view('auth.register_talent')->with('socialPlatforms', $socialPlatforms);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:10',
            'handler_name' => 'required|string',
            'handler_id' => 'required|string|max:255',
            'followers' => 'required|integer',
        ]);
        
        $name = $request->input('name');
        $email = $request->input('email');
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
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => bcrypt($request->input('password')),
            'type' => '1',
        ]);

        $userData = User::find($uid);
        $userData->created_at = now();
        $userData->updated_at = now();
        $userData->save();
        TalentInfo::create([
            'user_id' => $uid,
            'category_id' => '1',
        ]);
        TalentSocialAccount::create([
            'user_id' => $uid,
            'social_acc_name' => request('handler_name'),
            'social_acc_id' => request('handler_id'),
            'followers' => request('followers'),
        ]);

        // send mail
        Mail::to($email)->send(new WelcomeUserMail($name, $email));

        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('user.home'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function random_string($length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}
