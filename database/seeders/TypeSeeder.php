<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   

         $labels = ['Front-end', 'Back-end', 'UX/UI', 'Graphic Design' ];

        foreach($labels as $label){
            
            //Icon to associate to label
            $icon = ($label === 'Front-end' || $label === 'Back-end') ? 'fa-laptop-code' : 'fa-pen-ruler';

            $type = new Type();
            $type->label = $label;
            $type->class_icon = $icon;
            $type->save();
        }
    }
}
