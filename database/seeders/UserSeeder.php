<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'prefixname' => 'Mr',
                'firstname' => 'John',
                'middlename' => 'A.',
                'lastname' => 'Doe',
                'suffixname' => null,
                'username' => 'john_doe',
                'email' => 'vishnu@gmail.com',
                'password' => Hash::make('password'),
                'photo' => 'default.jpg',
                'type' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'prefixname' => 'Ms',
                'firstname' => 'Jane',
                'middlename' => null,
                'lastname' => 'Smith',
                'suffixname' => 'Jr.',
                'username' => 'jane_smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('securepass'),
                'photo' => null,
                'type' => 'user',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
