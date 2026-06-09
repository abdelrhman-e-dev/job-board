<?php

namespace App\Livewire\Company\Profile;

use App\Services\Company\ProfileService;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class BasicInformation extends Component
{
  protected ProfileService $profileService;

  // Individual public properties
  public string $name = '';
  public string $description = '';
  public string $industry = '';
  public string $specialization = '';
  public string $size = '';
  public string $founded_year = '';
  public string $website = '';

  public array $companySizes = [];
  public array $originalData = [];
  public bool $isDirty = false;
  public function boot(ProfileService $profileService)
  {
    $this->profileService = $profileService;
  }

  public function mount()
  {
    $basicInfo = $this->profileService->getBasicInfo();
    $this->name = $basicInfo->name ?? '';
    $this->description = $basicInfo->description ?? '';
    $this->industry = $basicInfo->industry ?? '';
    $this->specialization = $basicInfo->specialization ?? '';
    $this->size = $basicInfo->size ?? '';
    $this->founded_year = $basicInfo->founded_year ?? '';
    $this->website = $basicInfo->website ?? '';
    $this->companySizes = $this->profileService->getCompanySizes();

    $this->originalData = [
      'name' => $this->name,
      'description' => $this->description,
      'industry' => $this->industry,
      'specialization' => $this->specialization,
      'size' => $this->size,
      'founded_year' => $this->founded_year,
      'website' => $this->website,
    ];
  }
  public function updated($property): void
  {
    $tracked = ['name', 'description', 'industry', 'specialization', 'size', 'founded_year', 'website'];

    if (in_array($property, $tracked)) {
      $this->isDirty = $this->name !== $this->originalData['name'] ||
        $this->description !== $this->originalData['description'] ||
        $this->industry !== $this->originalData['industry'] ||
        $this->specialization !== $this->originalData['specialization'] ||
        $this->size !== $this->originalData['size'] ||
        $this->founded_year !== $this->originalData['founded_year'] ||
        $this->website !== $this->originalData['website'];
    }
  }
  public function rules()
  {
    return [
      'name' => 'required|string|max:255',
      'description' => 'nullable|string|max:1000',
      'industry' => 'nullable|string|max:255',
      'specialization' => 'nullable|string|max:255',
      'size' => 'nullable|string',
      'founded_year' => 'nullable|digits:4',
      'website' => 'nullable|url',
    ];
  }
  public function save()
  {
    $this->validate();

    $current = [
      'name' => $this->name,
      'description' => $this->description,
      'industry' => $this->industry,
      'specialization' => $this->specialization,
      'size' => $this->size,
      'founded_year' => $this->founded_year,
      'website' => $this->website,
    ];

    $changed = array_diff_assoc($current, $this->originalData);

    if (empty($changed)) {
      return;
    }
    $this->profileService->saveBasicInfo($changed);
    $this->originalData = $current;
    $this->isDirty = false;
    Toaster::success('Basic information updated successfully!');
  }

  public function render()
  {
    return view('livewire.company.profile.basic-information', [
      'companySizes' => $this->companySizes,
    ]);
  }
}