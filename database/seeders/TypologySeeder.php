<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Typology;
use Illuminate\Support\Str;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typologies = ['FrontEnd', 'Backend', 'Programming', 'Full stack', 'Design', 'Ops'];

        foreach ($typologies as $typology_name) {
            $new_type = new typology();
            $new_type->name = $typology_name;
            $new_type->slug = Str::slug($typology_name);

            $new_type->save();
        }
    }
}
