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

        if(auth('api')->user()) {
            return response()->json([
                'status' => 200,
                'message' => 'Fetch user success',
                'user' => auth('api')->user()
            ]);
        }

        return response()->json([
            'status' => 401,
            'message' => 'Fetch user failed'
        ], 401);

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
