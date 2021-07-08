<?php

namespace Database\Seeders;

use App\Models\School;
use Database\Factories\SchoolFactory;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::factory()->create();

        return $this->command->info("Added School Successfuly.");
    }
}
