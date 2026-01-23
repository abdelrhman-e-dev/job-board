<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SkillSeeder::class,
            UserSkillSeeder::class,
            CompaniesSeeder::class,
            JobCategorySeeder::class,
            JobVacancySeeder::class,
            JobSkillSeeder::class,
            DocumentsSeeder::class,
            ApplicationSeeder::class,
        ]);
    }
}
