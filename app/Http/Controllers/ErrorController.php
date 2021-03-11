<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notFoundPage()
    {
        return view('404');
    }
    public function successPage()
    {
        return view('success');
    }
}
