<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => '2',
            'date' => $this->faker->dateTimeBetween('-4 week', '-1 week'),
            'work_start' => '09:00:00',
            'work_end' => '18:00:00',
            'total_break' => '01:00:00',
            'work_time' => '08:00:00',
        ];
    }
}
