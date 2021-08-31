<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;
    
    public function user()
    {
        return auth()->user();
    }

    public function profile()
    {
        $user = $this->user();
        if ($this->user()->type == 1) {
            $user = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('users.id', $user->id)->select('users.*', 'talent_infos.*', 'categories.*')->first();
        }
        
        return response()->json($user, $this->successStatus);
    }

    public function profile_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'phone' => 'string|min:10|nullable',
            'dob' => 'date|nullable',
            'gender' => 'string|nullable',
            'address' => 'string|max:255|nullable',
            'city' => 'string|max:100|nullable',
            'country' => 'string|max:150|nullable',
            'post_code' => 'string|nullable',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error' => $validator->errors()], $this->errorStatus);
        }

        $data = User::find($this->user()->id);
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
            return response()->json(['message' => 'Profile updated successfully!'], $this->successStatus);
        }
    }

    public function account_deactivate(Request $request)
    {
        $user = User::find($this->user()->id);
        $user->status = '0';
        $user->status_changed_by = null;
        $user->status_changed_at = now();
        
        if ($user->save()) {
            $request->user()->token()->revoke();
            return response()->json(['message' => 'Account deactivated successfully!'], $this->successStatus);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out!'], $this->successStatus);
    }
}
