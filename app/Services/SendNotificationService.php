<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follower;
use Mail;

class SendNotificationService
{
    public static function mailSend()
    {
        $email = [];
        $follower = Follower::join('users','followers.follower_id','=','users.id')
                            ->where('user_id',Auth::id())
                            ->get();

        foreach($follower as $follow)
        {
            $email[] = $follow->email;
        }

        $data = array('name'=>Auth::user()->name);
        Mail::send('new_post_email', $data, function($message) use($email){
        $message->to($email, 'Administrator of armproject.am')->subject
        ('New post');
        $message->from('admin@gmail.com','Administrator');
        });
    }
}