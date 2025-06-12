<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class CargoController extends Controller
{

    public function getCargos($areaId)
    {
        $area = Area::findOrFail($areaId);
        return response()->json($area->cargos);
    }
}
