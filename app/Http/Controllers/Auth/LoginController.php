<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback()
    {
        $provider = 'google';
        $user = Socialite::driver($provider)->user();

        return $this->user_data($user, $provider);
    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback()
    {
        $provider = 'facebook';
        $user = Socialite::driver($provider)->user();

        return $this->user_data($user, $provider);
    }

    public function user_data($user, $provider)
    {
        $provider = ucfirst($provider);
        $username = strtolower(str_replace(" ","_",$user->getName())) ."_". $this->random_string(11);
        $userInfo = User::where('email', $user->getEmail())->first();
        if ($userInfo) {
            if ($userInfo->provider_id == 0) {
                User::where('email', $userInfo->email)->update(['provider_id' => $user->getId(), 'provider_name' => $provider]);
            } else {
                if ($userInfo->provider_name != $provider) {
                    return redirect()->route('login')->with('flush-alert', array('danger', 'This email already registered with '. $userInfo->provider_name .'.'));
                    flush('flush-alert');
                }
            }
            $id = $userInfo->id;
        } else {
            $id = User::insertGetId([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'username' => $username,
                'provider_id' => $user->getId(),
                'provider_name' => $provider,
                'status' => '1',
            ]);
        }
        
        $user = User::find($id);
        Auth::login($user, true);
        return redirect(RouteServiceProvider::HOME);
    }

    public function random_string($length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}
