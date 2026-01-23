<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $companies = [
      [
        'owner_id' => '01kfp9ybymbhbbb63ng2jdxe9w',
        'name' => 'Tech Solutions Ltd.',
        'slug' => 'tech-solutions-ltd',
        'logo' => 'https://placehold.co/400x400?text=Tech+Solutions+Ltd.',
        'website' => 'https://www.techsolutions.com',
        'description' => 'A leading provider of tech solutions worldwide.',
        'industry' => 'Information Technology',
        'size' => '200-500',
        'location' => 'New York, USA',
        'founded_year' => 2010,
        'verified' => true,
      ],
      [
        'owner_id' => '01kfp9yc6fqecchntx6ph2cy59',
        'name' => 'Green Energy Corp.',
        'slug' => 'green-energy-corp',
        'logo' => 'https://placehold.co/400x400?text=Green+Energy+Corp.',
        'website' => 'https://www.greenenergy.com',
        'description' => 'Innovative solutions for sustainable energy.',
        'industry' => 'Renewable Energy',
        'size' => '100-300',
        'location' => 'San Francisco, USA',
        'founded_year' => 2015,
        'verified' => true,
      ],
      [
        'owner_id' => '01kfp9yceag62jwf92xt03kw7x',
        'name' => 'HealthPlus Inc.',
        'slug' => 'healthplus-inc',
        'logo' => 'https://placehold.co/400x400?text=HealthPlus+Inc.',
        'website' => 'https://www.healthplus.com',
        'description' => 'Committed to improving healthcare services.',
        'industry' => 'Healthcare',
        'size' => '500-1000',
        'location' => 'Chicago, USA',
        'founded_year' => 2005,
        'verified' => true,
      ],
      [
        'owner_id' => '01kfp9ycp5t1eq61wy031sgdye',
        'name' => 'EduWorld',
        'slug' => 'eduworld',
        'logo' => 'https://placehold.co/400x400?text=EduWorld',
        'website' => 'https://www.eduworld.com',
        'description' => 'Transforming education through technology.',
        'industry' => 'Education Technology',
        'size' => '50-150',
        'location' => 'Boston, USA',
        'founded_year' => 2018,
        'verified' => false,
      ],
      [
        'owner_id' => '01kfp9ycxzb33mbe1m8s6b0bf1',
        'name' => 'FinTech Innovations',
        'slug' => 'fintech-innovations',
        'logo' => 'https://placehold.co/400x400?text=FinTech+Innovations',
        'website' => 'https://www.fintechinnovations.com',
        'description' => 'Revolutionizing financial services with technology.',
        'industry' => 'Financial Technology',
        'size' => '300-600',
        'location' => 'London, UK',
        'founded_year' => 2012,
        'verified' => true,
      ],
    ];

    foreach ($companies as $company) {
      Company::create($company);
    }

  }
}
