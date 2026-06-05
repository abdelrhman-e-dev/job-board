<?php

namespace App\Livewire\Company\Profile;
use App\Services\Company\ProfileService;
use Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class UploadBanner extends Component
{
  protected ProfileService $profileService;

  public function boot(ProfileService $profileService)
  {
    $this->profileService = $profileService;
  }
  use WithFileUploads;
  #[Validate('image|max:2048|mimes:jpeg,png,jpg,gif,svg')]
  public $banner; // holds the temporary uploaded file
  public $currentBanner; // holds the current banner path

  public function mount() // run one time when the page opened 
  {
    $bannerPath = Auth::guard('company')->user()->company->banner;
    $this->currentBanner = $bannerPath ? Storage::url($bannerPath) : null;
  }
  //  fires instantly when user picks a file, shows preview
  public function updatedBanner()
  {
    $this->validate();
    $this->currentBanner = $this->banner->temporaryUrl();
  }
  public function save()
  {
    $updatedBanner = $this->profileService->handleBannerUpload($this->banner);
    if ($updatedBanner) {
      $company = Auth::guard('company')->user()->company;
      $this->banner = null;
      $this->currentBanner = Storage::url($company->refresh()->banner);
      Toaster::success('Banner updated successfully!');
    } else {
      Toaster::error('Failed to update banner!');
    }
  }
  public function render()
  {
    return view('livewire.company.profile.upload-banner');
  }
}
