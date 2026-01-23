<?php

namespace Database\Seeders;

use App\Models\JobSkill;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSkillSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $jobSkills = [];

    // Job IDs
    $jobIds = [
      '01kfpea5mm05jjxcvaqb41cwkp',
      '01kfpea5nbafnaveqngvv6cdms',
      '01kfpea5ngfj7zegtdsezf27e4',
      '01kfpea5nmgcgwvnqhz7nm2g77',
      '01kfpea5nrvmjqb44bgeqgpez1',
      '01kfpea5nx227b9nkmpvan5gmp',
      '01kfpea5p1kv1sdr6j6xgdevq5',
      '01kfpea5p5w9m28ddht0qd69kx',
      '01kfpea5p92vhn6k1p90pnqkav',
    ];

    // Skill IDs
    $skillIds = [
      '01kfpa72gq11b3ctkr79wx1apa', // JavaScript
      '01kfpa72j0mev64b4smxne7wtj', // Python
      '01kfpa72jcgype7sa8wr30qdw9', // Java
      '01kfpa72jp6wjs5k1wzsg9pxdd', // TypeScript
      '01kfpa72jtjej8v2xp56v1mq8n', // C++
      '01kfpa72jyyvmnabberqz5962m', // C#
      '01kfpa72k2kwp2tcrbkxdb243b', // PHP
      '01kfpa72k77jwgygy7rxd2xb1v', // Ruby
      '01kfpa72kb21gsk7erkfb6a69r', // Go
      '01kfpa72kfxtctdm443457ebcw', // Rust
      '01kfpa72kmc50kyvxyyqdrjsd8', // React
      '01kfpa72krea5thq1rjcswmzx7', // Vue.js
      '01kfpa72kwqqdynhgkx9s1eej2', // Angular
      '01kfpa72m0qhvf1yk6aed8nfb2', // Node.js
      '01kfpa72m4jbhfr4szw2jr0j1a', // Django
      '01kfpa72m7p5t35x3eyymn0wtn', // Flask
      '01kfpa72mbyscvagc5q904txj1', // Spring Boot
      '01kfpa72mfcs4vgp09vhn3prvq', // Laravel
      '01kfpa72mk5netz21qebsqyjpw', // Ruby on Rails
      '01kfpa72mrcpyryt1vby6nkh7w', // Express.js
      '01kfpa72mvx0p7rnb5fwyaj1rn', // MySQL
      '01kfpa72myagnc3mfpbry0y7mp', // PostgreSQL
      '01kfpa72n1hf5qa9wyfk07w8yk', // MongoDB
      '01kfpa72n557rbbht88yzrdgwa', // Redis
      '01kfpa72n9v1d5vp5qahz2qjfw', // Oracle Database
      '01kfpa72nc0svy9p6xy4w3gpb8', // Docker
      '01kfpa72nf93gq10q19wg2p9zr', // Kubernetes
      '01kfpa72nkgtgj4332cg9v0gtq', // Jenkins
      '01kfpa72npjwtg5htw1111tnfc', // Terraform
      '01kfpa72nt3xbkasry8dfz1f2n', // Ansible
      '01kfpa72nx3qe1yepd6jvb34kw', // AWS
      '01kfpa72p1ppq0kpy9zdc60fww', // Azure
      '01kfpa72p4y444wfetwzaytf2s', // Google Cloud Platform
      '01kfpa72p7kww3ktj3g73fjrw0', // Git
      '01kfpa72pasqjvfkbbwjstkv9r', // Machine Learning
      '01kfpa72pd1q35q6m1jbk0v8fw', // Deep Learning
      '01kfpa72pgm9gd36a0mscg35hz', // TensorFlow
      '01kfpa72pmy66jced0fa27y8tw', // PyTorch
      '01kfpa72pqd7wtgf6bycq3cqz6', // Data Analysis
      '01kfpa72ptcztbf4c0kpjz9dpq', // SQL
      '01kfpa72pxyv45bhsp616jpye5', // Tableau
      '01kfpa72q0w3k44amvc46q738b', // Power BI
      '01kfpa72q3djdtfhker1y96qdc', // UI/UX Design
      '01kfpa72q6cyr905w5tt9qrjf4', // Figma
      '01kfpa72q9w1jq0zfqmps2r32p', // Adobe XD
      '01kfpa72qcyp85dvrntschwscb', // REST APIs
      '01kfpa72qfqgkck1sjnzms4gzv', // GraphQL
      '01kfpa72qk3r0pcbkfk5bd2hez', // Microservices
      '01kfpa72qp4e991rs5epfgemaz', // Agile
      '01kfpa72qs6ejhrgqenkqvetvn', // Scrum
    ];

    // Assign 4 skills per job
    $skillIndex = 0;

    foreach ($jobIds as $jobId) {
      for ($i = 0; $i < 4; $i++) {
        $jobSkills[] = [
          'job_id' => $jobId,
          'skill_id' => $skillIds[$skillIndex],
          'is_required' => true,
          'created_at' => Carbon::now(),
        ];
        $skillIndex++;
        if ($skillIndex >= count($skillIds))
          $skillIndex = 0;
      }
    }

    // Insert into DB using create
    foreach ($jobSkills as $jobSkill) {
      JobSkill::create($jobSkill);
    }

  }
}