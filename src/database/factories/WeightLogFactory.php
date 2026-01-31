<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    public function definition(): array
    {
        // 例: "01:30:00" みたいな文字列
        $h = str_pad((string) $this->faker->numberBetween(0, 23), 2, '0', STR_PAD_LEFT);
        $m = str_pad((string) $this->faker->randomElement([0, 15, 30, 45]), 2, '0', STR_PAD_LEFT);

        return [
            'date' => $this->faker->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 45, 80),  // 小数1桁
            'calories' => $this->faker->numberBetween(1200, 2600),
            'exercise_time' => "{$h}:{$m}:00",
            'exercise_content' => $this->faker->optional()->realText(30),
        ];
    }
}
