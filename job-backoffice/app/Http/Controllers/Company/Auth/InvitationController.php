<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show($token)
    {
        return "<h1>hello invitation</h1>";
    }

    public function store(Request $request)
    {
        return "<h1>hello invitation post</h1>";
    }
}
