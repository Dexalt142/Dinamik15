<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Attempt login
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'The given data was invalid',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if (!$token = auth('admin')->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Login failed',
                    'errors' => [
                        'email' => ['Email atau password salah']
                    ]
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Login success',
            'expires_in' => JWTAuth::factory()->getTTL() * 60000,
            'token' => $token
        ]);
    }

    /**
     * Request validator
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong'
        ];

        $attributes = [
            'email' => 'Email',
            'password' => 'Password'
        ];

        return Validator::make($data, [
            'email' => ['required'],
            'password' => ['required'],
        ], $messages, $attributes);
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
