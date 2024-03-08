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
            'user_id' => 1,
            'date' => '2024-03-07',
            'work_start' => '09:00:00',
            'work_end' => '18:00:00',
            'break_start' => '12:00:00',
            'break_end' => '13:00:00',
            'break_time' => '01:00:00',
            'work_time' => '08:00:00',
        ];
    }
}
