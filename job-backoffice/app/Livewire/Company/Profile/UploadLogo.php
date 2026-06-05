<?php

namespace App\Livewire\Company\Profile;
use App\Services\Company\ProfileService;
use Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class UploadLogo extends Component
{
  protected ProfileService $profileService;

  public function boot(ProfileService $profileService)
  {
    $this->profileService = $profileService;
  }
  use WithFileUploads;
  #[Validate('image|max:2048|mimes:jpeg,png,jpg,gif,svg')]
  public $logo; // holds the temporary uploaded file
  public $currentLogo; // holds the current logo path

  public function mount() // run one time when the page opened 
  {
    $logoPath = Auth::guard('company')->user()->company->logo;
    $this->currentLogo = $logoPath ? Storage::url($logoPath) : null;
  }
  //  fires instantly when user picks a file, shows preview
  public function updatedLogo()
  {
    $this->validate();
    $this->currentLogo = $this->logo->temporaryUrl();
  }
  public function save()
  {
    $updatedLogo = $this->profileService->handleLogoUpload($this->logo);
    if ($updatedLogo) {
      $company = Auth::guard('company')->user()->company;
      $this->logo = null;
      $this->currentLogo = Storage::url($company->refresh()->logo);
      Toaster::success('Logo updated successfully!');
    } else {
      Toaster::error('Failed to update logo!');
    }
  }
  public function render()
  {
    return view('livewire.company.profile.upload-logo');
  }
}
