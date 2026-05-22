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

  public function store(RegistrationRequest $request)
  {
    $data = $request->validated();
    // create user account 
    DB::transaction(function () use ($data) {
      $user = $this->createUser($data);
    });
  }


  protected function createUser($data)
  {
    return User::create([
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'company_id' => null,
      'role_id' => User::ROLES['company-owner'],
      // status by default is Inactive
    ]);
  }
}