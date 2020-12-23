<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Payment;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function getPayments() {

        $payments = Team::with(['payment', 'competition'])->orderBy('competition_id')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Fetching payment success',
            'payment' => $payments
        ]);
    }

    public function getPayment($id) {

        $payment = Team::with(['payment', 'competition'])->where('id', $id)->first();

        if($payment) {
            return response()->json([
                'status' => 200,
                'message' => 'Fetching payment success',
                'payment' => $payment
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Payment not found'
        ], 404);

    }

    public function verifyPayment(Request $request) {

        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
            'status' => 'required'
        ]);

        if(!$validator->fails()) {
            $team = Team::find($request->team_id);
            if($team) {
                $payment = $team->payment;
                if($payment && $payment->status_verifikasi != 2) {
                    $payment->status_verifikasi = $request->status == 'Accept' ? 2 : 1;
                    $payment->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Verifikasi pembayaran berhasil'
                    ]);
                }
            }
        }


        return response()->json([
            'status' => 400,
            'message' => 'Verifikasi gagal'
        ], 400);
    }

}
