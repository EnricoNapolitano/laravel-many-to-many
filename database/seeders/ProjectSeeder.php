<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //getting technology ids
        $technologies_ids = Technology::select('id')->pluck('id')->toArray();

        for($i=0; $i<10; $i++){
            $project = new Project();
            $project->title = $faker->text(50);
            $project->content = $faker->paragraphs(30, true);
            $project->type_id = rand(1, 4);
            $project->slug = Str::slug($project->title, '-');
            $project->save();

            //after saving project in db, create randomly relations between projects and technologies
            $project_technologies = [];
            foreach($technologies_ids as $technology_id){
                if(rand(0,1))$project_technologies[] = $technology_id;
            }
            $project->technologies()->attach($project_technologies);

        }
    }
}
