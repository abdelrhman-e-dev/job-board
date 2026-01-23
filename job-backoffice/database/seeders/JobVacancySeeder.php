<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobVacancySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $jobVacancies = [

      [
        'company_id' => '01kfpcgzfvd28p4w501s46r9ea',
        'category_id' => '01kfpd017qay76ds8jwrhq9agt', // Frontend Development
        'posted_by' => '01kfp9ybymbhbbb63ng2jdxe9w',
        'title' => 'Senior Frontend Developer',
        'slug' => 'senior-frontend-developer-tech-solutions',
        'description' => 'Build scalable frontend applications using React and TypeScript.',
        'requirements' => '5+ years React, strong UI/UX fundamentals.',
        'type' => 'full-time',
        'level' => 'senior',
        'location' => 'New York, USA',
        'salary_min' => 120000,
        'salary_max' => 160000,
        'salary_currency' => 'USD',
        'screening_questions' => '[{"question":"How many years of React experience do you have?","required":true}]',
        'status' => 'active',
        'views_count' => 220,
        'applications_count' => 18,
        'deadline' => '2026-03-15 23:59:59',
        'published_at' => '2026-01-15 10:00:00',
      ],

      [
        'company_id' => '01kfpcgzfvd28p4w501s46r9ea',
        'category_id' => '01kfpd017twvetrrpmtqrs86rz', // Backend Development
        'posted_by' => '01kfp9ybymbhbbb63ng2jdxe9w',
        'title' => 'Backend Laravel Developer',
        'slug' => 'backend-laravel-developer-tech-solutions',
        'description' => 'Develop REST APIs and backend services using Laravel.',
        'requirements' => 'Strong Laravel, MySQL, API design.',
        'type' => 'full-time',
        'level' => 'mid',
        'location' => 'Remote',
        'salary_min' => 95000,
        'salary_max' => 125000,
        'salary_currency' => 'USD',
        'screening_questions' => '[{"question":"Laravel experience in years?","required":true}]',
        'status' => 'active',
        'views_count' => 150,
        'applications_count' => 11,
        'deadline' => '2026-03-05 23:59:59',
        'published_at' => '2026-01-18 09:00:00',
      ],

      [
        'company_id' => '01kfpcgzgqe8s02yxhma953c86',
        'category_id' => '01kfpd016xeh090enxd6yy5yex', // Software Development
        'posted_by' => '01kfp9yc6fqecchntx6ph2cy59',
        'title' => 'Renewable Energy Software Engineer',
        'slug' => 'renewable-energy-software-engineer-green-energy',
        'description' => 'Build software systems supporting renewable energy platforms.',
        'requirements' => 'Software engineering experience, energy systems a plus.',
        'type' => 'full-time',
        'level' => 'mid',
        'location' => 'San Francisco, USA',
        'salary_min' => 105000,
        'salary_max' => 145000,
        'salary_currency' => 'USD',
        'screening_questions' => '[{"question":"Energy sector experience?","required":false}]',
        'status' => 'active',
        'views_count' => 120,
        'applications_count' => 9,
        'deadline' => '2026-02-28 23:59:59',
        'published_at' => '2026-01-20 11:00:00',
      ],

      [
        'company_id' => '01kfpcgzgw0yds7h4zkv50wgb5',
        'category_id' => '01kfpd017ejhhjfcbhn2dt4p3e', // Data Science
        'posted_by' => '01kfp9yceag62jwf92xt03kw7x',
        'title' => 'Healthcare Data Analyst',
        'slug' => 'healthcare-data-analyst-healthplus',
        'description' => 'Analyze healthcare datasets to improve patient outcomes.',
        'requirements' => 'SQL, Python, healthcare data experience.',
        'type' => 'full-time',
        'level' => 'mid',
        'location' => 'Chicago, USA',
        'salary_min' => 85000,
        'salary_max' => 115000,
        'salary_currency' => 'USD',
        'screening_questions' => '[{"question":"Have you worked with healthcare data?","required":true}]',
        'status' => 'active',
        'views_count' => 90,
        'applications_count' => 6,
        'deadline' => '2026-03-10 23:59:59',
        'published_at' => '2026-01-22 09:30:00',
      ],

      [
        'company_id' => '01kfpcgzgw0yds7h4zkv50wgb5',
        'category_id' => '01kfpd017k1z5bbcbhsqas8r7m', // DevOps
        'posted_by' => '01kfp9yceag62jwf92xt03kw7x',
        'title' => 'DevOps Engineer',
        'slug' => 'devops-engineer-healthplus',
        'description' => 'Maintain CI/CD pipelines and cloud infrastructure.',
        'requirements' => 'AWS, Docker, CI/CD experience.',
        'type' => 'full-time',
        'level' => 'mid',
        'location' => 'Chicago, USA',
        'salary_min' => 100000,
        'salary_max' => 135000,
        'salary_currency' => 'USD',
        'screening_questions' => '[{"question":"Cloud platforms used?","required":true}]',
        'status' => 'active',
        'views_count' => 75,
        'applications_count' => 5,
        'deadline' => '2026-03-18 23:59:59',
        'published_at' => '2026-01-25 10:00:00',
      ],

      [
        'company_id' => '01kfpcgzgzwvmzpytg5mfha2h7',
        'category_id' => '01kfpd018wdeepwwpm3qdjv4wc', // Product Management
        'posted_by' => '01kfp9ycp5t1eq61wy031sgdye',
        'title' => 'EdTech Product Manager',
        'slug' => 'edtech-product-manager-eduworld',
        'description' => 'Drive product strategy for online education platforms.',
        'requirements' => 'Product management experience, EdTech preferred.',
        'type' => 'full-time',
        'level' => 'senior',
        'location' => 'Boston, USA',
        'salary_min' => 110000,
        'salary_max' => 150000,
        'salary_currency' => 'USD',
        'screening_questions' => '[{"question":"Products you launched?","required":true}]',
        'status' => 'active',
        'views_count' => 100,
        'applications_count' => 8,
        'deadline' => '2026-03-25 23:59:59',
        'published_at' => '2026-01-28 14:00:00',
      ],

      [
        'company_id' => '01kfpcgzgzwvmzpytg5mfha2h7',
        'category_id' => '01kfpd0191gwvejdphcyt4tz4n', // Education
        'posted_by' => '01kfp9ycp5t1eq61wy031sgdye',
        'title' => 'Online Curriculum Designer',
        'slug' => 'online-curriculum-designer-eduworld',
        'description' => 'Design engaging online learning content.',
        'requirements' => 'Curriculum design, LMS experience.',
        'type' => 'full-time',
        'level' => 'mid',
        'location' => 'Remote',
        'salary_min' => 70000,
        'salary_max' => 95000,
        'salary_currency' => 'USD',
        'screening_questions' => '[{"question":"Curriculum projects completed?","required":true}]',
        'status' => 'active',
        'views_count' => 65,
        'applications_count' => 4,
        'deadline' => '2026-03-08 23:59:59',
        'published_at' => '2026-01-30 10:00:00',
      ],

      [
        'company_id' => '01kfpcgzh3jy3yqt9zzaa7fbha',
        'category_id' => '01kfpd018jc67jan2jqvf7xe58', // Finance
        'posted_by' => '01kfp9ycxzb33mbe1m8s6b0bf1',
        'title' => 'FinTech Backend Engineer',
        'slug' => 'fintech-backend-engineer-fintech-innovations',
        'description' => 'Develop secure financial backend systems.',
        'requirements' => 'Backend engineering, financial systems.',
        'type' => 'full-time',
        'level' => 'senior',
        'location' => 'London, UK',
        'salary_min' => 95000,
        'salary_max' => 140000,
        'salary_currency' => 'GBP',
        'screening_questions' => '[{"question":"FinTech experience?","required":true}]',
        'status' => 'active',
        'views_count' => 160,
        'applications_count' => 13,
        'deadline' => '2026-03-12 23:59:59',
        'published_at' => '2026-02-01 10:00:00',
      ],

      [
        'company_id' => '01kfpcgzh3jy3yqt9zzaa7fbha',
        'category_id' => '01kfpd018cx0mgf017zgm90vna', // Human Resources
        'posted_by' => '01kfp9ycxzb33mbe1m8s6b0bf1',
        'title' => 'HR Business Partner',
        'slug' => 'hr-business-partner-fintech-innovations',
        'description' => 'Support organizational growth and people strategy.',
        'requirements' => 'HR experience in fast-growing companies.',
        'type' => 'full-time',
        'level' => 'mid',
        'location' => 'London, UK',
        'salary_min' => 65000,
        'salary_max' => 90000,
        'salary_currency' => 'GBP',
        'screening_questions' => '[{"question":"HR systems used?","required":true}]',
        'status' => 'active',
        'views_count' => 55,
        'applications_count' => 4,
        'deadline' => '2026-03-02 23:59:59',
        'published_at' => '2026-02-03 09:00:00',
      ],

    ];
    foreach ($jobVacancies as $vacancyData) {
      JobVacancy::create($vacancyData);
    }
  }
}
