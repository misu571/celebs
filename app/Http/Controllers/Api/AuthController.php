<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TalentInfo;
use App\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client as OClient;

class AuthController extends Controller
{
    public $errorStatus = 401;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error' => $validator->errors()], $this->errorStatus);
        }

        $user = User::where('email', request('email'))->first();
        if ($user->status == 0) {
            return response()->json(['error' => 'This account has been deactivated!'], $this->errorStatus);
        }

        return $this->attempt_login(request('email'), request('password'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error' => $validator->errors()], $this->errorStatus);
        }

        $name = request('name');
        $name = str_replace(".","",str_replace(")","",str_replace("(","",$name)));
        $name = explode(" ",$name);
        $count = count($name);
        if ($count > 2) {
            $name = $name[$count - 2] ." ". $name[$count - 1];
        } else {
            $name = join(" ",$name);
        }
        $username = strtolower(str_replace(" ","_",$name)) ."_". $this->random_string(11);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'username' => $username,
            'password' => bcrypt(request('password')),
            'status' => '1',
        ]);
        
        return $this->attempt_login(request('email'), request('password'));
    }

    public function talent_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->errorStatus);
        }

        $name = request('name');
        $name = str_replace(".","",str_replace(")","",str_replace("(","",$name)));
        $name = explode(" ",$name);
        $count = count($name);
        if ($count > 2) {
            $name = $name[$count - 2] ." ". $name[$count - 1];
        } else {
            $name = join(" ",$name);
        }
        $username = strtolower(str_replace(" ","_",$name)) ."_". $this->random_string(11);

        $id = User::insertGetId([
            'name' => request('name'),
            'email' => request('email'),
            'username' => $username,
            'password' => bcrypt(request('password')),
            'type' => '1',
        ]);

        $userData = User::find($id);
        $userData->created_at = now();
        $userData->updated_at = now();
        $userData->save();
        $userInfo = new TalentInfo();
        $userInfo->user_id = $id;
        $userInfo->category_id = '1';
        $userInfo->save();
        
        return $this->attempt_login(request('email'), request('password'));
    }

    public function attempt_login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $oClient = OClient::where('password_client', 1)->first();
            return $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));
        }
        else {
            return $this->unauthorized();
        }
    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password)
    {
        $http = new Client();
        $response = $http->request('POST', config('app.url').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);

        $responseData = json_decode((string) $response->getBody(), true);
        $result = array_merge($responseData, array("type" => auth()->user()->type));
        return response()->json($result, 200);
    }

    public function refreshToken(Request $request)
    {
        $refresh_token = $request->header('Refreshtoken');
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client();

        try {
            $response = $http->request('POST', config('app.url').'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refresh_token,
                    'client_id' => $oClient->id,
                    'client_secret' => $oClient->secret,
                    'scope' => '*',
                ],
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (Exception $e) {
            return $this->unauthorized();
        }
    }

    public function unauthorized()
    {
        return response()->json(['error' => 'Unauthorized'], $this->errorStatus);
    }

    public function random_string($length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}
