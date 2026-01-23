<?php

namespace Database\Seeders;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
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

        $documentTypes = ['resume', 'cover_letter', 'portfolio', 'certificate', 'other'];

        // Create 9 documents
        for ($i = 0; $i < 9; $i++) {
            $userId = $jobSeekerIds[$i % count($jobSeekerIds)];

            Document::create([
                'user_id' => $userId,
                'file_name' => "document_{$i}.pdf",
                'file_path' => "uploads/documents/document_{$i}.pdf",
                'file_url' => "https://example-bucket.s3.amazonaws.com/uploads/documents/document_{$i}.pdf",
                'type' => $documentTypes[$i % count($documentTypes)],
                'mime_type' => 'application/pdf',
                'file_size' => rand(100000, 500000), // random size in bytes
                'is_primary' => $i % 2 === 0 ? true : false,
                'parsed_data' => json_encode([
                    'text_length' => rand(100, 1000),
                    'keywords' => ['example', 'document', 'seed']
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
