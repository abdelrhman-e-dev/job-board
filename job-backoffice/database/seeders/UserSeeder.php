<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // System Admin
        // ========================
        User::create([
            'first_name' => 'Root',
            'last_name'  => 'Admin',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('123456789'),
            'role'       => 'system-admin',
            'phone'      => '1000000001',
            'city'       => 'Admin City',
            'country'    => 'Admin Country',
        ]);

        // ========================
        // Job Seekers (10)
        // ========================
        foreach (range(1, 10) as $i) {
            User::create([
                'first_name' => "JobSeeker{$i}",
                'last_name'  => "User{$i}",
                'email'      => "jobseeker{$i}@example.com",
                'password'   => Hash::make(value: 'password'),
                'role'       => 'job-seeker',
                'phone'      => "200000000{$i}",
                'avatar'     => "https://placehold.co/400x400?text=Job+Seeker+{$i}",
                'bio'        => "Bio for job seeker {$i}",
                'city'       => "City {$i}",
                'country'    => "Country {$i}",
            ]);
        }

        // ========================
        // Company Owners (5)
        // ========================
        foreach (range(1, 5) as $i) {
            User::create([
                'first_name' => "CompanyOwner{$i}",
                'last_name'  => "Owner{$i}",
                'email'      => "companyowner{$i}@example.com",
                'password'   => Hash::make('password'),
                'role'       => 'company-owner',
                'company_id' => "COMP-{$i}",
                'phone'      => "300000000{$i}",
                'avatar'     => "https://placehold.co/400x400?text=Company+Owner+{$i}",
                'bio'        => "Bio for company owner {$i}",
                'city'       => "City {$i}",
                'country'    => "Country {$i}",
            ]);
        }
    }
}
