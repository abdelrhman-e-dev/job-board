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
    $company = Company::findOrFail($this->company_id)->select('name', 'description', 'industry', 'specialization', 'size', 'founded_year', 'website')->first();
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
}
