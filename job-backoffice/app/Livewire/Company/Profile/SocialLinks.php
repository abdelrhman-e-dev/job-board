<?php

namespace App\Livewire\Company\Profile;

use App\Services\Company\ProfileService;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SocialLinks extends Component
{
  private ProfileService $profile;
  public array $socialLinks = [];
  public array $originalData = [];
  public $isDirty = false;
  public function boot(ProfileService $profile)
  {
    $this->profile = $profile;
  }
  public function mount()
  {
    $Links = $this->profile->getSocialLinks();
    $rawLinks = json_decode(json_encode($Links), true)['social_links'] ?? [];
    foreach ($rawLinks as $platform => $url) {
      $this->socialLinks[] = [
        'platform' => $platform,
        'url' => $url
      ];
    }
    $this->originalData = $this->socialLinks;
  }
  public function addLink()
  {
    if (count($this->socialLinks) >= 5) {
      Toaster::error('You can only add 5 social links!');
      return;
    }
    $this->socialLinks[] = ['platform' => '', 'url' => ''];
    $this->isDirty = true; 
  }

  public function removeLink($index)
  {
    unset($this->socialLinks[$index]);
    $this->socialLinks = array_values($this->socialLinks);
    $this->isDirty = ($this->socialLinks !== $this->originalData);
  }
  public function update()
  {
    $this->isDirty = ($this->socialLinks !== $this->originalData);
  }
  public function rules()
  {
    return [
      'socialLinks.*.platform' => 'required|string|max:255',
      'socialLinks.*.url' => 'required|url|max:255',
    ];
  }
  public function messages()
  {
    return [
      'socialLinks.*.platform.required' => 'Platform is required',
      'socialLinks.*.url.required' => 'URL is required',
      'socialLinks.*.url.url' => 'URL must be a valid URL',
    ];
  }
  public function save()
  {
    if (!$this->isDirty) {
      return;
    }
    $this->validate([
      'socialLinks.*.platform' => 'required|string|max:255',
      'socialLinks.*.url' => 'required|url',
    ]);
    $formattedLinks = [];
    foreach ($this->socialLinks as $link) {
      if (!empty($link['platform'])) {
        $formattedLinks[$link['platform']] = $link['url'];
      }
    }
    $this->profile->saveSocialLinks($formattedLinks);
    $this->originalData = $this->socialLinks;
    $this->isDirty = false;
    Toaster::success('Social links updated successfully!');
  }
  public function render()
  {
    return view('livewire.company.profile.social-links');
  }
}
