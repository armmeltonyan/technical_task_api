<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use \App\Http\Requests\RegisterRequest;
use \App\Http\Requests\FollowRequest;
use \App\Services\SendMailService;
use \App\Services\LoginService;
use \App\Services\EmailVerifyService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follower;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        /*encrypting password before save to db*/
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        SendMailService::mailSend($request->email);
    
        return response()->json(['Message'=>'Link for verify sended to your email'],201);
    }
    public function verifyEmail($hash,$id)
    {
        if(EmailVerifyService::verifyEmailMethod($id,$hash)) 
        
        return Redirect::to('/verified');  
        else 
        
        return Redirect::to('/404');  
    }
    public function login(Request $request)
    {
        $response = LoginService::login($request->email,$request->password);

        return $response;
    }
    public function getProfile()
    {
        return response()->json(User::withCount(['followers','news'])->whereId(Auth::id())->get());
    }
    public function subscribeToUser(FollowRequest $request)
    {
        $validated = $request->validated();
        Follower::create(['follower_id' => \Auth::id()] + $validated);

        return response()->json(['Status' => 'Success'],201);
    }
}
