<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Icons and labels
        $technologies = [
            ['label' => 'HTML', 'class_icon' => 'fa-brands fa-html5'],
            ['label' => 'CSS', 'class_icon' => 'fa-brands fa-css3-alt'],
            ['label' => 'SASS', 'class_icon' => 'fa-brands fa-sass'],
            ['label' => 'Bootstrap', 'class_icon' => 'fa-brands fa-bootstrap'],
            ['label' => 'Vue', 'class_icon' => 'fa-brands fa-vuejs'],
            ['label' => 'Php', 'class_icon' => 'fa-brands fa-php'],
            ['label' => 'Laravel', 'class_icon' => 'fa-brands fa-laravel'],
        ];
        
        foreach($technologies as $technology){
            $new_technology = new Technology();
            $new_technology->label = $technology['label'];
            $new_technology->class_icon = $technology['class_icon'];
            $new_technology->save();
        }
    }
}
