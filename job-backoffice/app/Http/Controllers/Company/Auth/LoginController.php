<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return "<h1>hello login</h1>";
    }

    public function store(Request $request)
    {
        return "<h1>hello login post</h1>";
    }
}
