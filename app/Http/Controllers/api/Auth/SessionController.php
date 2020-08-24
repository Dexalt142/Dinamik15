<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SessionController extends Controller
{

    /**
     * Get authenticated user data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request) {
        return response()->json([
            'status' => 200,
            'message' => 'Fetch user success',
            'user' => $request->user()
        ]);
    }

    /**
     * Invalidate user token
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        try {
            JWTAuth::parseToken()->invalidate();

            return response()->json([
                'status' => 200,
                'message' => 'Logout success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Logout failed'
            ], 500);
        }
    }

}
