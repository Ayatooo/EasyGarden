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
        return view('tasks.index');
    }
}
