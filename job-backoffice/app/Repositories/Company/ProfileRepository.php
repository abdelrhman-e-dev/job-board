<?php

namespace App\Repositories\Company;

use App\Models\Company;
use Auth;

class ProfileRepository
{
  /**
   * Create a new class instance.
   */
  private $company_id;
  public function __construct()
  {
    $this->company_id = Auth::guard('company')->user()->company_id;
  }
  public function updateBanner($company_id, $path)
  {
    $company = Company::find($company_id);
    $company->banner = $path;
    $company->save();
  }
  public function getBanner($company_id)
  {
    $company = Company::find($company_id);
    $bannerPath = $company->banner;
    return $bannerPath;
  }
  public function updateLogo($company_id, $path)
  {
    $company = Company::find($company_id);
    $company->logo = $path;
    $company->save();
  }
  public function getLogo($company_id)
  {
    $company = Company::find($company_id);
    $logoPath = $company->logo;
    return $logoPath;
  }

  // get company basic info
  public function getBasicInfo()
  {
    $company = Company::select('name', 'description', 'industry', 'specialization', 'size', 'founded_year', 'website')
      ->where('company_id', $this->company_id)->first();
    return $company;
  }
  // get company sizes
  public function getCompanySizes()
  {
    return Company::COMPANY_SIZES;
  }
  public function updateBasicInfo($data)
  {
    return Company::where('company_id', $this->company_id)->update($data);
  }
  // get company location
  public function getLocation()
  {
    $company = Company::select('address', 'city', 'country')->where('company_id', $this->company_id)->first();
    return $company;
  }
  public function updateLocation($data)
  {
    return Company::where('company_id', $this->company_id)->update($data);
  }
  // get company contact info
  public function getContactInfo()
  {
    $company = Company::select('contact_email', 'contact_phone')->where('company_id', $this->company_id)->first();
    return $company;
  }
  public function updateContactInfo($data)
  {
    return Company::where('company_id', $this->company_id)->update($data);
  }

  // social links
  public function getSocialLinks()
  {
    return Company::where('company_id', $this->company_id)->select('social_links')->first();
  }
  public function updateSocialLinks($data)
  {
    return Company::where('company_id', $this->company_id)->update(['social_links' => $data]);
  }
}
