<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\StoreCommentRequest;
use \App\Http\Requests\StoreAnswerRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->comments()->create($validated);

        return response()->json(['Message'=>'Comment added Successfuly','data'=>$validated],201);
    }

    public function storeAnswer(StoreAnswerRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->answers()->create($validated);
        
        return response()->json(['Message'=>'Comment answer added Successfuly','data'=>$validated],201);
    }
}
