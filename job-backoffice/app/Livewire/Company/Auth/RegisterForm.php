<?php

namespace App\Livewire\Company\Auth;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\UserDTO;
use App\Exceptions\Company\Auth\RegistrationFailed;
use App\Models\Company;
use App\Models\User;
use App\Services\Company\RegisterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class RegisterForm extends Component
{
  private RegisterService $registerService;
  public function boot(RegisterService $registerService)
  {
    $this->registerService = $registerService;
  }
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
    try {
      $this->registerService->register($this->getUserdata(), $this->getCompanydata());
    } catch (RegistrationFailed $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('company.verification.notice');
  }

  public function getUserdata()
  {
    return new UserDTO(
      $this->first_name,
      $this->last_name,
      $this->email,
      $this->password,
    );
  }
  public function getCompanydata()
  {
    return new CompanyDTO(
      company_name: $this->company_name,
      company_slug: $this->company_name,
      industry: $this->industry,
      size: $this->size,
      city: $this->city,
      country: $this->country,
      status: 'pending',
    );
  }
  public function render()
  {
    return view('livewire.company.auth.register-form');
  }
}
