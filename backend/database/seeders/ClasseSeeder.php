<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = collect([
            [
                "level" => 1, 
                "serie" => [
                    "init" => 1, 
                    "end" => 9
                ]
            ],
            [
                "level" => 2, 
                "serie" => [
                    "init" => 1, 
                    "end" => 3
                ]
            ]
        ]);

        $year = Carbon::now()->format("Y");
        $levels->each(function($object) use ($year){
            
            for($serie = $object["serie"]["init"]; $serie <= $object["serie"]["end"]; $serie++){
                Classe::create([
                    "school_id" => School::first()->id,
                    "nivel_id" => $object["level"],
                    "serie" => "{$serie}° A",
                    "turn" => $serie < 6 ? "M" : "T",
                    "year" => $year
                ]);
            }
        });

        return $this->command->info("Added Classes Successfully.");
    }
}
