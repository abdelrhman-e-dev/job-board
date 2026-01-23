<?php

namespace Database\Seeders;

use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $jobSeekerIds = [
      '01kfp9y9dsfv8ssxbkys7g4649',
      '01kfp9ybpz9fsde7t46jw14bvk',
      '01kfp9y9phv34g89vmb939nc5z',
      '01kfp9ya0q41wbvwqpfx252ttv',
      '01kfp9ya8cghv606mpsaybkz76',
      '01kfp9yag1vwd1esqmk34ywt0s',
      '01kfp9yaqy98vpbtx84wb9y06x',
      '01kfp9yazr3qtznczyd5n8dk4s',
      '01kfp9yb7cdqg18w5e8z1as55j',
      '01kfp9ybf3f12e7w3h7ngk3jqx',
    ];

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

    $documentIds = [
      '01kfpk50teb5nq977mqazke60x',
      '01kfpk50v2emp21p9y0fta6x3g',
      '01kfpk50v6x1pjwrkg89e16k72',
      '01kfpk50vadq82szc7813dwhmy',
      '01kfpk50ve089hk7g6h7ty3s7c',
      '01kfpk50vkp851zycbng84nmgt',
      '01kfpk50vpngqtk8w81gvb4n0e',
      '01kfpk50vthxf60tr7pj63kqdq',
      '01kfpk50txwqznfctnsyz3btcb',
    ];

    $applications = [];

    // Create 9 applications linking job, job seeker, and document
    for ($i = 0; $i < 9; $i++) {
      $applications[] = [
        'job_id' => $jobIds[$i % count($jobIds)],
        'job_seeker_id' => $jobSeekerIds[$i % count($jobSeekerIds)],
        'document_id' => $documentIds[$i % count($documentIds)],
        'cover_letter' => "Dear Hiring Manager, I am very interested in this position. Please find my resume attached.",
        'aiGeneratedScore' => rand(70, 100) / 10, // random score 7.0 - 10.0
        'ai_feedback' => "Strong experience, good fit for the role.",
        'screening_questions' => json_encode([
          ['question' => 'Why do you want this job?', 'answer' => 'I love this field.', 'required' => true],
          ['question' => 'Describe your previous experience.', 'answer' => 'Worked on multiple projects.', 'required' => true]
        ]),
        'status' => 'new',
        'rating' => null,
        'status_history' => json_encode([
          ['status' => 'new', 'timestamp' => Carbon::now()->toDateTimeString()]
        ]),
        'is_read' => false,
        'read_at' => null,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ];
    }

    // Insert into DB
    foreach ($applications as $app) {
      Application::create($app);
    }
  }
}
