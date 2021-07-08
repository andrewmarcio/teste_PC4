<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => "School ". $this->faker->name(),
            "address" => "Street". $this->faker->name(),
            "neighborhood" => $this->faker->name(),
            "number" => rand(3),
            "zip" => rand(8)
        ];
    }
}
