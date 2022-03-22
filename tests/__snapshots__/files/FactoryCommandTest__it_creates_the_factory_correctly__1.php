<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker,
            'email' => $this->faker,
            'email_verified_at' => $this->faker,
            'password' => $this->faker,
            'remember_token' => $this->faker,
        ];
    }
}
