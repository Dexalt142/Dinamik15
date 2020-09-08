<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    public function getTeam(Request $request) {

        $team = auth()->user()->team;
        if($team) {
            $team->competition;
            $team->payment;
            $team->instructor;
            $team->creation;
        }
        
        return response()->json([
            'status' => 200,
            'team' => $team
        ]);

    }

}
