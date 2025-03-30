<?php

namespace App\Console\Commands;

use App\Jobs\GenerateTaskJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateTaskDailyCommand extends Command
{
    protected $signature = 'generate:task-daily';

    protected $description = 'Command description';

    public function handle(): void
    {
        Log::info('Lancement de la génération des tâches journalières ⚡️');

        $users = User::all();

        $count = 0;

        foreach ($users as $user) {
            if (!$user->plants()->exists()) {
                Log::warning('User ' . $user->id . ' has no plant');
                continue;
            }

            dispatch(new GenerateTaskJob($user));
            $count++;
        }

        Log::info("Il y a $count tâches dispatchées");
        Log::info('Fin de la génération des tâches journalières 🚀');
    }
}
