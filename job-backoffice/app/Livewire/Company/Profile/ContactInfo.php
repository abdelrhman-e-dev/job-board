<?php

namespace App\Livewire\Company\Profile;

use App\Services\Company\ProfileService;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ContactInfo extends Component
{
  protected ProfileService $profileService;

  // Individual public properties
  public string $contact_email = '';
  public string $contact_phone = '';

  public array $originalData = [];
  public bool $isDirty = false;
  public function boot(ProfileService $profileService)
  {
    $this->profileService = $profileService;
  }
  public function mount()
  {
    $contactInfo = $this->profileService->getContactInfo();
    $this->contact_email = $contactInfo->contact_email ?? '';
    $this->contact_phone = $contactInfo->contact_phone ?? '';
    $this->originalData = [
      'contact_email' => $this->contact_email,
      'contact_phone' => $this->contact_phone,
    ];
  }
  public function updated($property): void
  {
    $tracked = ['contact_email', 'contact_phone'];

    if (in_array($property, $tracked)) {
      $this->isDirty = $this->contact_email !== $this->originalData['contact_email'] ||
        $this->contact_phone !== $this->originalData['contact_phone'];
    }
  }
  public function rules()
  {
    return [
      'contact_email' => 'required|email|max:255',
      'contact_phone' => 'nullable|string|max:255|regex:/^01[0125]\d{8}$/',
    ];
  }
  public function messages()
  {
    return [
      'contact_email.required' => 'Contact email is required',
      'contact_email.email' => 'Contact email must be a valid email',
      'contact_phone.regex' => 'Phone number must be 11 digits starting with 01',
    ];
  }
  public function save()
  {
    $this->validate();

    $current = [
      'contact_email' => $this->contact_email,
      'contact_phone' => $this->contact_phone,
    ];

    $changed = array_diff_assoc($current, $this->originalData);

    if (empty($changed)) {
      return;
    }
    $this->profileService->saveContactInfo($changed);
    $this->originalData = $current;
    $this->isDirty = false;
    Toaster::success('Contact information updated successfully!');
  }
  public function render()
  {
    return view('livewire.company.profile.contact-info');
  }
}
