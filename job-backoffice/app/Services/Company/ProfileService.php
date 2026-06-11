<?php

namespace App\Services\Company;

use App\Repositories\Company\ProfileRepository;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
  /**
   * Create a new class instance.
   */
  public function __construct(private ProfileRepository $profile)
  {
  }
  public function updateBanner($company_id, $path)
  {
    return $this->profile->updateBanner($company_id, $path);
  }
  public function getBanner($company_id)
  {
    return $this->profile->getBanner($company_id);
  }
  public function handleBannerUpload($file)
  {
    try {
      $companyId = Auth::guard('company')->user()->company_id;
      $oldBanner = $this->getBanner($companyId);
      $path = $file->store('companies/banners', 'public');
      if ($oldBanner) {
        Storage::disk('public')->delete($oldBanner);
      }
      $this->updateBanner($companyId, $path);
      return true;
    } catch (\Exception $e) {
      \Log::error('Banner Upload Error: ' . $e->getMessage());
      return false;
    }
  }

  public function updateLogo($company_id, $path)
  {
    return $this->profile->updateLogo($company_id, $path);
  }
  public function getLogo($company_id)
  {
    return $this->profile->getLogo($company_id);
  }
  public function handleLogoUpload($file)
  {
    try {
      $companyId = Auth::guard('company')->user()->company_id;
      $oldLogo = $this->getLogo($companyId);
      $path = $file->store('companies/logos', 'public');
      if ($oldLogo) {
        Storage::disk('public')->delete($oldLogo);
      }
      $this->updateLogo($companyId, $path);
      return true;
    } catch (\Exception $e) {
      \Log::error('Logo Upload Error: ' . $e->getMessage());
      return false;
    }
  }
  // get company profile
  // get company basic info
  public function getBasicInfo()
  {
    return $this->profile->getBasicInfo();
  }
  public function getCompanySizes()
  {
    return $this->profile->getCompanySizes();
  }
  public function saveBasicInfo(array $data)
  {
    return $this->profile->updateBasicInfo($data);
  }
  // get company location
  public function getLocation()
  {
    return $this->profile->getLocation();
  }
  public function saveLocation(array $data)
  {
    return $this->profile->updateLocation($data);
  }
  // get company contact info
  public function getContactInfo()
  {
    return $this->profile->getContactInfo();
  }
  public function saveContactInfo(array $data)
  {
    return $this->profile->updateContactInfo($data);
  }
  
}
