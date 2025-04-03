<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Gate;
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
         if (Gate::denies('view', $plant)) {
            abort(403, 'Vous n\'avez pas accès à cette plante.');
         }
        return view('plants.show', [
            'plant' => $plant,
        ]);
    }

}
