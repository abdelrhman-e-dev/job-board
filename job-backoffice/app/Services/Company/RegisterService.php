<?php

namespace App\Services\Company;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\UserDTO;
use App\Exceptions\Company\Auth\RegistrationFailed;
use App\Models\User;
use App\Repositories\Company\RegisterRepository;
use Hash;
use Str;

class RegisterService
{
  /**
   * Create a new class instance.
   */
  public function __construct(private RegisterRepository $registerRepository)
  {
  }
  public function register(UserDTO $userData, CompanyDTO $companyData)
  {
    try {
      $userData = new UserDTO(
        $userData->first_name,
        $userData->last_name,
        $userData->email,
        password: Hash::make($userData->password),
        roleId: User::ROLES['company-owner'],
      );
      $companyData = new CompanyDTO(
        company_name: $companyData->company_name,
        company_slug: Str::slug($companyData->company_name) . '-' . time(),
        industry: $companyData->industry,
        size: $companyData->size,
        city: $companyData->city,
        country: $companyData->country,
        status: $companyData->status,
      );
      $user = $this->registerRepository->register($userData, $companyData);
      $this->sendVerificationEmail($user);
    } catch (\Throwable $e) {
      report($e);
      return throw new RegistrationFailed();
    }
  }
  public function sendVerificationEmail($user)
  {
    $user->sendEmailVerificationNotification();
  }
}
