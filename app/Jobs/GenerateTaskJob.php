<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        Log::info('Lancement de la génération des tâches pour l\'utilisateur ' . $this->user->name, $this->user->toArray());
        $plants = $this->user
            ->plants()
            ->whereNull('deleted_at')
            ->get();

        foreach ($plants as $plant) {
            if ($plant->watering_frequency === 0) {
                Log::warning('La plante ' . $plant->id . ' n\'a pas de fréquence d\'arrosage');
                return;
            }

            $tasks = Task::where('plant_id', $plant->id)
                ->where('task_type', 'Arrosage')
                ->where('created_at', '>=', now()->subDays($plant->watering_frequency))
                ->where('status', 'Effectué')
                ->exists();

            if ($tasks) {
                Log::warning('La plante ' . $plant->id . ' a déjà une tâche d\'arrosage effectuée');
                return;
            }

            $task = Task::create([
                'plant_id' => $plant->id,
                'user_id' => $this->user->id,
                'task_type' => 'Arrosage',
                'scheduled_at' => now(),
                'status' => 'A venir',
            ]);

            Log::info('La tâche ' . $task->id . ' a été créée pour la plante ' . $plant->id, $task->toArray());
        }

    }
}
