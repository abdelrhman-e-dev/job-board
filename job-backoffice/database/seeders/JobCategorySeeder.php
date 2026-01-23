<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $jobCategories = [
      [
        'name' => 'Software Development',
        'slug' => 'software-development'
      ],
      [
        'name' => 'Data Science',
        'slug' => 'data-science'
      ],
      [
        'name' => 'DevOps',
        'slug' => 'devops'
      ],
      [
        'name' => 'Frontend Development',
        'slug' => 'frontend-development'
      ],
      [
        'name' => 'Backend Development',
        'slug' => 'backend-development'
      ],
      [
        'name' => 'Design',
        'slug' => 'design'
      ],
      [
        'name' => 'Marketing',
        'slug' => 'marketing'
      ],
      [
        'name' => 'Sales',
        'slug' => 'sales'
      ],
      [
        'name' => 'Customer Support',
        'slug' => 'customer-support'
      ],
      [
        'name' => 'Human Resources',
        'slug' => 'human-resources'
      ],
      [
        'name' => 'Finance',
        'slug' => 'finance'
      ],
      [
        'name' => 'Operations',
        'slug' => 'operations'
      ],
      [
        'name' => 'Product Management',
        'slug' => 'product-management'
      ],
      [
        'name' => 'Education',
        'slug' => 'education'
      ]
    ];
    foreach ($jobCategories as $category) {
      JobCategory::create($category);
    }
  }
}
