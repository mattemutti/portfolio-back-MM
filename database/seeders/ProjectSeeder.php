<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->words(2, true);
            $project->cover_image = $faker->url();
            $project->slug = Str::of($project->name)->slug('-');
            $project->description = $faker->text(400);
            $project->create_data = $faker->date('Y_m_d');
            $project->repo = $faker->url();
            $project->code = $faker->url();
            $project->video = $faker->url();
            $project->save();
        }
    }
}
