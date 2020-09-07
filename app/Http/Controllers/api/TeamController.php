<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    public function getTeam(Request $request) {

        return response()->json([
            'status' => 200,
            'team' => auth()->user()->team
        ]);

    }

}
