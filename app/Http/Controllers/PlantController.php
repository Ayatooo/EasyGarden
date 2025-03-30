<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PlantController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        return view('plants.index');
    }
}
