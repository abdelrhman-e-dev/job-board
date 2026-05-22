<?php

namespace App\Livewire\Company\Auth;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class RegisterForm extends Component
{
  public $step = 1;
  // step 1 properties
  public $first_name = '';
  public $last_name = '';
  public $email = '';
  public $password = '';
  public $password_confirmation = '';
  // step 2 properties
  public $company_name = '';
  public $industry = '';
  public $size = '';
  public $city = '';
  public $country = '';
  // rules 
  protected function rules()
  {
    if ($this->step === 1) {
      return [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
      ];
    } else {
      return [
        'company_name' => 'required|string|max:255',
        'industry' => 'required|string|max:255',
        'size' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
      ];
    }
  }
  // next step method 
  public function nextStep()
  {
    $this->validate();
    $this->step = 2;
  }
  // previouse step method 
  public function previousStep()
  {
    $this->step = 1;
  }
  // submit method 
  public function submit()
  {
    $this->validate();
    DB::transaction(function () {
      $user = User::create([
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'role_id' => User::ROLES['company-owner'],
      ]);

      $company = Company::create([
        'name' => $this->company_name,
        'slug' => Str::slug($this->company_name),
        'industry' => $this->industry,
        'size' => $this->size,
        'city' => $this->city,
        'country' => $this->country,
        'owner_id' => $user->user_id,
        'status' => 'pending', // Default status
      ]);
      // Link company to user
      $user->update(['company_id' => $company->company_id]);
      // Send verification email
      Auth::guard('company')->login($user);
      $user->sendEmailVerificationNotification();
    });

    return redirect()->route('company.verification.notice');
  }

  public function render()
  {
    return view('livewire.company.auth.register-form');
  }
}
