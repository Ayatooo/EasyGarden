<?php

namespace App\Livewire\Plants;

use App\Models\Plant;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class Agenda extends Component
{
    public Plant $plant;
    public Carbon $currentMonth;

    /**
     * @param Plant $plant
     * @return void
     */
    public function mount(Plant $plant): void
    {
        $this->plant = $plant;
        $this->currentMonth = now()->startOfMonth();
    }

    /**
     * @return void
     */
    public function previousMonth(): void
    {
        $this->currentMonth->subMonth();
    }

    /**
     * @return void
     */
    public function nextMonth(): void
    {
        $this->currentMonth->addMonth();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $start = $this->currentMonth->copy()->startOfMonth()->startOfWeek();
        $end = $this->currentMonth->copy()->endOfMonth()->endOfWeek();

        $days = collect();
        $date = $start->copy();

        while ($date->lte($end)) {
            $tasks = $this->plant->tasks()
                ->whereDate('scheduled_at', $date->copy()->toDateString())
                ->get();

            $tasks->each(function ($task) {
                $task->bgColor = match ($task->status) {
                    'A venir' => 'bg-blue-500 dark:bg-blue-600',
                    'Effectué' => 'bg-green-500 dark:bg-green-600',
                    default => 'bg-red-500 dark:bg-red-600',
                };
            });

            $days->push([
                'date' => $date->copy(),
                'tasks' => $tasks,
            ]);

            $date->addDay();
        }

        return view('livewire.plants.agenda', [
            'days' => $days,
            'currentMonth' => $this->currentMonth,
        ]);
    }

}
