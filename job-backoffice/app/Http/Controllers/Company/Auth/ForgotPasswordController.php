<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function show()
    {
        return "<h1>hello forgot password</h1>";
    }

    public function store(Request $request)
    {
        return "<h1>hello forgot password post</h1>";
    }

    public function reset(Request $request)
    {
        return "<h1>hello reset password</h1>";
    }

    public function resetStore(Request $request)
    {
        return "<h1>hello reset password post</h1>";
    }
}
