<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\StoreNewsRequest;
use Illuminate\Support\Facades\Auth;
use \App\Services\SendNotificationService;
use App\Models\News;
use App\Models\User;
use App\Models\Follower;
use Mail;

class NewsController extends Controller
{
    public function store(StoreNewsRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->news()->create($validated);
        SendNotificationService::mailSend();
        
        return response()->json(['Message'=>'Added Successfuly','data'=>$validated],201);
    }
    
    public function getNews()
    {
        $response = News::with(['comments','comments.answers'])->orderBy('id','desc')->get();

        return response()->json($response,200);
    }
    public function getMoreCommentedNews()
    {
        $response = News::withCount(['comments'])->with(['comments','comments.answers'])->orderBy('comments_count','desc')->get();

        return response()->json($response,200);
    }
}
