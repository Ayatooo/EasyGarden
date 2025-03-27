<?php

namespace Database\Factories;

use App\Models\Plant;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'task_type' => $this->faker->randomElement(['Arrosage', 'Fertilisation', 'Nettoyage', 'Taille', 'Transplantation', 'Engrais', 'Autre']),
            'scheduled_at' => Carbon::now(),
            'status' => $this->faker->randomElement(['A venir', 'Effectué', 'Annulé']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'plant_id' => Plant::factory(),
            'user_id' => User::factory(),
        ];
    }
}
