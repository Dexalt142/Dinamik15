<?php

namespace App\Http\Controllers\api;

use App\Competition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    
    public function getCompetitions() {

        $comp = Competition::all();

        return response()->json([
            'status' => 200,
            'competition' => $comp
        ]);
    }

}
