<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BankAccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'account_number' => $this->faker->unique()->numerify('##########'),
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'balance' => $this->faker->randomFloat(0, 0, 500000000),
            'status' => $this->faker->randomElement(['active', 'inactive', 'banned']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
