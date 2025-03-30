<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TaskController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $hasPlants = auth()->user()->plants()->exists();
        return view('tasks.index', [
            'hasPlants' => $hasPlants
        ]);
    }
}
