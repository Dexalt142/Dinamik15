<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\StringManipulation\Pass\Pass;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = $this->validateEmail($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'The given data was invalid',
                'errors' => $validator->errors()
            ], 422);
        }

        
        try {
            $response = $this->broker()->sendResetLink($this->credentials($request));
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Unable to reset password',
                'errors' => $e->getMessage()
            ], 500);
        }

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Alamat reset password dikirim ke email anda'
        ]);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        $errorMessage = "";
        switch($response) {
            case Password::INVALID_USER:
                $errorMessage = "Email tidak dapat ditemukan";
            break;

            case Password::INVALID_TOKEN:
                $errorMessage = "Token tidak valid";
            break;

            case 'passwords.throttled':
                $errorMessage = "Harap tunggu beberapa saat";
            break;
        }

        return response()->json([
            'status' => 400,
            'message' => 'Failed to send reset link',
            'errors' => [
                'email' => [$errorMessage]
            ]
        ], 400);
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateEmail(Request $request)
    {

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'email' => 'Alamat email tidak valid'
        ];

        $attributes = [
            'email' => 'Email'
        ];

        return Validator::make($request->all(), [
            'email' => 'required|email',
        ], $messages, $attributes);

    }
}
