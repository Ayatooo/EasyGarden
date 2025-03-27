<?php

namespace Database\Factories;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlantFactory extends Factory
{
    protected $model = Plant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'image' => null,
            'type' => $this->faker->randomElement(['Fleur', 'Plante verte', 'Cactus', 'Plante grasse', 'Arbre', 'Arbuste', 'Plante aquatique', 'Plante grimpante', 'Autre']),
            'watering_frequency' => $this->faker->randomNumber(),
            'sun_exposure' => $this->faker->randomElement(['Plein soleil', 'Mi-ombre', 'Ombre']),
            'soil_type' => $this->faker->randomElement(['Argileux', 'Sableux', 'Limoneux', 'Humifère', 'Calcaire', 'Tourbe', 'Autre']),
            'notes' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
