<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Http\Request;

class CreationController extends Controller
{

    public function getCreations() {

        $creations = Team::with(['creation', 'competition'])->orderBy('competition_id')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Fetching creation success',
            'creation' => $creations
        ]);
    }

}
