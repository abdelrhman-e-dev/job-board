<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  public function show()
  {
    return "<h1>hello register</h1>";
  }

  public function store(Request $request)
  {
    return "<h1>hello register post</h1>";
  }
}
