<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\UserType; // Make sure this enum exists and is imported

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'prefixname' => $this->faker->title,
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->optional()->firstName,
            'lastname' => $this->faker->lastName,
            'suffixname' => $this->faker->optional()->suffix,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Don't forget: bcrypt or Hash::make
            'photo' => null,
            'type' => UserType::USER, // or just 'user' if you aren’t using Enum
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }
}
