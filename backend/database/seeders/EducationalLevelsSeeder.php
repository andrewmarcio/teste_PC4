<?php

namespace Database\Seeders;

use App\Models\EducationalLevel;
use Illuminate\Database\Seeder;

class EducationalLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EducationalLevel::create(["description" => "Fundamental"]);
        EducationalLevel::create(["description" => "Médio"]);

        return $this->command->info("Added Educational Levels Successfully.");
    }
}
