<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users = [
            [
                'name' => 'Developer',
                'username' => 'Developer',
                'password' => '$2y$12$JtBDML5Fvb6txi9HqJewNO3DEaOQbrmMn7Qwnt4wnaMEPddxyoXz2',
            ],
            [
                'name' => 'Idrus',
                'username' => 'idrus',
                'password' => '$2y$12$9s4ocVa0U3UwUXG5jC4aY.WY41ff1rqLLysv7/hT37sClJTrGTrqy'
            ],
            [
                'name' => 'Arif',
                'username' => 'arif',
                'password' => '$2y$12$sdK2bX/acSItOH8kK3GkLeGINJ03xEXnaRCtnK5weG0KSQW8aHG0a'
            ],
            [
                'name' => 'Administrator',
                'username' => 'administrator',
                'password' => '$2y$12$s.beQvS6jHmKuZfm7Z0Jp.maIj1HfpUvk/f7zIvCXnZGVmmoDlD8u'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
