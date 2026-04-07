<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'date_of_birth' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'password' => static::$password ??= Hash::make('password'),
            'user_flg' => fake()->numberBetween(0, 2),
            'del_flg' => fake()->numberBetween(0, 1),
            'deleted_at' => fake()->dateTime(),
            'deleted_by' => fake()->numberBetween(1, 100),
            'created_at' => fake()->dateTime(),
            'created_by' => fake()->numberBetween(1, 100),
            'updated_at' => fake()->dateTime(),
            'updated_by' => fake()->numberBetween(1, 100),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
