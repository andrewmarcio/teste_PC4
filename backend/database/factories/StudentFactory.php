<?php

namespace Database\Factories;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "phone" => str_pad(rand(1,99), 2, "0", STR_PAD_LEFT)."9".rand(1000,9999).rand(1000,9999),
            "email" => $this->faker->safeEmail(),
            "birthday" => Carbon::now()->subDays(rand(1, 365) * rand(1, 18)),
            "gender" => ["M", "F"][rand(0, 1)]
        ];
    }
}
