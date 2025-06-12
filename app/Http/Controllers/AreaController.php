<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getAreas($localId)
    {
        $local = Local::findOrFail($localId);
        return response()->json($local->areas);
    }

}
