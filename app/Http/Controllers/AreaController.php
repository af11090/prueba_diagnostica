<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    //Se obtiene las areas de un local
    public function getAreas($localId)
    {
        $local = Local::findOrFail($localId);
        return response()->json($local->areas);
    }

}
