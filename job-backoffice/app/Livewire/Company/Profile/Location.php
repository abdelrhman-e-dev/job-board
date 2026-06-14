<?php

namespace App\Livewire\Company\Profile;
use App\Services\Company\ProfileService;
use Masmerise\Toaster\Toaster;
use Livewire\Component;

class Location extends Component
{
  protected ProfileService $profileService;
  public string $address = '';
  public string $city = '';
  public string $country = '';
  public array $originalData = [];
  public bool $isDirty = false;
  public function boot(ProfileService $profileService)
  {
    $this->profileService = $profileService;
  }
  public function mount()
  {
    $location = $this->profileService->getLocation();
    $this->address = $location->address ?? '';
    $this->city = $location->city ?? '';
    $this->country = $location->country ?? '';
    $this->originalData = [
      'address' => $this->address,
      'city' => $this->city,
      'country' => $this->country,
    ];
  }
  public function updated($property): void
  {
    $tracked = ['address', 'city', 'country'];

    if (in_array($property, $tracked)) {
      $this->isDirty = $this->address !== $this->originalData['address'] ||
        $this->city !== $this->originalData['city'] ||
        $this->country !== $this->originalData['country'];
    }
  }
  public function rules()
  {
    return [
      'address' => 'required|string|max:255',
      'city' => 'required|string|max:255',
      'country' => 'required|string|max:255',
    ];
  }
  public function messages()
  {
    return [
      'address.required' => 'Address is required',
      'city.required' => 'City is required',
      'country.required' => 'Country is required',
    ];
  } 
  public function save()
  {
    $this->validate();

    $current = [
      'address' => $this->address,
      'city' => $this->city,
      'country' => $this->country,
    ];

    $changed = array_diff_assoc($current, $this->originalData);

    if (empty($changed)) {
      return;
    }
    $this->profileService->saveLocation($changed);
    $this->originalData = $current;
    $this->isDirty = false;
    Toaster::success('Location updated successfully!');
  }
  public function render()
  {
    return view('livewire.company.profile.location');
  }
}
