<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|exists:admins',
            'password' => 'required|string',
        ]);

        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->with($this->sendFailedLoginResponse($request));
    }
    
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        return redirect()->intended(route('admin.login'));
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
