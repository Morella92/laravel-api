<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Typology;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $typology_ids = Typology::all()->pluck('id')->all();
        $technology_ids = Technology::all()->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {

            $project = new Project();
            $project->title = $faker->unique()->sentence($faker->numberBetween(5, 10));
            $project->client = $faker->name();
            $project->content = $faker->paragraphs(3, true);
            $project->slug = Str::slug($project->title, '-');
            $project->typology_id = $faker->optional()->randomElement($typology_ids);
            $project->url = $faker->optional()->url();
            $project->save();

            // fare dopo il metodo save altrimenti il post non avra un id
            $project->technologies()->attach($faker->randomElements($technology_ids, rand(0, 5)));
        }
    }
}
