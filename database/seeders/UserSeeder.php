<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Plant;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Random\RandomException;

class UserSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $louis = User::create([
            'name' => 'Louis',
            'email' => 'louisreynard919@gmail.com',
            'password' => Hash::make('password'),
            'avatar' => null,
        ]);

        $plants = Plant::factory(random_int(5, 10))->create([
            'user_id' => $louis->id
        ]);

        $plants->each(function ($plant) use ($louis) {
            Task::factory(random_int(0, 2))->create([
                'plant_id' => $plant->id,
                'user_id' => $louis->id
            ]);
        });

        $mattgones = User::create([
            'name' => 'MattGones',
            'email' => 'matdinville@gmail.com',
            'password' => Hash::make('password'),
            'avatar' => null,
        ]);

        $plants = Plant::factory(random_int(5, 10))->create([
            'user_id' => $mattgones->id
        ]);

        $plants->each(function ($plant) use ($mattgones) {
            Task::factory(random_int(0, 2))->create([
                'plant_id' => $plant->id,
                'user_id' => $mattgones->id
            ]);
        });

        User::factory(10)->create()->each(function ($user) {
            $plants = Plant::factory(random_int(5, 25))->create([
                'user_id' => $user->id
            ]);

            $plants->each(function ($plant) use ($user) {
                Task::factory(random_int(0, 2))->create([
                    'plant_id' => $plant->id,
                    'user_id' => $user->id
                ]);
            });
        });
    }
}
