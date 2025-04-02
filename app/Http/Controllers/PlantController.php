<?php

namespace App\Http\Controllers;

use App\Models\Plant;
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

    /**
     * @param Plant $plant
     * @return View
     */
    public function show(Plant $plant): View
    {
        return view('plants.show', [
            'plant' => $plant,
        ]);
    }

}
