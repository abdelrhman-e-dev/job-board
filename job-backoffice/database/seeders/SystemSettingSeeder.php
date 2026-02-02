<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $settings = [
      // General Settings
      [
        'key' => 'site_name',
        'value' => 'JobBoard Pro',
        'type' => 'string',
        'group' => 'general',
        'description' => 'The name of your job board platform',
        'is_public' => true,
      ],
      [
        'key' => 'site_url',
        'value' => 'https://jobboard.com',
        'type' => 'string',
        'group' => 'general',
        'description' => 'Main website URL',
        'is_public' => true,
      ],
      [
        'key' => 'contact_email',
        'value' => 'contact@jobboard.com',
        'type' => 'string',
        'group' => 'general',
        'description' => 'Contact email address',
        'is_public' => true,
      ],
      [
        'key' => 'support_email',
        'value' => 'support@jobboard.com',
        'type' => 'string',
        'group' => 'general',
        'description' => 'Support email address',
        'is_public' => true,
      ],

      // Email Settings
      [
        'key' => 'mail_driver',
        'value' => 'smtp',
        'type' => 'string',
        'group' => 'email',
        'description' => 'Email driver (smtp, sendgrid, ses)',
        'is_public' => false,
      ],
      [
        'key' => 'mail_host',
        'value' => 'smtp.mailtrap.io',
        'type' => 'string',
        'group' => 'email',
        'description' => 'SMTP host server',
        'is_public' => false,
      ],
      [
        'key' => 'mail_port',
        'value' => '587',
        'type' => 'integer',
        'group' => 'email',
        'description' => 'SMTP port number',
        'is_public' => false,
      ],

      // Payment Settings
      [
        'key' => 'payments_enabled',
        'value' => '1',
        'type' => 'boolean',
        'group' => 'payment',
        'description' => 'Enable or disable payment processing',
        'is_public' => false,
      ],
      [
        'key' => 'stripe_public_key',
        'value' => '',
        'type' => 'string',
        'group' => 'payment',
        'description' => 'Stripe publishable key',
        'is_public' => false,
      ],
      [
        'key' => 'currency',
        'value' => 'USD',
        'type' => 'string',
        'group' => 'payment',
        'description' => 'Default currency',
        'is_public' => true,
      ],

      // Feature Flags
      [
        'key' => 'enable_cv_analysis',
        'value' => '1',
        'type' => 'boolean',
        'group' => 'features',
        'description' => 'Enable AI-powered CV analysis',
        'is_public' => false,
      ],
      [
        'key' => 'maintenance_mode',
        'value' => '0',
        'type' => 'boolean',
        'group' => 'features',
        'description' => 'Put site in maintenance mode',
        'is_public' => false,
      ],
    ];

    foreach ($settings as $setting) {
      SystemSetting::updateOrCreate(
        ['key' => $setting['key']],
        $setting
      );
    }
  }
}
