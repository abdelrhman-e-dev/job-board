<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  protected $skills_array = [
    "JavaScript",
    "Python",
    "Java",
    "TypeScript",
    "C++",
    "C#",
    "PHP",
    "Ruby",
    "Go",
    "Rust",
    "React",
    "Vue.js",
    "Angular",
    "Node.js",
    "Django",
    "Flask",
    "Spring Boot",
    "Laravel",
    "Ruby on Rails",
    "Express.js",
    "MySQL",
    "PostgreSQL",
    "MongoDB",
    "Redis",
    "Oracle Database",
    "Docker",
    "Kubernetes",
    "Jenkins",
    "Terraform",
    "Ansible",
    "AWS",
    "Azure",
    "Google Cloud Platform",
    "Git",
    "Machine Learning",
    "Deep Learning",
    "TensorFlow",
    "PyTorch",
    "Data Analysis",
    "SQL",
    "Tableau",
    "Power BI",
    "UI/UX Design",
    "Figma",
    "Adobe XD",
    "REST APIs",
    "GraphQL",
    "Microservices",
    "Agile",
    "Scrum"
  ];
  public function run(): void
  {
    foreach ($this->skills_array as $key => $value) {
      Skill::create([
        'name' => $value,
        'slug' => strtolower(str_replace(' ', '-', $value))
      ]);
    }
  }
}
