<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\Payment;
use App\Team;
use App\TeamMember;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function getStatistics() {
        $userVerified = User::whereNotNull('email_verified_at')->count();
        $team = Team::all()->count();
        $participant = TeamMember::all()->count();
        $instructors = Instructor::all()->count();
        $paymentVerified = Payment::where('status_verifikasi', '2')->count();

        $competitionTeam = [
            'animation_contest' => Team::where('competition_id', 1)->count(),
            'web_development' => Team::where('competition_id', 2)->count(),
            'poster_design' => Team::where('competition_id', 3)->count(),
            'innovation_writing_contest' => Team::where('competition_id', 4)->count(),
        ];

        return response()->json([
            'status' => 200,
            'message' => 'Statistic fetch success',
            'statistic' => [
                'user_verified' => $userVerified,
                'teams' => $team,
                'participants' => $participant,
                'instructors' => $instructors,
                'payment_verified' => $paymentVerified,
                'competition' => $competitionTeam
            ]
        ]);
    }

}
