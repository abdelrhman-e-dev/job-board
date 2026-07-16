<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Company\Auth\RegistrationRequest;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function show()
  {
    return view('company.auth.register');
  }
}