<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    public function getTeams() {

        $teams = Team::with(['competition', 'user'])->orderBy('competition_id')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Fetching team success',
            'team' => $teams
        ]);
    }

    public function getTeamDetail($id) {

        $team = Team::find($id);
        if($team) {
            return response()->json([
                'status' => 200,
                'message' => 'Fetching team success',
                'team' => [
                    'member' => $team->members,
                    'instructor' => $team->instructor
                ]
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Team not found'
        ], 404);

    }

}
