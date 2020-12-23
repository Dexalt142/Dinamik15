<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class SessionController extends Controller
{

    /**
     * Get authenticated admin data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAdmin(Request $request)
    {
        if(auth('admin')->user()) {
            return response()->json([
                'status' => 200,
                'message' => 'Fetch admin success',
                'admin' => auth('admin')->user()
            ]);
        }

        return response()->json([
            'status' => 401,
            'message' => 'Fetch admin failed'
        ], 401);
    }

    /**
     * Invalidate user token
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
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

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
