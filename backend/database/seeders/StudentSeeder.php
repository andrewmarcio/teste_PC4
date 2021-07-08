<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $classes = Classe::all();

        $classes->each(function(Classe $classe){
            Student::factory(10)->create()->each(function($student) use ($classe){
                $student->classes()->sync([$classe->id]);
            });
        });

        return $this->command->info("Added Students Successfully.");
    }
}
