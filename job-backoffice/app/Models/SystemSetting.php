<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache as FacadesCache;

class SystemSetting extends Model
{
  protected $table = 'system_settings';
  protected $fillable = [
    'key',
    'value',
    'type',
    'group',
    'description',
    'is_public',
  ];
  public $casts = [
    'is_public' => 'boolean'
  ];

  /**
   * Get setting type value with proper type cast
   */
  public function getTypeValue()
  {
    return match ($this->type) {
      'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
      'integer' => (int) $this->value,
      'json' => json_decode($this->value),
      default => $this->value,
    };
  }
  /**
   * Get a setting by key
   * 
   * Usage SystemSetting::get('site_name' , 'Default value')
   */

  public static function get(string $key, $default = null)
  {
    $cacheKey = 'setting_' . $key;
    return FacadesCache::remember($cacheKey, 3600, function () use ($key, $default) {
      $setting = self::where('key', $key)->first();
      return $setting ? $setting->getTypeValue() : $default;
    });
  }

  /**
   * Set a setting value
   * 
   * Usage: SystemSetting::set('site_name', 'My Site')
   */
  public static function set(string $key, $value, string $type = 'string', string $group = 'general')
  {
    // Convert value to string for storage
    if ($type === 'json') {
      $value = json_encode($value);
    } elseif ($type === 'boolean') {
      $value = $value ? '1' : '0';
    }

    $setting = self::updateOrCreate(
      ['key' => $key],
      [
        'value' => $value,
        'type' => $type,
        'group' => $group
      ]
    );

    // Clear cache
    FacadesCache::forget('setting_' . $key);

    return $setting;
  }
  /**
   * Get all settings by group
   * 
   * Usage: SystemSetting::getByGroup('email')
   */
  public static function getByGroup(string $group)
  {
    return self::where('group', $group)
      ->get()
      ->mapWithKeys(function ($setting) {
        return [$setting->key => $setting->getTypedValue()];
      })
      ->toArray();
  }
}

